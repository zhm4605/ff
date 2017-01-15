<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_good extends MY_Controller {
	public $_tpl_path = 'admin/admin/';
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('admin_mod','good_mod','sort_mod'));
		$this->load->helper('admin');
		//is_login();//?登陆
	}

  public function index(){
    $this->load->view('index/index.html');
  }

  public function addGood()
  {
  	
  }

  public function default_sort()
  {
    $sort_config = ["5","6"];
    $arr = array();
    foreach ($sort_config as $key => $value) {
    	$arr[] = $this->sort_mod->get_sort_by_id($value);
    }
    echo json_encode($arr);
  }

  public function uploadPic()
  {
  	$time = time();
		$date = date('Ymd', $time);
		$folder = '/upload/'.$date;
		$folder_thumb = '/upload/'.$date.'/thumbnail';
	  $foldername = $_SERVER['DOCUMENT_ROOT'].$folder;
	  $foldername_thumbnail = $_SERVER['DOCUMENT_ROOT'].$folder_thumb;

	  //创建文件夹
	  if (!file_exists($foldername)) 
	  {
	    mkdir($foldername, 0777, true);
	  };
	  if (!file_exists($foldername_thumbnail)) 
	  {
	    mkdir($foldername_thumbnail, 0777, true);
	  }

	  $val = date("His", $time).'_'.rand(100,999);  //图片名称

		$fileName = iconv("UTF-8", "gb2312", $_FILES["file"]["name"]); 

		
		if($_FILES["file"]["type"]!='image/jpg'&&$_FILES["file"]["type"]!='image/jpeg'&&$_FILES["file"]["type"]!='png'&&$_FILES["file"]["type"]!='image/png')
		{
			$output = array("state"=>0,"tips"=>"请上传jpg/jpeg/png格式的图片");
			echo json_encode($output);
			exit();
		}; 

		if(($_FILES["file"]["size"] / 1024)>1024)
		{
			$output = array("state"=>0,"tips"=>"请上传小于1M的图片");
			echo json_encode($output);
			exit();
		}; 
		
    $list=explode(".",$fileName); 

    $picname = $val.".".$list[count($list)-1];

		$rootTo = $foldername."/".$picname;
		$thumbrootTo = $foldername_thumbnail."/".$picname;

		$url = $folder."/".$picname;
		$thumbUrl = $folder_thumb."/".$picname;

		if (!move_uploaded_file($_FILES['file']['tmp_name'],$rootTo)) {
			$output = array("state"=>0,"tips"=>"上传失败");
			echo json_encode($output);
		}
		else
		{
			$config = array();
			$config['image_library'] = 'gd2';
			$config['source_image'] = $rootTo;
			$config['new_image'] = $foldername_thumbnail;
			$config['create_thumb'] = TRUE;
			$config['thumb_marker'] = '';
			$config['maintain_ratio'] = false;
			$config['width']  = 300;
			$config['height']  = 300;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$output = array("state"=>1,"url"=>$url,"thumbUrl"=>$thumbUrl);
			echo json_encode($output);
		}
  }


}


