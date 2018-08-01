<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function cek_token($token){
        $query = $this->db->query("SELECT email FROM users WHERE token='{$token}'");
        return $query->num_rows();
    }

    public function id_user_by_token($token){
        $row = $this->db->query("SELECT id FROM users WHERE token='{$token}'")->row_array();
        return  $row;
    }
}
?>
