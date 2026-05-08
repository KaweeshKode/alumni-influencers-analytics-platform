<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $api_token = null;

    public function __construct()
    {
        parent::__construct();
    }

    protected function require_bearer_token($required_scope)
    {
        $this->load->model('Api_token_model');
        $this->load->model('Api_usage_log_model');
        $this->load->helper('api_token');

        $auth_header = $this->input->get_request_header('Authorization', true);

        if (!$auth_header || stripos($auth_header, 'Bearer ') !== 0) {
            $this->json_error('Missing bearer token.', 401);
        }

        $plain_token = trim(substr($auth_header, 7));
        $token_hash  = hash_api_token($plain_token);

        $token = $this->Api_token_model->get_by_hash($token_hash);

        if (!$token) {
            $this->json_error('Invalid token.', 401);
        }

        if ($this->Api_token_model->is_expired($token)) {
            $this->json_error('Token expired.', 401);
        }

        if (!$this->Api_token_model->token_has_scope($token, $required_scope)) {
            $this->log_api_usage($token, 403);
            $this->json_error('Forbidden: missing required scope.', 403);
        }

        $this->Api_token_model->touch_last_used($token->id);
        $this->api_token = $token;

        return $token;
    }

    protected function log_api_usage($token, $response_code)
    {
        $this->load->model('Api_usage_log_model');

        $this->Api_usage_log_model->create([
            'token_id'     => $token->id,
            'client_id'    => $token->client_id,
            'user_id'      => $token->user_id,
            'endpoint'     => current_url(),
            'http_method'  => $this->input->method(true),
            'ip_address'   => $this->input->ip_address(),
            'user_agent'   => substr((string)$this->input->user_agent(), 0, 255),
            'response_code'=> $response_code
        ]);
    }

    protected function json_success($data, $status = 200)
    {
        $this->output
            ->set_status_header($status)
            ->set_content_type('application/json')
            ->set_output(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        exit;
    }

    protected function json_error($message, $status = 400)
    {
        $this->output
            ->set_status_header($status)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => $message], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        exit;
    }
}
