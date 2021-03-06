<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_welcome extends MY_Controller {
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
      //$arr = array("name"=>"zhm","password"=>"123456");
      $info = $this->admin_mod->get_admin_by_name($arr['name']);
      $state = 0;
      $msg = '';
      if($info)
      {
        if($info['password_wrong_count']>=3||$info['lock']==1)
        {
          $this->admin_mod->lock_admin($info['id']);
          $msg = "账号被锁定，请联系管理员解锁";
        }
        else if($info['password']==md5_password($arr['password']))
        {
          $identifier = get_user_identifier($arr['name']);
          $token = get_user_token();
          $timeout = time() + 60 * 60 * 24 * 7;
          //设置cookie
          setcookie('admin_name', $info['name'], $timeout,"/admin");
          setcookie('admin_auth', $identifier.":".$token, $timeout,"/admin");
          //更新数据库
          $update_arr = array(
              "token"=>$token,
              "timeout"=>date('Y-m-d H:i:s',$timeout),
              "last_login_time"=>date('Y-m-d H:i:s'),
              "last_ip"=>getIP(),
              "login_count"=>$info["login_count"]+1
          );
          $this->admin_mod->update_admin($update_arr,$info['id']);

          $state = 1;
          $msg = "登录成功";
        }
        else
        {
          //$update_arr = array("password_wrong_count"=>"password_wrong_count+1");
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
      setcookie('admin_auth',"",time()-3600,"/admin");
      header("Location: /admin_welcome"); 
      //header("Location: /admin"); 
    }

}
