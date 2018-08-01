<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jurusan_model extends CI_Model {

    public $table = 'jurusan';

    public function __construct() {
        parent::__construct();
    }

    public function save_jurusan($data){
        return $this->db->insert($this->table, $data); 
    }

    public function update_jurusan($id,$data){
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }

    public function hapus_jurusan($id){
        $this->db->where('id', $id);
        return $this->db->delete($this->table); 
    }

    public function get_jurusan(){
        return $this->db->get($this->table);
    }

    public function get_jurusan_by_id($id){
        return $this->db->get_where($this->table, array('id' => $id));
    }
    
}
?>
