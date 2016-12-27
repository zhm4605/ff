<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb(DB_CENTER)->dbprefix.'admin';
		$this->_id = 'id';
	}

	public function getAdmins($db, $limit=null,&$item_count){
	    $sql = "select A.*,AR.role_name from {$this->_table} A LEFT JOIN ". $this->getDb($db)->dbprefix ."admin_role AR on A.role_id = AR.id";
	    $item_count = $this->getSingle($db, "select count(*) from {$this->_table}");
	    $sql .= " limit {$limit}";
	    $res['result'] = $this->getList($db, $sql);
	    return $res;
	}
	
	public function get_by_username($db, $username){
		$data['username'] = $username;
		//$this->db->where('username', $username);
		//$this->db->limit(1);
		return  $this->get_compile_row($db, "*", $data);
	}
	
	public function dropItem($db, $table=null,$id){
		$retDb = $this->getDb($db);
		if($table){
			$table = $retDb->dbprefix.$table;
		}else{
			$table = $this->_table;
		}
		$sql = "DELETE FROM {$table} where id IN ($id)";
		return $retDb->query($sql);
	}
	
}