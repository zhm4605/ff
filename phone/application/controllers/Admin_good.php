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

  public function uploadPic()
  {

  	//print_r($_FILES);
  	$time = time();
		$date = date('Ymd', $time);
	  $foldername = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$date;
	  $foldername_thumbnail = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$date.'/thumbnail';

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

		if (move_uploaded_file($_FILES['file']['tmp_name'],$rootTo)) {
			$output = array("state"=>0,"tips"=>"上传失败");
			echo json_encode($output);
			exit();
		}

		$output = array("url"=>$rootTo,"thumbUrl"=>$rootTo);
		echo json_encode($output);
  }


}


