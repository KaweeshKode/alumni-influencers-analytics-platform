<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiTokens extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->load->model('Api_token_model');
        $this->load->model('Api_usage_log_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper(['url', 'form', 'api_token']);
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        $data['tokens'] = $this->Api_token_model->get_user_tokens($user_id);
        $data['clients'] = $this->db->get_where('api_clients', ['is_active' => 1])->result();

        $this->load->view('api_tokens/index', $data);
    }

    public function create()
    {
        $user_id = $this->session->userdata('user_id');

        $this->form_validation->set_rules('token_name', 'Token Name', 'required|trim|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('client_id', 'Client', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('apitokens');
        }

        $client_id = (int)$this->input->post('client_id', true);
        $token_name = trim($this->input->post('token_name', true));

        $client = $this->db->get_where('api_clients', ['id' => $client_id, 'is_active' => 1])->row();

        if (!$client) {
            $this->session->set_flashdata('error', 'Invalid client selected.');
            redirect('apitokens');
        }

        $scopes = [];
        if ($client->client_slug === 'analytics_dashboard') {
            $scopes = ['read:alumni', 'read:analytics'];
        } elseif ($client->client_slug === 'mobile_ar_app') {
            $scopes = ['read:alumni_of_day'];
        }

        $plain_token = generate_plain_api_token();
        $token_hash  = hash_api_token($plain_token);
        $token_prefix = make_token_prefix($plain_token);

        $this->Api_token_model->create_token([
            'user_id'      => $user_id,
            'client_id'    => $client_id,
            'token_name'   => $token_name,
            'token_prefix' => $token_prefix,
            'token_hash'   => $token_hash,
            'scopes'       => json_encode($scopes),
            'expires_at'   => date('Y-m-d H:i:s', strtotime('+90 days')),
            'is_active'    => 1
        ]);

        $this->session->set_flashdata('generated_token', $plain_token);
        $this->session->set_flashdata('success', 'API token created. Copy it now; it will not be shown again.');
        redirect('apitokens');
    }

    public function revoke($token_id)
    {
        $user_id = $this->session->userdata('user_id');

        $this->Api_token_model->revoke_token((int)$token_id, $user_id);

        $this->session->set_flashdata('success', 'Token revoked successfully.');
        redirect('apitokens');
    }

    public function usage()
    {
        $user_id = $this->session->userdata('user_id');

        $data['logs'] = $this->Api_usage_log_model->get_logs_for_user($user_id);
        $this->load->view('api_tokens/usage', $data);
    }
}
