<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Base_Controller extends REST_Controller{

    var $data = array(
        'message' => '',
        'status' => 'success',
        'data' => null
    );
    var $roles = [];
    var $role_check = [];
    var $is_secure = false;

    function __construct($config = 'rest',$secure=FALSE) {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST,GET,PUT,DELETE");
        header('Access-Control-Allow-Headers: Authorization');
        parent::__construct($config);
        $this->is_secure = $secure;
        //apakah secure?
        if($this->is_secure == TRUE){
            //token
            $token = $this->input->get_request_header('Authorization', TRUE);
            if(!$token){
                $token = $_GET['token'];
                if(!$token){
                    //forbidden
                    $this->data['status'] = 'failed';
                    $this->data['message'] = 'token tidak ada atau tidak valid';
                    $this->response($this->data,REST_Controller::HTTP_FORBIDDEN);
                }
            }
            //cek token
            $this->load->model('users_model','user');
            $num_row =  $this->user->cek_token($token);
            if($num_row == 0){
                $this->data['status'] = 'failed';
                $this->data['message'] = 'token tidak ada atau tidak valid';
                $this->response($this->data,REST_Controller::HTTP_FORBIDDEN);
            }
            //get role
            $user = $this->user->id_user_by_token($token);
            if($user){
                $user_roles = $this->ion_auth->get_users_groups($user['id'])->result_array();
                foreach($user_roles as $role){
                   $this->roles[] = $role['name'];
                }
            }else{
                $this->data['status'] = 'failed';
                $this->data['message'] = 'data user tidak valid';
                $this->response($this->data,REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }

        }
    }

    private function role_check() {
        foreach ($this->role_check as $key => $value) {
            if (in_array($value, $this->roles)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    protected function is_authorized($roles = []) {
        if ($this->is_secure == TRUE) {
            $this->role_check = $roles;
            if ($this->role_check() === FALSE) {
                $this->data['status'] = 'failed';
                $this->data['message'] = 'anda tidak berhak mengakses halaman ini';
                $this->response( $this->data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
    }

}
?>