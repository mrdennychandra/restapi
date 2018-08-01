
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_Controller.php';
class Jurusan extends Base_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config,TRUE);
        $this->load->model('jurusan_model','jur');
    }

    //form-data
    function save_post(){
        if ($this->jur->run_validation()){
            $id = $this->jur->save();
            $this->data['message'] = 'data berhasil disimpan';
            $this->data['data'] = $id;
        }else{
            $this->data['status'] = "failed";
            $this->data['message'] = $this->jur->validation_errors;
        }
        $this->response( $this->data);
    }

    function update_post(){
        if ($this->jur->run_validation()){
            $id = $this->put('id');
            $res = $this->jur->save($id);
            $this->data['message'] = 'data berhasil diubah';
            $this->data['data'] = $res;
        }else{
            $this->data['status'] = "failed";
            $this->data['message'] = $this->jur->validation_errors;
        }
        $this->response( $this->data);
    }

    //x-www-form-urlencoded
    function update_put(){
        //CI validation cannot validate PUT,manual validation
        $id = $this->put('id');
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
            $this->data['message'] = $this->jur->validation_errors;
        }

    }

      //x-www-form-urlencoded
      function hapus_post(){
        //$this->is_authorized(['admin']);
        $id = $this->post('id');
        $res = $this->jur->delete($id);
        $this->data['message'] = 'data berhasil dihapus';
        $this->data['data'] = $res;
        $this->response( $this->data);
    }

    //x-www-form-urlencoded
    function hapus_delete(){
        //$this->is_authorized(['admin']);
        $id = $this->delete('id');
        $res = $this->jur->hapus_jurusan($id);
        $this->data['message'] = 'data berhasil dihapus';
        $this->data['data'] = $res;
        $this->response( $this->data);
    }

    function all_get(){
        $this->is_authorized(['admin']);
        $result = $this->jur->get()->result_array();
        $this->data['data'] = $result;
        $this->response($this->data);
    }

}