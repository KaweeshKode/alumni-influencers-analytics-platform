<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_token_model extends CI_Model
{
    private $table = 'api_tokens';

    public function create_token($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_by_hash($token_hash)
    {
        return $this->db
            ->where('token_hash', $token_hash)
            ->where('is_active', 1)
            ->where('revoked_at IS NULL', null, false)
            ->get($this->table)
            ->row();
    }

    public function get_user_tokens($user_id)
    {
        return $this->db
            ->select('api_tokens.*, api_clients.client_name, api_clients.client_slug')
            ->from('api_tokens')
            ->join('api_clients', 'api_clients.id = api_tokens.client_id')
            ->where('api_tokens.user_id', $user_id)
            ->order_by('api_tokens.created_at', 'DESC')
            ->get()
            ->result();
    }

    public function revoke_token($token_id, $user_id)
    {
        return $this->db
            ->where('id', $token_id)
            ->where('user_id', $user_id)
            ->update($this->table, [
                'is_active'  => 0,
                'revoked_at' => date('Y-m-d H:i:s')
            ]);
    }

    public function touch_last_used($token_id)
    {
        return $this->db
            ->where('id', $token_id)
            ->update($this->table, [
                'last_used_at' => date('Y-m-d H:i:s')
            ]);
    }

    public function is_expired($token)
    {
        return !empty($token->expires_at) && strtotime($token->expires_at) < time();
    }

    public function token_has_scope($token, $required_scope)
    {
        $scopes = json_decode($token->scopes, true);

        if (!is_array($scopes)) {
            return false;
        }

        return in_array($required_scope, $scopes, true);
    }
}
