<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidding extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Featured_slot_model');
        $this->load->model('Bid_model');
        $this->load->model('Featured_alumni_model');
        $this->load->model('Bid_notification_model');

        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
        
        // Allow CLI access for terminal commands
        if ($this->input->is_cli_request()) {
            return;
        }

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
            return;
        }

        if ($this->session->userdata('user_role') !== 'alumnus') {
            show_error('Access denied. Only alumni users can access bidding.', 403);
            return;
        }
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        // FIX: use real current day slot, not hardcoded test date
        $slot = $this->Featured_slot_model->get_or_create_today_slot();

        $user_bid = $this->Bid_model->get_user_bid_for_slot($slot->id, $user_id);

        $year  = date('Y');
        $month = date('m');

        $wins_this_month = $this->Featured_alumni_model->count_user_wins_for_month($user_id, $year, $month);
        $remaining_slots = max(0, 3 - $wins_this_month);

        $data = [
            'slot'            => $slot,
            'user_bid'        => $user_bid,
            'wins_this_month' => $wins_this_month,
            'remaining_slots' => $remaining_slots
        ];

        $this->load->view('bidding/dashboard', $data);
    }

    public function place_bid()
    {
        $user_id = $this->session->userdata('user_id');
        $slot    = $this->Featured_slot_model->get_or_create_today_slot();

        // Extra safety: do not allow bids on an already-awarded slot
        if ($slot->status !== 'open') {
            $this->session->set_flashdata('error', 'This bidding slot is no longer open.');
            redirect('bidding');
        }

        $year  = date('Y');
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
                'slot_id'    => $slot->id,
                'user_id'    => $user_id,
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
            'user_id'           => $user_id,
            'slot_id'           => $slot->id,
            'notification_type' => 'status_update',
            'message'           => $status_message
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
        // FIX: do not allow normal browser users to trigger award
        if (!$this->input->is_cli_request()) {
            show_error('This action is only allowed via CLI/cron.', 403);
            return;
        }

        $slot = $this->Featured_slot_model->get_or_create_today_slot();

        if ($slot->status === 'awarded') {
            echo "Today's slot has already been awarded." . PHP_EOL;
            return;
        }

        $all_bids = $this->Bid_model->get_all_bids_for_slot($slot->id);

        if (empty($all_bids)) {
            echo "No bids found for today." . PHP_EOL;
            return;
        }

        // FIX: re-check eligibility at award time
        $eligible_winning_bid = null;

        foreach ($all_bids as $bid) {
            $wins_this_month = $this->Featured_alumni_model->count_user_wins_for_month(
                $bid->user_id,
                date('Y', strtotime($slot->slot_date)),
                date('m', strtotime($slot->slot_date))
            );

            if ($wins_this_month < 3) {
                $eligible_winning_bid = $bid;
                break;
            }
        }

        if (!$eligible_winning_bid) {
            echo "No eligible bidders found for today's slot." . PHP_EOL;
            return;
        }

        // FIX: make awarding atomic
        $this->db->trans_start();

        $this->Featured_slot_model->mark_awarded(
            $slot->id,
            $eligible_winning_bid->user_id,
            $eligible_winning_bid->id
        );

        $this->Bid_model->finalize_statuses($slot->id, $eligible_winning_bid->id);

        // Prevent duplicate featured record for same slot
        $already_featured = $this->Featured_alumni_model->get_by_slot_id($slot->id);
        if (!$already_featured) {
            $this->Featured_alumni_model->create_featured_record([
                'user_id'      => $eligible_winning_bid->user_id,
                'slot_id'      => $slot->id,
                'feature_date' => $slot->slot_date
            ]);
        }

        foreach ($all_bids as $bid) {
            $is_winner = ((int)$bid->id === (int)$eligible_winning_bid->id);

            $this->Bid_notification_model->create([
                'user_id'           => $bid->user_id,
                'slot_id'           => $slot->id,
                'notification_type' => $is_winner ? 'winner' : 'loser',
                'message'           => $is_winner
                    ? 'Congratulations! You won the featured alumni slot for ' . $slot->slot_date . '.'
                    : 'Your bid was not selected for the featured alumni slot on ' . $slot->slot_date . '.'
            ]);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo "Awarding failed due to a database error." . PHP_EOL;
            return;
        }

        echo "Today's slot awarded successfully." . PHP_EOL;
    }
}
