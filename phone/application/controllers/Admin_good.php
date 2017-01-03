<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_good extends MY_Controller {
	public $_tpl_path = 'admin/admin/';
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('admin_mod','good_mod'));
		$this->load->helper('admin');
		//is_login();//?登陆
	}

    public function index(){
         $this->load->view('index/index.html');
    }

    public function addGood()
    {
    	
    }



}


