<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_audit_model extends CI_Model
{
    private $table = 'login_audit_logs';

    public function log_attempt($data)
    {
        return $this->db->insert($this->table, $data);
    }
}
