<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_certification_model extends CI_Model
{
    private $table = 'profile_certifications';

    public function get_all($profile_id)
    {
        return $this->db->where('profile_id', $profile_id)->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }
}
