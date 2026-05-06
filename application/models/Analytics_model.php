<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_total_alumni()
    {
        return $this->db
            ->where('role', 'alumnus')
            ->count_all_results('users');
    }

    public function get_total_profiles()
    {
        return $this->db->count_all_results('alumni_profiles');
    }

    public function get_total_certifications()
    {
        return $this->db->count_all_results('profile_certifications');
    }

    public function get_total_courses()
    {
        return $this->db->count_all_results('profile_short_courses');
    }

    public function get_top_industry_sector()
    {
        return $this->db
            ->select('industry_sector, COUNT(*) AS total')
            ->from('alumni_profiles')
            ->where('industry_sector IS NOT NULL')
            ->where('industry_sector !=', '')
            ->group_by('industry_sector')
            ->order_by('total', 'DESC')
            ->limit(1)
            ->get()
            ->row();
    }

    public function get_top_job_title()
    {
        return $this->db
            ->select('current_job_title, COUNT(*) AS total')
            ->from('alumni_profiles')
            ->where('current_job_title IS NOT NULL')
            ->where('current_job_title !=', '')
            ->group_by('current_job_title')
            ->order_by('total', 'DESC')
            ->limit(1)
            ->get()
            ->row();
    }

    public function get_top_employer()
    {
        return $this->db
            ->select('current_company, COUNT(*) AS total')
            ->from('alumni_profiles')
            ->where('current_company IS NOT NULL')
            ->where('current_company !=', '')
            ->group_by('current_company')
            ->order_by('total', 'DESC')
            ->limit(1)
            ->get()
            ->row();
    }

    public function get_recent_profiles($limit = 5)
    {
        return $this->db
            ->select('
                alumni_profiles.*,
                users.first_name,
                users.last_name,
                users.university_email
            ')
            ->from('alumni_profiles')
            ->join('users', 'users.id = alumni_profiles.user_id')
            ->order_by('alumni_profiles.updated_at', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }
}
