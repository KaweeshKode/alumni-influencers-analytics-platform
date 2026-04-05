<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_usage_log_model extends CI_Model
{
    private $table = 'api_usage_logs';

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_logs_for_user($user_id)
    {
        return $this->db
            ->select('api_usage_logs.*, api_clients.client_name, api_tokens.token_name')
            ->from('api_usage_logs')
            ->join('api_clients', 'api_clients.id = api_usage_logs.client_id')
            ->join('api_tokens', 'api_tokens.id = api_usage_logs.token_id')
            ->where('api_usage_logs.user_id', $user_id)
            ->order_by('api_usage_logs.requested_at', 'DESC')
            ->get()
            ->result();
    }

    public function get_token_usage_count($token_id)
    {
        return $this->db
            ->where('token_id', $token_id)
            ->count_all_results($this->table);
    }
}
