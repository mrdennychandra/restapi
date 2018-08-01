<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'models/Base_model.php';

class Jurusan_model extends Base_Model {

    public $table = 'jurusan';
    public $primary_key = 'jurusan.id';

    public function __construct() {
        parent::__construct();
    }

    //utk yang tidak bisa PUT
    public function update_jurusan($id,$data){
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }

    //untuk yang tidak bisa DELETE
    public function hapus_jurusan($id){
        $this->db->where('id', $id);
        return $this->db->delete($this->table); 
    }
    
    public function validation_rules(){
        return array(
            'kodejurusan' => array(
                'field' => 'kodejurusan',
                'label' => 'Kode Jurusan',
                'rules' => 'required'
            ),
            'namajurusan' => array(
                'field' => 'namajurusan',
                'label' => 'Nama Jurusan',
                'rules' => 'required'
            )
        );
    }
}
?>
