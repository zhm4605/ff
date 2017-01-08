<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_sort extends MY_Controller {
	public $_tpl_path = 'admin/admin/';
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('admin_mod','sort_mod'));
		$this->load->library('form_validation');
		$this->load->helper('admin');
		//is_login();//?登陆
	}

    public function index(){

         $this->load->view('index/index.html');
    }

    //分类列表
    public function sortList($simple=false)
    {
        if($simple)
        {
            $list = $this->sort_mod->get_simple_sort_list();
        }
        else
        {
             $list = $this->sort_mod->get_sort_list();
        }
       
        echo json_encode($list);
    }
    
    //添加分类
    public function editSort($id=0)
    {
    	$data = $_POST;
    	if($id>0)
    	{
    		$state = $this->sort_mod->update_sort($data,$id);
    	}
    	else
    	{
    		$state = $this->sort_mod->add_sort($data);
    	}
        $output = array("state"=>$state);
        echo json_encode($output);
    }
    //删除分类
    public function removeSort()
    {
    	$id = $_GET['id'];
    	$this->sort_mod->remove_sort($id);
    }

    //搜索分类
    public function searchSort()
   	{
   		$key = $_GET['key'];
   		print_r($this->sort_mod->get_sort_by_key($key));
   	}

   	//单个分类详情
   	public function sortInfo($id)
   	{
   		echo json_encode($this->sort_mod->get_sort_by_id($id));
   	}

    //商品列表
    public function goodList()
    {

    }
    //添加商品 (保存，保存并发布)
    public function editGood()
    {
    	//基本信息，详情，分类
    }
    //删除商品
    public function removeGood()
    {
    	
    }
    
    

}


