<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model(array('user_mod'));
    }
    public function index(){
      $this->load->view('index.html');
    }

    public function get_login_state()
    {
        $data = $this->user_mod->is_login(true);
        echo json_encode($data);
    }
}


