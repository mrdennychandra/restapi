<?php

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    public function index_get(){
		$info = [
			'version' => '0.1-dev',
			'app' => 'rest api'
		];
        $this->response($info, REST_Controller::HTTP_OK);
    }

    function version_get() {
        $info = [
			'version' => '0.1-dev',
			'app' => [
                'name' => 'Rest API',
                'creator' => [
                    ['name' => 'denny','id' => '123456'],
                    ['name' => 'budi','id' => '123457']
                ]
            ]
		];
        $this->response($info, REST_Controller::HTTP_OK);
    }

    function index_obj_get() {

        $info = new stdClass();
		$info->version = '0.1-dev';
		$info->app = 'rest api';

        $this->response($info, REST_Controller::HTTP_OK);
    }

    function simpan_post() {
        $data = $_POST;
        $this->response($data, REST_Controller::HTTP_OK);
    }

    function testput_put(){
        print_r($this->get());
    }

    function testput_delete(){
        print_r($this->delete());
    }

    function upload_post(){
        $config['upload_path'] = FCPATH . 'assets/images/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 4000;
        $config['file_name'] = $this->post('file_name');
        $this->load->library('upload',$config);
        if (!$this->upload->do_upload('file')) {
            $this->response('upload gagal', REST_Controller::HTTP_OK);
        } else {
            $data = $this->upload->data();
            $this->response( $data, REST_Controller::HTTP_CREATED);
        }
    }
}
?>