<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidding extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->load->model('Featured_slot_model');
        $this->load->model('Bid_model');
        $this->load->model('Featured_alumni_model');
        $this->load->model('Bid_notification_model');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        // $slot = $this->Featured_slot_model->get_or_create_today_slot();
        $slot = $this->Featured_slot_model->get_or_create_today_slot('2026-04-06');
        $user_bid = $this->Bid_model->get_user_bid_for_slot($slot->id, $user_id);

        $year = date('Y');
        $month = date('m');
        $wins_this_month = $this->Featured_alumni_model->count_user_wins_for_month($user_id, $year, $month);
        $remaining_slots = max(0, 3 - $wins_this_month);

        $data = [
            'slot' => $slot,
            'user_bid' => $user_bid,
            'wins_this_month' => $wins_this_month,
            'remaining_slots' => $remaining_slots
        ];

        $this->load->view('bidding/dashboard', $data);
    }

    public function place_bid()
    {
        $user_id = $this->session->userdata('user_id');
        $slot = $this->Featured_slot_model->get_or_create_today_slot();

        $year = date('Y');
        $month = date('m');
        $wins_this_month = $this->Featured_alumni_model->count_user_wins_for_month($user_id, $year, $month);

        if ($wins_this_month >= 3) {
            $this->session->set_flashdata('error', 'You have already reached the 3 featured wins limit for this month.');
            redirect('bidding');
        }

        $existing_bid = $this->Bid_model->get_user_bid_for_slot($slot->id, $user_id);

        $this->form_validation->set_rules('bid_amount', 'Bid Amount', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() === FALSE) {
            $data['user_bid'] = $existing_bid;
            $this->load->view('bidding/place_bid', $data);
            return;
        }

        $new_amount = (float)$this->input->post('bid_amount', TRUE);

        if ($existing_bid) {
            if ($new_amount <= (float)$existing_bid->bid_amount) {
                $this->session->set_flashdata('error', 'Bid updates must be increase only.');
                redirect('bidding');
            }

            $this->Bid_model->update_bid($existing_bid->id, [
                'bid_amount' => $new_amount
            ]);
        } else {
            $this->Bid_model->create_bid([
                'slot_id' => $slot->id,
                'user_id' => $user_id,
                'bid_amount' => $new_amount,
                'bid_status' => 'losing'
            ]);
        }

        $highest_bid = $this->Bid_model->get_highest_bid_for_slot($slot->id);
        if ($highest_bid) {
            $this->Bid_model->update_status_for_slot($slot->id, $highest_bid->id);
        }

        $user_bid = $this->Bid_model->get_user_bid_for_slot($slot->id, $user_id);

        $status_message = ($user_bid && $user_bid->bid_status === 'winning')
            ? 'You are currently winning this slot.'
            : 'You are currently losing this slot.';

        $this->Bid_notification_model->create([
            'user_id' => $user_id,
            'slot_id' => $slot->id,
            'notification_type' => 'status_update',
            'message' => $status_message
        ]);

        $this->session->set_flashdata('success', 'Bid submitted successfully.');
        redirect('bidding');
    }

    public function notifications()
    {
        $user_id = $this->session->userdata('user_id');
        $data['notifications'] = $this->Bid_notification_model->get_by_user($user_id);
        $this->load->view('bidding/notifications', $data);
    }

    public function award_today_slot()
    {
        $slot = $this->Featured_slot_model->get_or_create_today_slot();

        if ($slot->status === 'awarded') {
            echo 'Today\'s slot has already been awarded.';
            return;
        }

        $highest_bid = $this->Bid_model->get_highest_bid_for_slot($slot->id);

        if (!$highest_bid) {
            echo 'No bids found for today.';
            return;
        }

        $this->Featured_slot_model->mark_awarded($slot->id, $highest_bid->user_id, $highest_bid->id);
        $this->Bid_model->finalize_statuses($slot->id, $highest_bid->id);

        $this->Featured_alumni_model->create_featured_record([
            'user_id' => $highest_bid->user_id,
            'slot_id' => $slot->id,
            'feature_date' => $slot->slot_date
        ]);

        $all_bids = $this->Bid_model->get_all_bids_for_slot($slot->id);

        foreach ($all_bids as $bid) {
            $this->Bid_notification_model->create([
                'user_id' => $bid->user_id,
                'slot_id' => $slot->id,
                'notification_type' => ($bid->id == $highest_bid->id) ? 'winner' : 'loser',
                'message' => ($bid->id == $highest_bid->id)
                    ? 'Congratulations! You won the featured alumni slot for ' . $slot->slot_date . '.'
                    : 'Your bid was not selected for the featured alumni slot on ' . $slot->slot_date . '.'
            ]);
        }

        echo 'Today\'s slot awarded successfully.';
    }
}