<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Analytics extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
            return;
        }

        $allowed_roles = ['client', 'developer'];

        if (!in_array($this->session->userdata('user_role'), $allowed_roles)) {
            show_error('Access denied. Only university client or developer users can access analytics.', 403);
            return;
        }

        $this->load->model('Analytics_model');
        $this->load->helper(['url', 'form']);
    }

    public function dashboard()
    {
        $data['total_alumni'] = $this->Analytics_model->get_total_alumni();
        $data['total_profiles'] = $this->Analytics_model->get_total_profiles();
        $data['total_certifications'] = $this->Analytics_model->get_total_certifications();
        $data['total_courses'] = $this->Analytics_model->get_total_courses();

        $data['top_industry_sector'] = $this->Analytics_model->get_top_industry_sector();
        $data['top_job_title'] = $this->Analytics_model->get_top_job_title();
        $data['top_employer'] = $this->Analytics_model->get_top_employer();

        $data['recent_profiles'] = $this->Analytics_model->get_recent_profiles();

        $this->load->view('analytics/dashboard', $data);
    }

    public function index()
    {
        redirect('analytics/dashboard');
    }

    public function alumni()
    {
        $filters = [
            'programme' => $this->input->get('programme', TRUE),
            'graduation_year' => $this->input->get('graduation_year', TRUE),
            'industry_sector' => $this->input->get('industry_sector', TRUE)
        ];

        $data['filters'] = $filters;
        $data['filter_options'] = $this->Analytics_model->get_alumni_filters();
        $data['alumni'] = $this->Analytics_model->get_filtered_alumni($filters);

        $this->load->view('analytics/alumni_list', $data);
    }

    public function graphs()
    {
        $data['graduation_years'] = $this->Analytics_model->get_alumni_by_graduation_year();
        $data['industry_sectors'] = $this->Analytics_model->get_employment_by_industry();
        $data['top_employers'] = $this->Analytics_model->get_top_employers();
        $data['job_titles'] = $this->Analytics_model->get_common_job_titles();
        $data['geographic_distribution'] = $this->Analytics_model->get_geographic_distribution();
        $data['certification_trends'] = $this->Analytics_model->get_certification_trends();
        $data['course_trends'] = $this->Analytics_model->get_course_trends();

        $this->load->view('analytics/graphs', $data);
    }

    public function export_csv()
    {
        $filters = [
            'programme' => $this->input->get('programme', TRUE),
            'graduation_year' => $this->input->get('graduation_year', TRUE),
            'industry_sector' => $this->input->get('industry_sector', TRUE)
        ];

        $alumni = $this->Analytics_model->get_filtered_alumni($filters);

        $filename = 'filtered_alumni_export_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        fputcsv($output, [
            'Name',
            'Email',
            'Programme(s)',
            'Graduation Year',
            'Current Job',
            'Company',
            'Industry Sector',
            'City',
            'Country',
            'LinkedIn URL'
        ]);

        foreach ($alumni as $person) {
            fputcsv($output, [
                $person->first_name . ' ' . $person->last_name,
                $person->university_email,
                $person->programmes ?: 'Not added',
                $person->graduation_year,
                $person->current_job_title,
                $person->current_company,
                $person->industry_sector,
                $person->location_city,
                $person->location_country,
                $person->linkedin_url
            ]);
        }

        fclose($output);
        exit;
    }
}
