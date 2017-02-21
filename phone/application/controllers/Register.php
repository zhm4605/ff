<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {
    public $time;
    public function __construct()
    {
      parent::__construct();
      $this->time = time();
      $this->load->helper('common');
      $this->load->model(array('user_mod'));
      $this->load->library('session');

      $this->lang->load('common', 'chinese');
    }

    //注册
    public function index()
  	{
      $data = $_POST;
      $captcha = $_SESSION['captcha'];
      if($data['captcha']==$captcha)
      {
        $user = $this->user_mod->get_user(array('email'=>$data['email']));
        //用户已存在
        if($user)
        {
          $output = array(
            "state"=>2,
            "info"=>$this->lang->line('user_has_exist')
          );
        }
        else
        {
          $data["password"] = md5_password($data["password"]);
          $data["registerTime"] = date('Y-m-d H:i:s');
          $data["identifier"] = get_user_identifier($data['email']);
          $data["token"] = get_user_token();
          //添加用户
          if($this->user_mod->add_user($data))
          {
            $output = array(
              "state"=>1,
              "info"=>$this->lang->line('register_success')
            );
          }
          else
          {
            $output = array(
              "state"=>0,
              "info"=>$this->lang->line('register_later')
            );
          }
        } 
      }
      else
      {
        $output = array(
          "state"=>0,
          "info"=>$this->lang->line('captcha_error')
        );
      }
      echo json_encode($output);
  	}
    
    //登录
    public function login()
    {
      $arr = $_POST;

      $user = $this->user_mod->get_user(array('email'=>$arr['email']));
      $state = 0;
      
      if($user)
      {
        //密码错误超出5次，账号锁定
        if($user['password_wrong_count']>=5||$info['lock']==1)
        {
          $this->user_mod->lock_user($info['id']);

          $output = array("state"=>2,"info"=>$this->lang->line('account_locked'));
        }
        else if($user['password']==md5_password($arr['password']))
        {
          $identifier = get_user_identifier($arr['email']);
          $token = get_user_token();
          $timeout = time() + 60 * 60 * 24 * 7;
          //设置cookie
          setcookie('email', $user['email'], $timeout,"/home");
          setcookie('name', $user['name'], $timeout,"/home");
          setcookie('auth', $identifier.":".$token, $timeout,"/home");
          //更新数据库
          $update_arr = array(
              "token"=>$token,
              "timeout"=>date('Y-m-d H:i:s',$timeout),
              "last_login_time"=>date('Y-m-d H:i:s'),
              "last_ip"=>getIP(),
              "login_count"=>$info["login_count"]+1
          );
          $this->user_mod->update_user($update_arr,$info['id']);

          $output = array("state"=>1,"info"=>$this->lang->line('login_success'));
        }
        else  //密码错误
        {
          $this->user_mod->wrong_password($info['id']);
          $output = array("state"=>0,"info"=>$this->lang->line('user_inexist'));
        }
      }
      else
      {
        $output = array("state"=>3,"info"=>$this->lang->line('user_inexist'));
      }
      
      echo json_encode($output);
    }                 

    //登出
    public function logout()
    {
      setcookie('auth',"",time()-3600,"/home");
    }

}
