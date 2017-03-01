<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_good extends MY_Controller {
	public $_tpl_path = 'admin/admin/';
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('admin_mod','good_mod','sort_mod'));
		$this->load->helper('admin','common');
		$this->admin_mod->is_login();
	}

  public function index(){
    $this->load->view('index/index.html');
  }

  //编辑商品信息
  public function editGood($id)
  {
  	$data = $_POST;

    //商品分类处理
    if(isset($data['category']))
    {
      $data['category'] = implode(',', $data['category']);
    }

  	if($id>0)
  	{
  		$id = $this->good_mod->update_good($data,$id);
  	}
  	else
  	{
      if($data['putaway_time']=="")
      {
        $data['putaway_time'] = date('Y-m-d H:i:s');
      }
  		$id = $this->good_mod->add_good($data);
  	}
  	$output = array("id"=>$id);
  	echo json_encode($output);
  }
  //商品默认分类
  public function defaultSort()
  {
    $sort_config = ["5","6"];
    $arr = array();
    foreach ($sort_config as $key => $value) {
    	$arr[] = $this->sort_mod->get_sort_by_id($value);
    }
    echo json_encode($arr);
  }
  //编辑商品分类
  public function editGoodSorts($id)
  {
  	$data = $_POST;

  	$sorts["sorts"]  = serialize($data['sorts']);
  	$id = $this->good_mod->update_good($sorts,$id);
  	

  	$sort_list = $data["sort_list"];
  	foreach ($sort_list as $key => $value) {
  		$sort_list[$key]["sorts"] = serialize($sort_list[$key]["sorts"]);
  	}

  	if($this->good_mod->update_good_sort($sort_list,$id))
  	{
  		$output = array("id"=>$id);
  	}
  	else
  	{
  		$output = array("id"=>0);
  	}

  	
  	echo json_encode($output);
  }
  //删除商品图片
  public function removePic($id)
  {
  	if($this->good_mod->remove_good_pic($id))
  	{
  		$state = 1;
  	}
  	else
  	{
  		$state = 0;
  	}
  	$output = array("state"=>$state);
  	echo json_encode($output);
  }
  //上传商品图片
  public function uploadPic($good_id)
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

			if($good_id>0)
			{
				$data = array(
					"good_id"=>$good_id,
					"url"=>$url
				);
				$id = $this->good_mod->add_good_pic($data);
			}

			$output = array("state"=>1,"url"=>$url,"thumbUrl"=>$thumbUrl);
			if(isset($id))
			{
				$output["id"] = $id;
			}
			echo json_encode($output);
		}
  }

  //删除商品
  public function removeGood($id)
  {
  	if($this->good_mod->move_good($id))
  	{
  		$output = array("state"=>1,"info"=>'删除成功');
  	}
  	else
  	{
  		$output = array("state"=>0,"info"=>'删除失败，请稍后重试');
  	}
  	echo json_encode($output);
  }

  //商品列表
  public function goodList()
  {
    $list = $this->good_mod->admin_good_list();
    echo json_encode($list);
  }
  //编辑商品详情
  public function goodDetails($id)
  {
    $data = $this->good_mod->get_good_by_id($id);
    foreach ($data['sort_list'] as $key => $value) {
      $data['sort_list'][$key]["sorts"] = unserialize($data['sort_list'][$key]["sorts"]);
    }
    $data["sorts"] = unserialize($data["sorts"]);

    //商品所属分类
    $data["category"] = explode(',', $data["category"]);
    echo json_encode($data);
  }
}


