<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'admin';
		$this->_id = 'id';
	}

	//查询用户名
	public function get_admin_by_name($name) {
		$query = $this->db->get_where($this->_table,array("name" => $name));
		return $query->row_array();
	}

	public function get_password($where)
	{
		$query = $this->db->select('password')->get_where($this->_table,$where);
		$info = $query->row_array();
		return $info['password'];
	}

	//更新管理员表
	public function update_admin($data,$id)
	{	
		$this->db->set($data)->where('id',$id)->update($this->_table);
	}

	//是否登录
	function is_login()
	{
		$login = 0;
		$clean = array();
		list($identifier, $token) = explode(':', $_COOKIE['admin_auth']);

		//print_r($_COOKIE);
 
		if (ctype_alnum($identifier) && ctype_alnum($token) && isset($_COOKIE['admin_name']))
		{
		  $clean['identifier'] = $identifier;
		  $clean['token'] = $token;

		  $query = $this->db->select('id,name,token,timeout,login_count')->get_where($this->_table,array("identifier" => $clean["identifier"]));
			$info = $query->row_array();
			//print_r($info);

			if($info&&date('Y-m-d H:i:s')<$info["timeout"]&&$clean["token"]==$info["token"]&&get_user_identifier($info['name'])==$clean["identifier"])
			{
				//自动登录成功，更新数据库
				//更新数据库
	      $data = array(
	          "timeout"=>date('Y-m-d H:i:s',strtotime("+1 week")),
	          "last_login_time"=>date('Y-m-d H:i:s')
	      );
				$this->update_admin($data,$info['id']);
				$login = 1;
			}
		}

		//echo $login;
		if($login==0)  //自动登录失败
		{
			header("Location: /admin_welcome"); 
			exit;
		}
	}

	public function update_password($password,$where)
  {
  	$this->db->set("password",$password)->where($where)->update($this->_table);
  }

  public function wrong_password($id)
  {
  	$this->db->set('passowrd_wrong_count','passowrd_wrong_count+1', false)->where('id',$id)->update($this->_table);
  }

  public function lock_admin($id)
  {
  	$this->db->set('lock','1')->where('id',$id)->update($this->_table);
  }

  //添加用户
  public function add_admin($data)
  {
  	$this->db->set($data)->insert($this->_table);
  	return $this->db->insert_id();	
  }

}