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

  public function goodList()
  {
    $where = isset($_POST)?$_POST:array();

    if(isset($where['page']))
    {
      $page=$where['page'];
      unset($where['page']);
    }
    else
    {
      $page=1;
    }
  	$output = $this->good_mod->get_good_list($where,$page);
  	echo json_encode($output);
  }

  public function goodDetails($id)
  {
  	$data = $this->good_mod->get_good_by_id($id);
    foreach ($data['sort_list'] as $key => $value) {
      $data['sort_list'][$key]["sorts"] = unserialize($data['sort_list'][$key]["sorts"]);
    }
    $data["sorts"] = unserialize($data["sorts"]);
    if(!$data["sorts"]){
       $data["sorts"] = array(); 
    }
    //商品所属分类
    $data["category"] = explode(',', $data["category"]);
    echo json_encode($data);
  }
}


