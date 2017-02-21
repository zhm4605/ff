<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'user';
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

	//更新管理员表
	public function update_user($data,$id)
	{	
		$this->db->set($data)->where('id',$id)->update($this->_table);
	}

	//是否登录
	function is_login()
	{
		$login = 0;
		$clean = array();
		list($identifier, $token) = explode(':', $_COOKIE['auth']);
 
		if (ctype_alnum($identifier) && ctype_alnum($token) && isset($_COOKIE['name']))
		{
		  $clean['identifier'] = $identifier;
		  $clean['token'] = $token;

		  $query = $this->db->select('id,name,token,timeout,login_count')->get_where($this->_table,array("identifier" => $clean["identifier"]));
			$info = $query->row_array();
			if($info&&date('Y-m-d H:i:s')<$info["timeout"]&&$clean["token"]==$info["token"]&&get_user_identifier($info['name'])==$clean["identifier"])
			{
				//自动登录成功，更新数据库
				//更新数据库
	      $data = array(
	          "timeout"=>date('Y-m-d H:i:s',strtotime("+1 week")),
	          "last_login_time"=>date('Y-m-d H:i:s')
	      );
				$this->update_user($data,$info['id']);
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

}