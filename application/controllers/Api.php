<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Featured_alumni_model');
        $this->load->model('Alumni_profile_model');
        $this->load->model('Analytics_model');
        $this->load->database();
    }

    public function index()
    {
        echo "API Controller Works";
    }

    public function featuredToday()
    {
        $token = $this->require_bearer_token('read:alumni_of_day');

        $featured = $this->Featured_alumni_model->get_today_featured();

        if (!$featured) {
            $this->log_api_usage($token, 404);
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'error' => 'No featured alumnus found for today.'
                ]));
            return;
        }

        $profile = $this->Alumni_profile_model->get_full_profile_by_user_id($featured->user_id);

        if (!$profile) {
            $this->log_api_usage($token, 404);
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'error' => 'Featured alumnus profile not found.'
                ]));
            return;
        }

        $this->log_api_usage($token, 200);
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'date' => $featured->feature_date,
                'featured_alumnus' => $profile
            ], JSON_PRETTY_PRINT));
    }

    public function alumni()
    {
        $token = $this->require_bearer_token('read:alumni');

        $filters = [
            'programme' => $this->input->get('programme', TRUE),
            'graduation_year' => $this->input->get('graduation_year', TRUE),
            'industry_sector' => $this->input->get('industry_sector', TRUE)
        ];

        $alumni = $this->Analytics_model->get_filtered_alumni($filters);

        $this->log_api_usage($token, 200);

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'filters' => $filters,
                'count' => count($alumni),
                'alumni' => $alumni
            ], JSON_PRETTY_PRINT));
    }

    public function analyticsSummary()
    {
        $token = $this->require_bearer_token('read:analytics');

        $top_industry_sector = $this->Analytics_model->get_top_industry_sector();
        $top_job_title = $this->Analytics_model->get_top_job_title();
        $top_employer = $this->Analytics_model->get_top_employer();

        $summary = [
            'total_alumni' => $this->Analytics_model->get_total_alumni(),
            'total_profiles' => $this->Analytics_model->get_total_profiles(),
            'total_certifications' => $this->Analytics_model->get_total_certifications(),
            'total_courses' => $this->Analytics_model->get_total_courses(),
            'top_industry_sector' => $top_industry_sector,
            'top_job_title' => $top_job_title,
            'top_employer' => $top_employer
        ];

        $this->log_api_usage($token, 200);

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($summary, JSON_PRETTY_PRINT));
    }

    public function analyticsCharts()
    {
        $token = $this->require_bearer_token('read:analytics');

        $charts = [
            'alumni_by_graduation_year' => $this->Analytics_model->get_alumni_by_graduation_year(),
            'employment_by_industry' => $this->Analytics_model->get_employment_by_industry(),
            'top_employers' => $this->Analytics_model->get_top_employers(),
            'common_job_titles' => $this->Analytics_model->get_common_job_titles(),
            'geographic_distribution' => $this->Analytics_model->get_geographic_distribution(),
            'certification_trends' => $this->Analytics_model->get_certification_trends(),
            'course_trends' => $this->Analytics_model->get_course_trends()
        ];

        $this->log_api_usage($token, 200);

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($charts, JSON_PRETTY_PRINT));
    }
}
