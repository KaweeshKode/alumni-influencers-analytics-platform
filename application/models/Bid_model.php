<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bid_model extends CI_Model
{
    private $table = 'bids';

    public function get_user_bid_for_slot($slot_id, $user_id)
    {
        return $this->db->get_where($this->table, [
            'slot_id' => $slot_id,
            'user_id' => $user_id
        ])->row();
    }

    public function create_bid($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_bid($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function get_highest_bid_for_slot($slot_id)
    {
        return $this->db
            ->where('slot_id', $slot_id)
            ->order_by('bid_amount', 'DESC')
            ->order_by('updated_at', 'ASC')
            ->limit(1)
            ->get($this->table)
            ->row();
    }

    public function get_all_bids_for_slot($slot_id)
    {
        return $this->db
            ->where('slot_id', $slot_id)
            ->order_by('bid_amount', 'DESC')
            ->get($this->table)
            ->result();
    }

    public function update_status_for_slot($slot_id, $winning_bid_id)
    {
        $this->db->where('slot_id', $slot_id)->update($this->table, [
            'bid_status' => 'losing'
        ]);

        return $this->db->where('id', $winning_bid_id)->update($this->table, [
            'bid_status' => 'winning'
        ]);
    }

    public function finalize_statuses($slot_id, $winning_bid_id)
    {
        $this->db->where('slot_id', $slot_id)->update($this->table, [
            'bid_status' => 'lost'
        ]);

        return $this->db->where('id', $winning_bid_id)->update($this->table, [
            'bid_status' => 'won'
        ]);
    }
}
