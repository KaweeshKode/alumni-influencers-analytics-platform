<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->load->model('Alumni_profile_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation', 'upload'));
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        $data['profile'] = $profile;
        $this->load->view('profile/dashboard', $data);
    }

    public function edit_main()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim');
            $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'trim');
            $this->form_validation->set_rules('graduation_year', 'Graduation Year', 'trim|integer');
            $this->form_validation->set_rules('current_job_title', 'Current Job Title', 'trim|max_length[150]');
            $this->form_validation->set_rules('current_company', 'Current Company', 'trim|max_length[150]');
            $this->form_validation->set_rules('industry_sector', 'Industry Sector', 'trim|max_length[150]');
            $this->form_validation->set_rules('location_city', 'City', 'trim|max_length[100]');
            $this->form_validation->set_rules('location_country', 'Country', 'trim|max_length[100]');
            $this->form_validation->set_rules('biography', 'Biography', 'trim');
            $this->form_validation->set_rules('linkedin_url', 'LinkedIn URL', 'trim|valid_url');

            if ($this->form_validation->run()) {
                $image_name = $profile ? $profile->profile_image : NULL;

                if (!empty($_FILES['profile_image']['name'])) {
                    $config['upload_path'] = FCPATH . 'uploads/profile_images/';
                    $config['allowed_types'] = 'jpg|jpeg|png|webp';
                    $config['max_size'] = 2048;
                    $config['encrypt_name'] = TRUE;

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, TRUE);
                    }

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('profile_image')) {
                        $upload_data = $this->upload->data();
                        $image_name = $upload_data['file_name'];
                    } else {
                        $data['profile'] = $profile;
                        $data['error'] = $this->upload->display_errors('', '');
                        return $this->load->view('profile/edit_main', $data);
                    }
                }

                $save_data = [
                    'user_id' => $user_id,
                    'phone_number' => $this->input->post('phone_number', TRUE),
                    'date_of_birth' => $this->input->post('date_of_birth', TRUE) ?: NULL,
                    'graduation_year' => $this->input->post('graduation_year', TRUE) ?: NULL,
                    'current_job_title' => $this->input->post('current_job_title', TRUE),
                    'current_company' => $this->input->post('current_company', TRUE),
                    'industry_sector' => $this->input->post('industry_sector', TRUE),
                    'location_city' => $this->input->post('location_city', TRUE),
                    'location_country' => $this->input->post('location_country', TRUE),
                    'biography' => $this->input->post('biography', TRUE),
                    'linkedin_url' => $this->input->post('linkedin_url', TRUE),
                    'profile_image' => $image_name
                ];

                if ($profile) {
                    $this->Alumni_profile_model->update_profile($user_id, $save_data);
                } else {
                    $this->Alumni_profile_model->create_profile($save_data);
                }

                redirect('profile');
            }
        }

        $data['profile'] = $profile;
        $this->load->view('profile/edit_main', $data);
    }

    public function degrees()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('profile/edit_main');
        }

        $this->load->model('Profile_degree_model');

        $data['degrees'] = $this->Profile_degree_model->get_all($profile->id);

        $this->load->view('profile/degrees', $data);
    }

    public function add_degree()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        $this->load->model('Profile_degree_model');

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('degree_name', 'Degree Name', 'required');
            $this->form_validation->set_rules('university_name', 'University', 'required');
            $this->form_validation->set_rules('official_degree_url', 'Degree URL', 'required|valid_url');
            $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

            if ($this->form_validation->run()) {
                $this->Profile_degree_model->create([
                    'profile_id' => $profile->id,
                    'degree_name' => $this->input->post('degree_name', TRUE),
                    'university_name' => $this->input->post('university_name', TRUE),
                    'official_degree_url' => $this->input->post('official_degree_url', TRUE),
                    'completion_date' => $this->input->post('completion_date', TRUE)
                ]);

                redirect('profile/degrees');
            }
        }

        $this->load->view('profile/degree_form');
    }

    public function edit_degree($id)
    {
        $this->load->model('Profile_degree_model');
        $degree = $this->Profile_degree_model->get_by_id($id);

        if (!$degree) {
            redirect('profile/degrees');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('degree_name', 'Degree Name', 'required');
            $this->form_validation->set_rules('university_name', 'University', 'required');
            $this->form_validation->set_rules('official_degree_url', 'Degree URL', 'required|valid_url');
            $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

            if ($this->form_validation->run()) {
                $this->Profile_degree_model->update($id, [
                    'degree_name' => $this->input->post('degree_name', TRUE),
                    'university_name' => $this->input->post('university_name', TRUE),
                    'official_degree_url' => $this->input->post('official_degree_url', TRUE),
                    'completion_date' => $this->input->post('completion_date', TRUE)
                ]);

                redirect('profile/degrees');
            }
        }

        $data['degree'] = $degree;
        $this->load->view('profile/degree_form', $data);
    }

    public function delete_degree($id)
    {
        $this->load->model('Profile_degree_model');
        $this->Profile_degree_model->delete($id);

        redirect('profile/degrees');
    }

    public function certifications()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('profile/edit_main');
        }

        $this->load->model('Profile_certification_model');
        $data['certifications'] = $this->Profile_certification_model->get_all($profile->id);

        $this->load->view('profile/certifications', $data);
    }

    public function add_certification()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('profile/edit_main');
        }

        $this->load->model('Profile_certification_model');

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('certification_name', 'Certification Name', 'required|trim');
            $this->form_validation->set_rules('provider_name', 'Provider Name', 'required|trim');
            $this->form_validation->set_rules('course_url', 'Course URL', 'required|trim|valid_url');
            $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

            if ($this->form_validation->run()) {
                $this->Profile_certification_model->create([
                    'profile_id' => $profile->id,
                    'certification_name' => $this->input->post('certification_name', TRUE),
                    'provider_name' => $this->input->post('provider_name', TRUE),
                    'course_url' => $this->input->post('course_url', TRUE),
                    'completion_date' => $this->input->post('completion_date', TRUE)
                ]);

                redirect('profile/certifications');
            }
        }

        $this->load->view('profile/certification_form');
    }

    public function edit_certification($id)
    {
        $this->load->model('Profile_certification_model');
        $certification = $this->Profile_certification_model->get_by_id($id);

        if (!$certification) {
            redirect('profile/certifications');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('certification_name', 'Certification Name', 'required|trim');
            $this->form_validation->set_rules('provider_name', 'Provider Name', 'required|trim');
            $this->form_validation->set_rules('course_url', 'Course URL', 'required|trim|valid_url');
            $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

            if ($this->form_validation->run()) {
                $this->Profile_certification_model->update($id, [
                    'certification_name' => $this->input->post('certification_name', TRUE),
                    'provider_name' => $this->input->post('provider_name', TRUE),
                    'course_url' => $this->input->post('course_url', TRUE),
                    'completion_date' => $this->input->post('completion_date', TRUE)
                ]);

                redirect('profile/certifications');
            }
        }

        $data['certification'] = $certification;
        $this->load->view('profile/certification_form', $data);
    }

    public function delete_certification($id)
    {
        $this->load->model('Profile_certification_model');
        $this->Profile_certification_model->delete($id);

        redirect('profile/certifications');
    }

    public function licences()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('profile/edit_main');
        }

        $this->load->model('Profile_licence_model');
        $data['licences'] = $this->Profile_licence_model->get_all($profile->id);

        $this->load->view('profile/licences', $data);
    }

    public function add_licence()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('profile/edit_main');
        }

        $this->load->model('Profile_licence_model');

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('licence_name', 'Licence Name', 'required|trim');
            $this->form_validation->set_rules('awarding_body', 'Awarding Body', 'required|trim');
            $this->form_validation->set_rules('awarding_body_url', 'Awarding Body URL', 'required|trim|valid_url');
            $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

            if ($this->form_validation->run()) {
                $this->Profile_licence_model->create([
                    'profile_id' => $profile->id,
                    'licence_name' => $this->input->post('licence_name', TRUE),
                    'awarding_body' => $this->input->post('awarding_body', TRUE),
                    'awarding_body_url' => $this->input->post('awarding_body_url', TRUE),
                    'completion_date' => $this->input->post('completion_date', TRUE)
                ]);

                redirect('profile/licences');
            }
        }

        $this->load->view('profile/licence_form');
    }

    public function edit_licence($id)
    {
        $this->load->model('Profile_licence_model');
        $licence = $this->Profile_licence_model->get_by_id($id);

        if (!$licence) {
            redirect('profile/licences');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('licence_name', 'Licence Name', 'required|trim');
            $this->form_validation->set_rules('awarding_body', 'Awarding Body', 'required|trim');
            $this->form_validation->set_rules('awarding_body_url', 'Awarding Body URL', 'required|trim|valid_url');
            $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

            if ($this->form_validation->run()) {
                $this->Profile_licence_model->update($id, [
                    'licence_name' => $this->input->post('licence_name', TRUE),
                    'awarding_body' => $this->input->post('awarding_body', TRUE),
                    'awarding_body_url' => $this->input->post('awarding_body_url', TRUE),
                    'completion_date' => $this->input->post('completion_date', TRUE)
                ]);

                redirect('profile/licences');
            }
        }

        $data['licence'] = $licence;
        $this->load->view('profile/licence_form', $data);
    }

    public function delete_licence($id)
    {
        $this->load->model('Profile_licence_model');
        $this->Profile_licence_model->delete($id);

        redirect('profile/licences');
    }

    public function short_courses()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('profile/edit_main');
        }

        $this->load->model('Profile_short_course_model');
        $data['short_courses'] = $this->Profile_short_course_model->get_all($profile->id);

        $this->load->view('profile/short_courses', $data);
    }

    public function add_short_course()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('profile/edit_main');
        }

        $this->load->model('Profile_short_course_model');

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('course_name', 'Course Name', 'required|trim');
            $this->form_validation->set_rules('provider_name', 'Provider Name', 'required|trim');
            $this->form_validation->set_rules('course_url', 'Course URL', 'required|trim|valid_url');
            $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

            if ($this->form_validation->run()) {
                $this->Profile_short_course_model->create([
                    'profile_id' => $profile->id,
                    'course_name' => $this->input->post('course_name', TRUE),
                    'provider_name' => $this->input->post('provider_name', TRUE),
                    'course_url' => $this->input->post('course_url', TRUE),
                    'completion_date' => $this->input->post('completion_date', TRUE)
                ]);

                redirect('profile/short_courses');
            }
        }

        $this->load->view('profile/short_course_form');
    }

    public function edit_short_course($id)
    {
        $this->load->model('Profile_short_course_model');
        $short_course = $this->Profile_short_course_model->get_by_id($id);

        if (!$short_course) {
            redirect('profile/short_courses');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('course_name', 'Course Name', 'required|trim');
            $this->form_validation->set_rules('provider_name', 'Provider Name', 'required|trim');
            $this->form_validation->set_rules('course_url', 'Course URL', 'required|trim|valid_url');
            $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

            if ($this->form_validation->run()) {
                $this->Profile_short_course_model->update($id, [
                    'course_name' => $this->input->post('course_name', TRUE),
                    'provider_name' => $this->input->post('provider_name', TRUE),
                    'course_url' => $this->input->post('course_url', TRUE),
                    'completion_date' => $this->input->post('completion_date', TRUE)
                ]);

                redirect('profile/short_courses');
            }
        }

        $data['short_course'] = $short_course;
        $this->load->view('profile/short_course_form', $data);
    }

    public function delete_short_course($id)
    {
        $this->load->model('Profile_short_course_model');
        $this->Profile_short_course_model->delete($id);

        redirect('profile/short_courses');
    }

    public function employment()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('profile/edit_main');
        }

        $this->load->model('Profile_employment_model');
        $data['employment_history'] = $this->Profile_employment_model->get_all($profile->id);

        $this->load->view('profile/employment', $data);
    }

    public function add_employment()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->Alumni_profile_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('profile/edit_main');
        }

        $this->load->model('Profile_employment_model');

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('job_title', 'Job Title', 'required|trim');
            $this->form_validation->set_rules('company_name', 'Company Name', 'required|trim');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required');
            $this->form_validation->set_rules('end_date', 'End Date', 'trim');
            $this->form_validation->set_rules('description', 'Description', 'trim');

            if ($this->form_validation->run()) {
                $is_current_job = $this->input->post('is_current_job') ? 1 : 0;
                $end_date = $is_current_job ? NULL : ($this->input->post('end_date', TRUE) ?: NULL);

                $this->Profile_employment_model->create([
                    'profile_id' => $profile->id,
                    'job_title' => $this->input->post('job_title', TRUE),
                    'company_name' => $this->input->post('company_name', TRUE),
                    'start_date' => $this->input->post('start_date', TRUE),
                    'end_date' => $end_date,
                    'is_current_job' => $is_current_job,
                    'description' => $this->input->post('description', TRUE)
                ]);

                redirect('profile/employment');
            }
        }

        $this->load->view('profile/employment_form');
    }

    public function edit_employment($id)
    {
        $this->load->model('Profile_employment_model');
        $employment = $this->Profile_employment_model->get_by_id($id);

        if (!$employment) {
            redirect('profile/employment');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('job_title', 'Job Title', 'required|trim');
            $this->form_validation->set_rules('company_name', 'Company Name', 'required|trim');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required');
            $this->form_validation->set_rules('end_date', 'End Date', 'trim');
            $this->form_validation->set_rules('description', 'Description', 'trim');

            if ($this->form_validation->run()) {
                $is_current_job = $this->input->post('is_current_job') ? 1 : 0;
                $end_date = $is_current_job ? NULL : ($this->input->post('end_date', TRUE) ?: NULL);

                $this->Profile_employment_model->update($id, [
                    'job_title' => $this->input->post('job_title', TRUE),
                    'company_name' => $this->input->post('company_name', TRUE),
                    'start_date' => $this->input->post('start_date', TRUE),
                    'end_date' => $end_date,
                    'is_current_job' => $is_current_job,
                    'description' => $this->input->post('description', TRUE)
                ]);

                redirect('profile/employment');
            }
        }

        $data['employment'] = $employment;
        $this->load->view('profile/employment_form', $data);
    }

    public function delete_employment($id)
    {
        $this->load->model('Profile_employment_model');
        $this->Profile_employment_model->delete($id);

        redirect('profile/employment');
    }
}
