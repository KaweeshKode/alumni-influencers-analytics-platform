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

    public function get_full_profile_by_user_id($user_id)
    {
        $profile = $this->db
            ->select('
                alumni_profiles.*,
                users.first_name,
                users.last_name,
                users.university_email AS email
            ')
            ->from('alumni_profiles')
            ->join('users', 'users.id = alumni_profiles.user_id')
            ->where('alumni_profiles.user_id', $user_id)
            ->get()
            ->row();

        if (!$profile) {
            return null;
        }

        $profile_id = $profile->id;

        $profile->degrees = $this->db
            ->where('profile_id', $profile_id)
            ->get('profile_degrees')
            ->result();

        $profile->certifications = $this->db
            ->where('profile_id', $profile_id)
            ->get('profile_certifications')
            ->result();

        $profile->licences = $this->db
            ->where('profile_id', $profile_id)
            ->get('profile_licences')
            ->result();

        $profile->short_courses = $this->db
            ->where('profile_id', $profile_id)
            ->get('profile_short_courses')
            ->result();

        $profile->employment_history = $this->db
            ->where('profile_id', $profile_id)
            ->get('profile_employment_history')
            ->result();

        return $profile;
    }
}