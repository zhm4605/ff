<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MY_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model(array('cart_mod','user_mod'));

    $this->lang->load('cart', isset($_COOKIE['language'])?$_COOKIE['language']:'chinese');
  }

  public function index(){
    //$this->load->view('index.html');
  }

  //列表
  public function card_list()
  {
    $login = $this->user_mod->is_login();
    if($login['state'])
    {
      $user = $login['info'];
      $list = $this->cart_mod->get_cart_list(array('user_id',$user['id']));
      $output = array(
        "state"=>1,
        "info"=>$list
      );
    }
    else
    {
      $output = array(
        "state"=>2,
        "info"=>$this->$this->lang->line('unlogin')
      );
    }

  }

  //加入购物车
  public function add_good()
  {
    $data = $_POST;
    $login = $this->user_mod->is_login();
    if($login['state'])
    {
      $user = $login['info'];
      //用户id
      $data['user_id'] = $user['id'];
      $id = $this->cart_mod->add_good($data);
      if($id>0)
      {
        $output = array(
          "state"=>1,
          "info"=>$this->$this->lang->line('add_success')
        );
      }
      else
      {
        $output = array(
          "state"=>0,
          "info"=>$this->$this->lang->line('add_error')
        );
      }
    }
    else
    {
      $output = array(
        "state"=>2,
        "info"=>$this->$this->lang->line('unlogin')
      );
    }
    echo json_encode($output);
  }

  //删除
  public function remove_good($id)
  {
    $login = $this->user_mod->is_login();
    if($login['state'])
    {
      $user = $login["info"];
      $info = $this->cart_mod->get_cart_by_id($id);
      if($info['user_id']==$user['id'])
      {
        if($this->cart_mod->remove_good($id))
        {
          $output = array(
            "state"=>1,
            "info"=>$this->$this->lang->line('remove_success')
          );
        }
        else
        {
          $output = array(
            "state"=>0,
            "info"=>$this->$this->lang->line('remove_error')
          );
        }
      }

    }
    else
    {
      $output = array(
        "state"=>2,
        "info"=>$this->$this->lang->line('unlogin')
      );
    }
  }

}


