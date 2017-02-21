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

  //加入购物车
  public function add_good(){
    $data = $_POST;
    $login = $this->user_mod->is_login();
    if($login['state'])
    {
      $info = $login['info'];
      $data['user_id'] = $info['id'];
      $id = $this->cart_mod->add_good($data);
      if($id>0)
      {
        $output = array(
          "state"=>1,
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

  //从购物车中删除
  public function remove_good($id)
  {
    
  }
}


