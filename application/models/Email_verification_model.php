<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_verification_model extends CI_Model
{
    private $table = 'email_verification_tokens';

    public function create_token($user_id, $raw_token)
    {
        $data = [
            'user_id'     => $user_id,
            'token_hash'  => hash('sha256', $raw_token),
            'expires_at'  => date('Y-m-d H:i:s', strtotime('+' . EMAIL_VERIFICATION_TOKEN_EXPIRY_HOURS . ' hours')),
            'used_at'     => NULL
        ];

        return $this->db->insert($this->table, $data);
    }

    public function get_valid_token($raw_token)
    {
        $token_hash = hash('sha256', $raw_token);

        return $this->db
            ->where('token_hash', $token_hash)
            ->where('used_at IS NULL', NULL, FALSE)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->get($this->table)
            ->row();
    }

    public function mark_used($id)
    {
        return $this->db->where('id', $id)->update($this->table, [
            'used_at' => date('Y-m-d H:i:s')
        ]);
    }
}
