<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('order_mod','user_mod'));

    $this->lang->load('order', isset($_COOKIE['language'])?$_COOKIE['language']:'chinese');
  }

  public function index(){
    //$this->load->view('index.html');
  }

  //array(1=>5,2=>6); 1号商品数量6 2号商品数量6
  /*array(
    array(
      "goodId"=>5,  
      "number"=>5 
    ),
  );
  */
  public function order_details()
  {
    $goods = array(
      array(
        "goodId"=>5,  
        "number"=>5 
      )
    );
    $login = $this->user_mod->is_login();
    print_r($login);
    if($login['state']==0)
    {
      //$user = $login['info'];
      $arr = array();
      $list = array();
      foreach ($goods as $key => $value) {
        $one = $this->order_mod->get_good_details(array("goodId"=>$value['goodId']));
        //$one = array
      }
      
      foreach ($list as $key => $value) {
        $list[$key]["count"] = $arr[$value['id']];
      }

      $address = $this->order_mod->get_address($user['id']);
      $output = array(
        "list"=>$list,
        "address"=>$address
      );
    }
    else
    {
      $output = array(
        "state"=>2,
        "info"=>$this->lang->line('unlogin')
      );
    }
    print_r($output);
  }
  //列表
  public function order_list()
  {
    $login = $this->user_mod->is_login();
    if($login['state'])
    {
      $user = $login['info'];
      $orders = $this->order_mod->get_order_list(array('user_id'=>$user['id']));
      $output = array(
        "state"=>1,
        "info"=>$orders
      );
    }
    else
    {
      $output = array(
        "state"=>2,
        "info"=>$this->lang->line('unlogin')
      );
    }
    echo json_encode($output);
  }

  //生成
  public function create_order()
  {
    $data = $_POST;
    $login = $this->user_mod->is_login();
    if($login['state'])
    {
      $user = $login['info'];
      //用户id
      $user_id = $user['id'];
      //编号 日期4位+用户id4位+随机数4位; count %date(Ym).用户id 4位% >8000 无法生成
      $order_num = date('ymd').str_pad(substr($user_id,-4),4,0,STR_PAD_LEFT).str_pad(rand(0,9999),4,0,STR_PAD_LEFT);
      $count = $this->order_mod->get_count(array('order_num'=>$order_num));
      if($count>0)
      {
        $total_count = $this->order_mod->get_total_count(substr($order_num,0,8));
        if($total_count>8000)
        {
          $output = array(
            "state"=>3,
            "info"=>$this->lang->line('uncreate_order')
          );
          echo json_encode($output);
          exit;
        }
        else
        {
          $order_num = generate_order_num();
        }
      }
      
      $id = $this->order_mod->create_order($data,$user['id'],$order_num);
      if($id>0)
      {
        $output = array(
          "state"=>1,
          "info"=>$this->lang->line('create_success')
        );
      }
      else
      {
        $output = array(
          "state"=>0,
          "info"=>$this->lang->line('create_error')
        );
      }
    }
    else
    {
      $output = array(
        "state"=>2,
        "info"=>$this->lang->line('unlogin')
      );
    }
    echo json_encode($output);
  }

  //订单编号
  private function generate_order_num()
  {
    $order_num = date('Ym').str_pad(substr($user_id,-4),4,0,STR_PAD_LEFT).str_pad(rand(0,9999),4,0,STR_PAD_LEFT);
    $count = $this->order_mod->get_count(array('order_num',$order_num));
    if($count>0)
    {
      generate_order_num();
    }
    else
    {
      return $order_num;
    }
  }

  //删除
  public function remove_order($id)
  {
    $login = $this->user_mod->is_login();
    if($login['state'])
    {
      $user = $login["info"];
      $info = $this->order_mod->get_order_by_id($id);
      if($info['user_id']==$user['id'])
      {
        if($this->order_mod->remove_good($id))
        {
          $output = array(
            "state"=>1,
            "info"=>$this->lang->line('remove_success')
          );
        }
        else
        {
          $output = array(
            "state"=>0,
            "info"=>$this->lang->line('remove_error')
          );
        }
      }

    }
    else
    {
      $output = array(
        "state"=>2,
        "info"=>$this->lang->line('unlogin')
      );
    }
  }
}