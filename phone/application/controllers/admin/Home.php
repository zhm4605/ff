<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('admin_mod'));
		$this->load->helper('admin');
    $this->admin_mod->is_login();
	}

  public function index(){
    $this->load->view('admin.html');
  }

}


