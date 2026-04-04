<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni_profile_model extends CI_Model
{
    private $table = 'alumni_profiles';

    public function get_by_user_id($user_id)
    {
        return $this->db->get_where($this->table, ['user_id' => $user_id])->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function create_profile($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update_profile($user_id, $data)
    {
        return $this->db->where('user_id', $user_id)->update($this->table, $data);
    }
}
