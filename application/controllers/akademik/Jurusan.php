<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Base_Controller.php';
class Jurusan extends Base_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config,FALSE);
        $this->load->model('jurusan_model','jur');
    }

    //form-data
    function save_post(){
        $data = [
            'kodejurusan' => $this->post('kodejurusan'),
            'namajurusan' => $this->post('namajurusan')
        ];
        $res = $this->jur->save_jurusan($data);
        if($res){
            $this->data['message'] = 'data berhasil disimpan';
            $this->data['data'] = $res;
            $this->response( $this->data);
        }else{
            $this->data['status'] = "failed";
            $this->data['message'] = 'data tidak berhasil disimpan';
        }
    }

    function update_post(){
        $id = $this->post('id');
        $data = [
            'kodejurusan' => $this->post('kodejurusan'),
            'namajurusan' => $this->post('namajurusan')
        ];
        $res = $this->jur->update_jurusan($id,$data);
        if($res){
            $this->data['message'] = 'data berhasil diubah';
            $this->data['data'] = $res;
            $this->response( $this->data);
        }else{
            $this->data['status'] = "failed";
            $this->data['message'] = 'data tidak berhasil diubah';
        }
    }

    //x-www-form-urlencoded
    function update_put(){
        //CI validation cannot validate PUT,manual validation
        $id = $this->get('id');
        $data = [
            'kodejurusan' => $this->put('kodejurusan'),
            'namajurusan' => $this->put('namajurusan')
        ];
        $res = $this->jur->update_jurusan($id, $data);
        if($res){
            $this->data['message'] = 'data berhasil diubah';
            $this->data['data'] = $res;
            $this->response( $this->data);
        }else{
            $this->data['status'] = "failed";
            $this->data['message'] = 'data tidak berhasil diubah';
        }

    }

      //x-www-form-urlencoded
      function hapus_post(){
        //$this->is_authorized(['admin']);
        $id = $this->post('id');
        $res = $this->jur->hapus_jurusan($id);
        if($res){
            $this->data['message'] = 'data berhasil dihapus';
            $this->data['data'] = $res;
            $this->response( $this->data);
        }else{
            $this->data['status'] = "failed";
            $this->data['message'] = 'data tidak berhasil dihapus';
        }
    }

    //x-www-form-urlencoded
    function hapus_delete(){
        //$this->is_authorized(['admin']);
        $id = $this->get('id');
        $res = $this->jur->hapus_jurusan($id);
        if($res){
            $this->data['message'] = 'data berhasil dihapus';
            $this->data['data'] = $res;
            $this->response( $this->data);
        }else{
            $this->data['status'] = "failed";
            $this->data['message'] = 'data tidak berhasil dihapus';
        }
    }

    function jurusan_by_id_get(){
        //$this->is_authorized(['admin']);
        $id = $this->get('id');
        $res = $this->jur->get_jurusan_by_id($id)->result_array();
        if($res){
            $this->data['message'] = '';
            $this->data['data'] = $res[0];
            $this->response( $this->data);
        }else{
            $this->data['status'] = "failed";
            $this->data['message'] = 'data tidak berhasil dihapus';
        }
    }

    function all_get(){
        //$this->is_authorized(['admin']);
        $res = $this->jur->get_jurusan()->result_array();
        if($res){
            $this->data['message'] = '';
            $this->data['data'] = $res;
            $this->response( $this->data);
        }else{
            $this->data['status'] = "failed";
            $this->data['message'] = 'data tidak berhasil dihapus';
        }
    }

}