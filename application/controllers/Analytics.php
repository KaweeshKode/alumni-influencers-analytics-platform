<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
}
