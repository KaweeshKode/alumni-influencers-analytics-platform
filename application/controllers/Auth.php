<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Email_verification_model');
        $this->load->model('Password_reset_model');
        $this->load->model('Login_audit_model');

        $this->load->library('email');
        $this->_load_env();
    }

    public function register()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('university_email', 'University Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|callback_valid_password');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run()) {
                $email = strtolower(trim($this->input->post('university_email', TRUE)));

                if (!$this->_is_allowed_university_email($email)) {
                    $data['error'] = 'Only university email addresses ending with @' . ALLOWED_UNIVERSITY_EMAIL_DOMAIN . ' are allowed.';
                    return $this->load->view('auth/register', $data);
                }

                if ($this->User_model->email_exists($email)) {
                    $data['error'] = 'This email is already registered.';
                    return $this->load->view('auth/register', $data);
                }

                $user_id = $this->User_model->create_user([
                    'first_name'         => trim($this->input->post('first_name', TRUE)),
                    'last_name'          => trim($this->input->post('last_name', TRUE)),
                    'university_email'   => $email,
                    'password_hash'      => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'is_email_verified'  => 0,
                    'account_status'     => 'active'
                ]);

                $raw_token = bin2hex(random_bytes(32));
                $this->Email_verification_model->create_token($user_id, $raw_token);

                $verification_link = site_url('auth/verify_email?token=' . urlencode($raw_token));

                $email_message = '
                    <h2>Email Verification</h2>
                    <p>Hello ' . html_escape($this->input->post('first_name', TRUE)) . ',</p>
                    <p>Thank you for registering with the Alumni Influencers Platform.</p>
                    <p>Please click the link below to verify your email address:</p>
                    <p><a href="' . $verification_link . '">Verify Email</a></p>
                    <p>If the link does not work, copy and paste this URL into your browser:</p>
                    <p>' . $verification_link . '</p>
                    <p>This verification link will expire automatically.</p>
                ';

                if ($this->_send_email_message($email, 'Verify your Alumni Influencers account', $email_message)) {
                    $data['message'] = 'Registration successful. Please check your email to verify your account.';
                } else {
                    $data['message'] = 'Registration successful, but email sending failed. For local testing, use this verification link:<br><a href="' . $verification_link . '">' . $verification_link . '</a>';
                }

                return $this->load->view('auth/auth_message', $data);
            }
        }

        $this->load->view('auth/register');
    }

    public function verify_email()
    {
        $token = $this->input->get('token', TRUE);

        if (!$token) {
            $data['error'] = 'Verification token is missing.';
            return $this->load->view('auth/verification_error', $data);
        }

        $token_row = $this->Email_verification_model->get_valid_token($token);

        if (!$token_row) {
            $data['error'] = 'Invalid, expired, or already used verification token.';
            return $this->load->view('auth/verification_error', $data);
        }

        $this->User_model->mark_email_verified($token_row->user_id);
        $this->Email_verification_model->mark_used($token_row->id);

        $data['message'] = 'Email verified successfully. You can now log in.';
        $this->load->view('auth/verification_success', $data);
    }

    public function login()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('university_email', 'University Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run()) {
                $email = strtolower(trim($this->input->post('university_email', TRUE)));
                $password = $this->input->post('password');

                $user = $this->User_model->get_by_email($email);

                if (!$user) {
                    $this->_log_login_attempt(NULL, $email, 'failed', 'Email not found');
                    $data['error'] = 'Invalid email or password.';
                    return $this->load->view('auth/login', $data);
                }

                if (!password_verify($password, $user->password_hash)) {
                    $this->_log_login_attempt($user->id, $email, 'failed', 'Wrong password');
                    $data['error'] = 'Invalid email or password.';
                    return $this->load->view('auth/login', $data);
                }

                if ((int)$user->is_email_verified !== 1) {
                    $this->_log_login_attempt($user->id, $email, 'failed', 'Email not verified');
                    $data['error'] = 'Please verify your email before logging in.';
                    return $this->load->view('auth/login', $data);
                }

                if ($user->account_status !== 'active') {
                    $this->_log_login_attempt($user->id, $email, 'failed', 'Account not active');
                    $data['error'] = 'Your account is not active.';
                    return $this->load->view('auth/login', $data);
                }

                $this->session->sess_regenerate(TRUE);

                $this->session->set_userdata([
                    'user_id'    => $user->id,
                    'user_email' => $user->university_email,
                    'user_name'  => $user->first_name . ' ' . $user->last_name,
                    'user_role'  => isset($user->role) ? $user->role : 'alumnus',
                    'logged_in'  => TRUE
                ]);

                $this->User_model->update_last_login($user->id);
                $this->_log_login_attempt($user->id, $email, 'success', NULL);

                redirect('auth/dashboard');
            }
        }

        $this->load->view('auth/login');
    }

    public function dashboard()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
            return;
        }

        $this->load->view('auth/dashboard');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function forgot_password()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('university_email', 'University Email', 'required|trim|valid_email');

            if ($this->form_validation->run()) {
                $email = strtolower(trim($this->input->post('university_email', TRUE)));
                $user = $this->User_model->get_by_email($email);

                if ($user) {
                    $raw_token = bin2hex(random_bytes(32));
                    $this->Password_reset_model->create_token($user->id, $raw_token);

                    $reset_link = site_url('auth/reset_password?token=' . urlencode($raw_token));

                    $email_message = '
                        <h2>Password Reset</h2>
                        <p>Hello ' . html_escape($user->first_name) . ',</p>
                        <p>You requested a password reset for your Alumni Influencers Platform account.</p>
                        <p>Please click the link below to reset your password:</p>
                        <p><a href="' . $reset_link . '">Reset Password</a></p>
                        <p>If the link does not work, copy and paste this URL into your browser:</p>
                        <p>' . $reset_link . '</p>
                        <p>If you did not request this password reset, you can safely ignore this email.</p>
                    ';

                    if ($this->_send_email_message($email, 'Reset your Alumni Influencers password', $email_message)) {
                        $data['message'] = 'If the email exists, a password reset link has been sent.';
                    } else {
                        $data['message'] = 'Password reset link generated, but email sending failed. For local testing, use this link:<br><a href="' . $reset_link . '">' . $reset_link . '</a>';
                    }

                    return $this->load->view('auth/auth_message', $data);
                }

                $data['message'] = 'If the email exists, a password reset link has been sent.';
                return $this->load->view('auth/auth_message', $data);
            }
        }

        $this->load->view('auth/forgot_password');
    }

    public function reset_password()
    {
        $token = $this->input->get('token', TRUE);

        if (!$token) {
            $data['error'] = 'Reset token is missing.';
            return $this->load->view('auth/verification_error', $data);
        }

        $token_row = $this->Password_reset_model->get_valid_token($token);

        if (!$token_row) {
            $data['error'] = 'Invalid, expired, or already used reset token.';
            return $this->load->view('auth/verification_error', $data);
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('password', 'Password', 'required|callback_valid_password');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run()) {
                $password_hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

                $this->User_model->update_password($token_row->user_id, $password_hash);
                $this->Password_reset_model->mark_used($token_row->id);

                $data['message'] = 'Password reset successful. You can now log in.';
                return $this->load->view('auth/auth_message', $data);
            }
        }

        $data['token'] = $token;
        $this->load->view('auth/reset_password', $data);
    }

    public function valid_password($password)
    {
        $password = (string)$password;

        $has_min_length = strlen($password) >= 8;
        $has_upper      = preg_match('/[A-Z]/', $password);
        $has_lower      = preg_match('/[a-z]/', $password);
        $has_digit      = preg_match('/[0-9]/', $password);
        $has_special    = preg_match('/[\W_]/', $password);

        if ($has_min_length && $has_upper && $has_lower && $has_digit && $has_special) {
            return TRUE;
        }

        $this->form_validation->set_message(
            'valid_password',
            'Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.'
        );
        return FALSE;
    }

    private function _is_allowed_university_email($email)
    {
        $parts = explode('@', $email);
        return count($parts) === 2 && strtolower($parts[1]) === strtolower(ALLOWED_UNIVERSITY_EMAIL_DOMAIN);
    }

    private function _log_login_attempt($user_id, $email, $status, $reason = NULL)
    {
        $this->Login_audit_model->log_attempt([
            'user_id'         => $user_id,
            'email_attempted' => $email,
            'ip_address'      => $this->input->ip_address(),
            'user_agent'      => $this->input->user_agent(),
            'login_status'    => $status,
            'failure_reason'  => $reason
        ]);
    }

    private function _load_env()
    {
        $env_path = FCPATH . '.env';

        if (!file_exists($env_path)) {
            return;
        }

        $lines = file($env_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }

            if (strpos($line, '=') === false) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);

            $name = trim($name);
            $value = trim($value);
            $value = trim($value, "\"'");

            $_ENV[$name] = $value;
            putenv($name . '=' . $value);
        }
    }

    private function _send_email_message($to, $subject, $message)
    {
        $config = [
            'protocol'    => 'smtp',
            'smtp_host'   => $_ENV['SMTP_HOST'] ?? getenv('SMTP_HOST') ?: 'smtp.gmail.com',
            'smtp_port'   => (int) ($_ENV['SMTP_PORT'] ?? getenv('SMTP_PORT') ?: 465),
            'smtp_user'   => $_ENV['SMTP_USER'] ?? getenv('SMTP_USER') ?: '',
            'smtp_pass'   => $_ENV['SMTP_PASS'] ?? getenv('SMTP_PASS') ?: '',
            'smtp_crypto' => $_ENV['SMTP_CRYPTO'] ?? getenv('SMTP_CRYPTO') ?: 'ssl',
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'wordwrap'    => TRUE,
            'newline'     => "\r\n",
            'crlf'        => "\r\n"
        ];

        $this->email->clear(TRUE);
        $this->email->initialize($config);

        $from_email = $_ENV['SMTP_FROM_EMAIL'] ?? getenv('SMTP_FROM_EMAIL') ?: $config['smtp_user'];
        $from_name  = $_ENV['SMTP_FROM_NAME'] ?? getenv('SMTP_FROM_NAME') ?: 'Alumni Influencers Platform';

        $this->email->from($from_email, $from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }
}
