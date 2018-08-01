<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Login extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config,false);
    }

    public function login_post() {
        if ($this->ion_auth->login($this->post('identity', TRUE),$this->post('password', TRUE), FALSE)) {
            $user = $this->ion_auth->where('email', $this->post('identity', TRUE))->user()->row_array();
            $user['group'] = $this->ion_auth->get_users_groups($user['id'])->result();
            //token
            $token = md5(rand(100000, 999999));
            $field = array(
                'token' => $token
            );
            $this->ion_auth->update($user['id'], $field);
            $user['token'] = $token;
            $this->data['status'] = "success";
            $this->data['data'] = $user;
        } else {
            $this->data['status'] = "failed";
            $this->data['message'] = "username atau password anda salah";
        }
        $this->response($this->data, REST_Controller::HTTP_OK);
    }

    public function cek_token_get(){
        $token = $this->input->get('token');
        $this->load->model('users_model','user');
        $num_row =  $this->user->cek_token($token);
        if($num_row == 0){
            $this->data['status'] = "failed";
            $this->data['message'] = "invalid token";
            $this->response($this->data, REST_Controller::HTTP_OK);
        }else{
            $this->data['message'] = "valid token";
            $this->response($this->data, REST_Controller::HTTP_OK);
        }
    }

    public function cek_token_post(){
        header('Access-Control-Allow-Headers: Authorization');
        $token = $this->input->get_request_header('Authorization', TRUE);
        $this->load->model('users_model','user');
        $num_row =  $this->user->cek_token($token);
        if($num_row == 0){
            $this->data['status'] = "failed";
            $this->data['message'] = "invalid token";
            $this->response($this->data, REST_Controller::HTTP_OK);
        }else{
            $this->data['message'] = "valid token";
            $this->response($this->data, REST_Controller::HTTP_OK);
        }
    }

}
?>