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
		//is_login();//?登陆
	}

    public function index(){

         $this->load->view('admin.html');
    }

    //登录
    public function login(){
    	$arr = $_POST;
    	$info = $this->admin_mod->get_admin_by_name($_POST['name']);
        $state = 0;
    	if($info)
    	{
    		if($info['password']==md5_password($_POST['password']))
    		{

                $state = 1;
                $msg = "登录成功";

                $identifier = get_user_identifier($_POST['name']);
                $token = get_user_token();
                $timeout = time() + 60 * 60 * 24 * 7;

                //设置cookie
                setcookie('auth', "$identifier:$token", $timeout);

                //更新数据库
                $update_arr = array(
                    "token"=>$token,
                    "timeout"=>date('Y-m-d H:i:s',$timeout),
                    "lastDate"=>date('Y-m-d H:i:s'),
                    "lastIp"=>getIP(),
                    "loginNum"=>$info["loginNum"]+1
                );
                $this->admin_mod->update_admin($data,$info['id']);
    		}
    		else
    		{
    			$msg = "密码错误";
    		}
    	}
    	else
    	{
    		$msg = "用户名不存在";
    	}
    }

}


