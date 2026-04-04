<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Featured_slot_model extends CI_Model
{
    private $table = 'featured_slots';

    // public function get_or_create_today_slot()
    // {
    //     $today = date('Y-m-d');
    //     $slot = $this->db->get_where($this->table, ['slot_date' => $today])->row();

    //     if ($slot) {
    //         return $slot;
    //     }

    //     $this->db->insert($this->table, [
    //         'slot_date' => $today,
    //         'status' => 'open'
    //     ]);

    //     return $this->db->get_where($this->table, ['id' => $this->db->insert_id()])->row();
    // }

    public function get_or_create_today_slot($test_date = NULL)
    {
        $today = $test_date ? $test_date : date('Y-m-d');

        $slot = $this->db->get_where($this->table, ['slot_date' => $today])->row();

        if ($slot) {
            return $slot;
        }

        $this->db->insert($this->table, [
            'slot_date' => $today,
            'status' => 'open'
        ]);

        return $this->db->get_where($this->table, ['id' => $this->db->insert_id()])->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function mark_awarded($slot_id, $winner_user_id, $winning_bid_id)
    {
        return $this->db->where('id', $slot_id)->update($this->table, [
            'status' => 'awarded',
            'winner_user_id' => $winner_user_id,
            'winning_bid_id' => $winning_bid_id
        ]);
    }
}
