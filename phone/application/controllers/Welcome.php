<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public $time;
    public function __construct()
    {
        parent::__construct();
        $this->time = time();
        $this->load->helper('admin','cookie');
        $this->load->model(array('admin_mod'));
    }

    public function index()
  	{
      $this->load->view('admin_welcome.html');
  	}
    
    //登录
    public function login()
    {
      $arr = $_POST;
      $info = $this->admin_mod->get_admin_by_name($_POST['name']);
      $state = 0;
      
      if($info)
      {
        if($info['wrongNum']>=3||$info['lock']==1)
        {
          $this->admin_mod->lock_admin($info['id']);
          $msg = "账号被锁定，请联系管理员解锁";
        }
        else if($info['password']==md5_password($_POST['password']))
        {
          $identifier = get_user_identifier($_POST['name']);
          $token = get_user_token();
          $timeout = time() + 60 * 60 * 24 * 7;
          //设置cookie
          setcookie('name', $info['name'], $timeout,"/");
          setcookie('auth', $identifier.":".$token, $timeout,"/");
          //更新数据库
          $update_arr = array(
              "token"=>$token,
              "timeout"=>date('Y-m-d H:i:s',$timeout),
              "lastDate"=>date('Y-m-d H:i:s'),
              "lastIp"=>getIP(),
              "loginNum"=>$info["loginNum"]+1
          );
          $this->admin_mod->update_admin($update_arr,$info['id']);

          $state = 1;
          $msg = "登录成功";
        }
        else
        {
          //$update_arr = array("wrongNum"=>"wrongNum+1");
          $this->admin_mod->wrong_password($info['id']);
          $msg = "密码错误";
        }
      }
      else
      {
          $msg = "用户名不存在";
      }
      $output = array("state"=>$state,"info"=>$msg);
      echo json_encode($output);
    }

    //登出
    public function logout()
    {
      setcookie('auth',"",time()-3600,"/");
      header("Location: /welcome"); 
      //header("Location: /admin"); 
    }

}
