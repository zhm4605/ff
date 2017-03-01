<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	public $_tpl_path = 'admin/admin/';
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

  public function updatePassword()
  {
  	$originPassword = $_POST['originPassword'];
		$password = $_POST['password'];

  	list($identifier, $token) = explode(':', $_COOKIE['admin_auth']);
  	$where = array("identifier" => $identifier);

  	$actualPassword = $this->admin_mod->get_password($where);
  	if(md5_password($originPassword)==$actualPassword)
  	{
  		$this->admin_mod->update_password(md5_password($password),$where);
  		setcookie('auth',"",time()-3600,"/");
  		$output = array("state"=>1,"info"=>"密码修改成功，请重新登录");
  	}
  	else
  	{
  		$output = array("state"=>0,"info"=>"原密码错误");
  	}
  	echo json_encode($output);
  }
  
  public function updtae_admin()
  {
    $id = 1;
    $data = array(
      "password"=>md5_password('123456'),
      "identifier"=>get_user_identifier('zhm'),
      "token"=>get_user_token()
    );
    $this->admin_mod->update_admin($data,$id);
  }
  public function adminInfo()
  {
  	$output = array("name"=>$_COOKIE['admin_name']);
  	echo json_encode($output);
  }

}


