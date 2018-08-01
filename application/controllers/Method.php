<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Method extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get(){
        $nama = $this->get('nama');
        $this->response($nama);
    }

    function index_post(){
        $nama = $this->post('nama');
        $this->response($nama);
    }

    function index_put(){
        $nama = $this->put('nama');
        $this->response($nama);
    }

    function index_delete(){
        $nama = $this->delete('nama');
        $this->response('delete');
    }
}

