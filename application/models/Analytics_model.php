<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

    public function get_alumni_filters()
    {
        $programmes = $this->db
            ->select('degree_name')
            ->from('profile_degrees')
            ->where('degree_name IS NOT NULL')
            ->where('degree_name !=', '')
            ->group_by('degree_name')
            ->order_by('degree_name', 'ASC')
            ->get()
            ->result();

        $graduation_years = $this->db
            ->select('graduation_year')
            ->from('alumni_profiles')
            ->where('graduation_year IS NOT NULL')
            ->where('graduation_year !=', '')
            ->group_by('graduation_year')
            ->order_by('graduation_year', 'DESC')
            ->get()
            ->result();

        $industry_sectors = $this->db
            ->select('industry_sector')
            ->from('alumni_profiles')
            ->where('industry_sector IS NOT NULL')
            ->where('industry_sector !=', '')
            ->group_by('industry_sector')
            ->order_by('industry_sector', 'ASC')
            ->get()
            ->result();

        return [
            'programmes' => $programmes,
            'graduation_years' => $graduation_years,
            'industry_sectors' => $industry_sectors
        ];
    }

    public function get_filtered_alumni($filters = [])
    {
        $this->db
            ->select('
            alumni_profiles.*,
            users.first_name,
            users.last_name,
            users.university_email,
            GROUP_CONCAT(DISTINCT profile_degrees.degree_name SEPARATOR ", ") AS programmes
        ')
            ->from('alumni_profiles')
            ->join('users', 'users.id = alumni_profiles.user_id')
            ->join('profile_degrees', 'profile_degrees.profile_id = alumni_profiles.id', 'left')
            ->where('users.role', 'alumnus');

        if (!empty($filters['programme'])) {
            $this->db->where('profile_degrees.degree_name', $filters['programme']);
        }

        if (!empty($filters['graduation_year'])) {
            $this->db->where('alumni_profiles.graduation_year', $filters['graduation_year']);
        }

        if (!empty($filters['industry_sector'])) {
            $this->db->where('alumni_profiles.industry_sector', $filters['industry_sector']);
        }

        $this->db
            ->group_by('alumni_profiles.id')
            ->order_by('alumni_profiles.updated_at', 'DESC');

        return $this->db->get()->result();
    }

    public function get_alumni_by_graduation_year()
    {
        return $this->db
            ->select('graduation_year AS label, COUNT(*) AS total')
            ->from('alumni_profiles')
            ->where('graduation_year IS NOT NULL')
            ->where('graduation_year !=', '')
            ->group_by('graduation_year')
            ->order_by('graduation_year', 'ASC')
            ->get()
            ->result();
    }

    public function get_employment_by_industry()
    {
        return $this->db
            ->select('industry_sector AS label, COUNT(*) AS total')
            ->from('alumni_profiles')
            ->where('industry_sector IS NOT NULL')
            ->where('industry_sector !=', '')
            ->group_by('industry_sector')
            ->order_by('total', 'DESC')
            ->get()
            ->result();
    }

    public function get_top_employers($limit = 10)
    {
        return $this->db
            ->select('current_company AS label, COUNT(*) AS total')
            ->from('alumni_profiles')
            ->where('current_company IS NOT NULL')
            ->where('current_company !=', '')
            ->group_by('current_company')
            ->order_by('total', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }

    public function get_common_job_titles($limit = 10)
    {
        return $this->db
            ->select('current_job_title AS label, COUNT(*) AS total')
            ->from('alumni_profiles')
            ->where('current_job_title IS NOT NULL')
            ->where('current_job_title !=', '')
            ->group_by('current_job_title')
            ->order_by('total', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }

    public function get_geographic_distribution()
    {
        return $this->db
            ->select('location_country AS label, COUNT(*) AS total')
            ->from('alumni_profiles')
            ->where('location_country IS NOT NULL')
            ->where('location_country !=', '')
            ->group_by('location_country')
            ->order_by('total', 'DESC')
            ->get()
            ->result();
    }

    public function get_certification_trends($limit = 10)
    {
        return $this->db
            ->select('certification_name AS label, COUNT(*) AS total')
            ->from('profile_certifications')
            ->where('certification_name IS NOT NULL')
            ->where('certification_name !=', '')
            ->group_by('certification_name')
            ->order_by('total', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }

    public function get_course_trends($limit = 10)
    {
        return $this->db
            ->select('course_name AS label, COUNT(*) AS total')
            ->from('profile_short_courses')
            ->where('course_name IS NOT NULL')
            ->where('course_name !=', '')
            ->group_by('course_name')
            ->order_by('total', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }


    public function get_alumni_growth_trend()
    {
        $rows = $this->get_alumni_by_graduation_year();
        $running_total = 0;
        $growth = [];

        foreach ($rows as $row) {
            $running_total += (int) $row->total;
            $growth[] = (object) [
                'label' => (string) $row->label,
                'total' => $running_total
            ];
        }

        return $growth;
    }

    private function count_skill_keywords($table, $column, $keywords)
    {
        $this->db->from($table);
        $this->db->group_start();

        foreach ($keywords as $index => $keyword) {
            if ($index === 0) {
                $this->db->like($column, $keyword);
            } else {
                $this->db->or_like($column, $keyword);
            }
        }

        $this->db->group_end();
        return (int) $this->db->count_all_results();
    }

    public function get_curriculum_skills_gap()
    {
        $skill_areas = [
            'Cloud Computing' => ['AWS', 'Azure', 'Cloud'],
            'Data Analytics / AI' => ['Data', 'Analytics', 'AI', 'Machine Learning'],
            'Web Development' => ['React', 'Laravel', 'PHP', 'JavaScript', 'Web'],
            'DevOps / Containers' => ['Docker', 'Kubernetes', 'DevOps', 'CI/CD'],
            'Cybersecurity' => ['Security', 'Cyber', 'Network Security', 'Ethical Hacking']
        ];

        $results = [];

        foreach ($skill_areas as $skill => $keywords) {
            $certification_count = $this->count_skill_keywords('profile_certifications', 'certification_name', $keywords);
            $course_count = $this->count_skill_keywords('profile_short_courses', 'course_name', $keywords);
            $total = $certification_count + $course_count;

            if ($total >= 3) {
                $gap_level = 'Critical';
            } elseif ($total === 2) {
                $gap_level = 'Significant';
            } elseif ($total === 1) {
                $gap_level = 'Emerging';
            } else {
                $gap_level = 'No current signal';
            }

            $results[] = (object) [
                'label' => $skill,
                'total' => $total,
                'certification_count' => $certification_count,
                'course_count' => $course_count,
                'gap_level' => $gap_level
            ];
        }

        return $results;
    }

}
