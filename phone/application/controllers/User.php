<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model(array('order_mod','user_mod'));

    $this->lang->load('user', isset($_COOKIE['language'])?$_COOKIE['language']:'chinese');
  }

  //更新用户信息
  public function update_user()
  {
  	$data = $_POST;
  	$login = $this->user_mod->is_login();
    if($login['state'])
    {
  		$user = $login['info'];
  		//可更新的用户信息
  		$keys = array("password","sex","mobile");
  		$data = fetch_arr($keys,$data)
  		if($this->user_mod->update_user($data,$user['id']))
  		{
  			$output = array(
	        "state"=>1,
	        "info"=>$this->lang->line('update_user_success')
	      );
  		}
  		else
  		{
  			$output = array(
	        "state"=>0,
	        "info"=>$this->lang->line('update_user_error')
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


  //编辑收货地址
  public function update_address($id)
  {
  	$data = $_POST;
  	$login = $this->user_mod->is_login();
    if($login['state'])
    {
  		$user = $login['info'];
  		if($id>0)
  		{
  			$where = array('id'=>$id,'user_id'=$user['id']);
  			$id = $this->user_mod->update_address($data,$where);
  		}
  		else
  		{
  			$data['user_id'] = $user['id'];
  			$id = $this->user_mod->add_address($data);
  		}
  		
  		if($id>0)
  		{
  			$output = array(
	        "state"=>1,
	        "info"=>$this->lang->line('add_address_success')
	      );
  		}
  		else
  		{
  			$output = array(
	        "state"=>0,
	        "info"=>$this->lang->line('add_address_error')
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
  public function remove_address($id)
  {
  	$data = $_POST;
  	$login = $this->user_mod->is_login();
    if($login['state'])
    {
  		$user = $login['info'];
  		$where = array('id'=>$id,'user_id'=$user['id']);

  		if($this->user_mod->remove_address($where))
  		{
  			$output = array(
	        "state"=>1,
	        "info"=>$this->lang->line('remove_address_success')
	      );
  		}
  		else
  		{
  			$output = array(
	        "state"=>0,
	        "info"=>$this->lang->line('remove_address_error')
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
  //收货地址列表
  public function address_list()
  {
    $data = $_POST;
    $login = $this->user_mod->is_login();
    if($login['state'])
    {
      $user = $login['info'];
      $where = array("user_id",$user['id']);

      $output = array(
        "state"=>1,
        "info"=>$this->user_mod->address_list($where)
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

  public function get_address($id){
    $output = $this->user_mod->get_address($id);
    echo json_encode($output);
  }

}