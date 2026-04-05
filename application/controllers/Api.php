<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Featured_alumni_model');
        $this->load->model('Alumni_profile_model');
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

        $profile = $this->Alumni_profile_model->get_by_user_id($featured->user_id);

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
            ]));
    }

    public function alumni()
    {
        $token = $this->require_bearer_token('read:alumni');

        $profiles = $this->db->get('alumni_profiles')->result();

        $this->log_api_usage($token, 200);
        $this->json_success($profiles);
    }

    public function analyticsSummary()
    {
        $token = $this->require_bearer_token('read:analytics');

        $summary = [
            'total_alumni'         => (int)$this->db->count_all('alumni_profiles'),
            'total_degrees'        => (int)$this->db->count_all('profile_degrees'),
            'total_certifications' => (int)$this->db->count_all('profile_certifications'),
            'total_short_courses'  => (int)$this->db->count_all('profile_short_courses')
        ];

        $this->log_api_usage($token, 200);
        $this->json_success($summary);
    }
}