<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'user';
		$this->_table_address = $this->getDb('')->dbprefix.'user_address';
		$this->_id = 'id';
	}

	//注册，添加用户
	public function add_user($data)
	{
		$this->db->set($data)->insert($this->_table);

		$user_id = $this->db->insert_id();

		return $user_id;
	}

	//查询用户
	public function get_user($where) {
		$query = $this->db->get_where($this->_table,$where);
		return $query->row_array();
	}

	//获取密码
	public function get_password($where)
	{
		$query = $this->db->select('password')->get_where($this->_table,$where);
		$info = $query->row_array();
		return $info['password'];
	}

	//更新用户表
	public function update_user($data,$id)
	{	
		return $this->db->set($data)->where('id',$id)->update($this->_table);
	}

	//是否登录
	function is_login($auto=false)
	{
		$login = 0;
		//print_r($_COOKIE);
		if (isset($_COOKIE['auth']))
		{
			$clean = array();
			list($identifier, $token) = explode(':', $_COOKIE['auth']);

		  $clean['identifier'] = $identifier;
		  $clean['token'] = $token;
		  //print_r($clean);

		  $query = $this->db->select('id,name,token,login_count')->get_where($this->_table,array("identifier" => $clean["identifier"]));
			$info = $query->row_array();
			//print_r($info);

			if($info&&$clean["token"]==$info["token"]&&get_user_identifier($info['name'])==$clean["identifier"])
			{
				//自动登录成功，更新数据库
				//更新数据库
				if($auto)
				{
					$data = array(
		          "last_login_time"=>date('Y-m-d H:i:s')
		      );
					$this->update_user($data,$info['id']);
				}
	      
				$login = 1;
			}
		}
		$output = array("state"=>$login);
		if($login)
		{
			$output["info"] = $info;
		}
		return $output;
	}

	public function update_password($password,$where)
  {
  	$this->db->set("password",$password)->where($where)->update($this->_table);
  }

  public function wrong_password($id)
  {
  	$this->db->set('passowrd_wrong_count','passowrd_wrong_count+1', false)->where('id',$id)->update($this->_table);
  }

  public function lock_user($id)
  {
  	$this->db->set('lock','1')->where('id',$id)->update($this->_table);
  }

  //添加收货地址
  public function add_address($data)
  {
  	if(isset($data['default'])&&$data['default']==1)
  	{
  		$this->db->set("default",0)->where('user_id',$data['user_id'])->update($this->_table_address);
  	}
  	$this->db->set($data)->insert($this->_table_address);
  	$id = $this->db->insert_id();
  	
		return $id;
  }
  //编辑收货地址
  public function update_address($data,$where,$user_id)
  {
  	if(isset($data['default'])&&$data['default']==1)
  	{
  		$this->db->set("default",0)->where('user_id',$user_id)->update($this->_table_address);
  	}
  	$output = $this->db->set($data)->where($where)->update($this->_table_address);
  	
  	return $output;
  }
  //删除收货地址
  public function remove_address($where)
  {
  	return $this->db->where($where)->delete($this->_table_address);
  }

  public function address_list($where=array())
	{	
		//查询条件
		$this->db->where($where);

		$this->db->order_by('default desc,update_time desc');

		$query = $this->db->get($this->_table_address);

		$result = $query->result_array();

		return $result;
	}
	public function get_address($where)
	{
		$query = $this->db->where($where)->get($this->_table_address);
		return $query->row_array();
	}

}