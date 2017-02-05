<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Good extends MY_Controller {
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('good_mod','sort_mod'));
		//$this->load->helper('admin');
		//is_login();//?登陆
	}

  public function index(){
    $this->load->view('index/index.html');
  }

  public function good_list()
  {
  	$list = $this->good_mod->get_good_list();
  	echo json_encode($list);
  }

  public function good_details($id)
  {
  	$output = $this->good_mod->get_good_by_id($id);
  	echo json_encode($output);
  }
}


