<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	public $_tpl_path = 'admin/admin/';
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('admin_mod'));
		$this->load->library('form_validation');
		$this->load->helper('admin');
    $this->admin_mod->is_login(); 
	}

  public function index(){
    $this->load->view('admin.html');
  }

    

}


