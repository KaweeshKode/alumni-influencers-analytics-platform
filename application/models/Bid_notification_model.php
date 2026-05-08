<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bid_notification_model extends CI_Model
{
    private $table = 'bid_notifications';

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_by_user($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->order_by('created_at', 'DESC')
            ->get($this->table)
            ->result();
    }

    public function mark_all_as_read($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->update($this->table, ['is_read' => 1]);
    }
}
