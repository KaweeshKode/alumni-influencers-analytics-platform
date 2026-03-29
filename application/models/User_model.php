<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'users';

    public function create_user($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_email($email)
    {
        return $this->db->get_where($this->table, ['university_email' => $email])->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function email_exists($email)
    {
        return $this->db->where('university_email', $email)->count_all_results($this->table) > 0;
    }

    public function mark_email_verified($user_id)
    {
        return $this->db->where('id', $user_id)->update($this->table, [
            'is_email_verified' => 1
        ]);
    }

    public function update_last_login($user_id)
    {
        return $this->db->where('id', $user_id)->update($this->table, [
            'last_login_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function update_password($user_id, $password_hash)
    {
        return $this->db->where('id', $user_id)->update($this->table, [
            'password_hash' => $password_hash
        ]);
    }
}
