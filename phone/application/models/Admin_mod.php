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

	public function get_admin($where)
	{

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
		list($identifier, $token) = explode(':', $_COOKIE['auth']);
 
		if (ctype_alnum($identifier) && ctype_alnum($token))
		{
		  $clean['identifier'] = $identifier;
		  $clean['token'] = $token;

		  $query = $this->db->select('id,name,token,timeout,loginNum')->get_where($this->_table,array("identifier" => $clean["identifier"]));
			$info = $query->row_array();
			if($info&&date('Y-m-d H:i:s')<$info["timeout"]&&$clean["token"]==$info["token"]&&get_user_identifier($info['name'])==$clean["identifier"])
			{
				//自动登录成功，更新数据库
				//更新数据库
	      $data = array(
	          "timeout"=>date('Y-m-d H:i:s',strtotime("+1 week")),
	          "lastDate"=>date('Y-m-d H:i:s')
	      );
				$this->update_admin($data,$info['id']);
				$login = 1;
			}
		}

		if($login==0)  //自动登录失败
		{
			header("Location: /welcome"); 
			exit;
		}
	}

	public function update_password($oriPassword,$password)
  {
  	
  }

}