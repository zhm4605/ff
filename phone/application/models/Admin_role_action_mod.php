<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * author verne
 */
class Admin_role_action_mod extends MY_Model {
    public function __construct(){
        parent::__construct();
        $this->_table = $this->getDb(DB_CENTER)->dbprefix.'admin_role_action';
        $this->_id = 'id';
    }

    public function dropItem($db, $table=null,$id){
        $retDb = $this->getDb($db);
        if($table){
            $table = $retDb->dbprefix.$table;
        }else{
            $table = $this->_table;
        }
        $sql = "DELETE FROM {$table} where role_id IN ($id)";
        return $retDb->query($sql);
    }

    public function getItems($db, $ids,$table = 'admin_role_action'){
        $table = $this->getDb($db)->dbprefix.$table;
        $sql = "select * from {$table} where id in ($ids)";
        return $this->getList($db, $sql);
    }

    public function getUserCanActions($db, $role_id = 0,$class = null,$function = null){
        $sql = "select * from {$this->_table} ARA LEFT JOIN " .$this->db->dbprefix. "admin_actions AC on ARA.action_id = AC.id
        where role_id = {$role_id} AND controller = '{$class}' AND action = '{$function}'";
        $userCanActions = $this->getRow($db, $sql);
        if(empty($userCanActions)){
            return false;
        }
        return true;
    }

    public function getCanActions($db, $role_id = 0) {
        $resDb = $this->getDb($db);
        $resDb->select('*');
        $resDb->from($this->_table.' A');
        $resDb->join($resDb->dbprefix.'admin_actions B', 'A.action_id = B.id', 'left');
        $resDb->where('role_id',$role_id);
//        $resDb->where('menu', 1);
        $query = $resDb->get();
        return $query->result_array();

//        $sql = "select * from {$this->_table} ARA LEFT JOIN " .$this->db->dbprefix. "admin_actions AC on ARA.action_id = AC.id
//        where role_id = {$role_id}";
    }
}