<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Featured_alumni_model extends CI_Model
{
    private $table = 'featured_alumni';

    public function create_featured_record($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function count_user_wins_for_month($user_id, $year, $month)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('YEAR(feature_date) =', $year, FALSE)
            ->where('MONTH(feature_date) =', $month, FALSE)
            ->count_all_results($this->table);
    }

    public function get_today_featured()
    {
        return $this->db->where('feature_date', date('Y-m-d'))->get($this->table)->row();
    }
}