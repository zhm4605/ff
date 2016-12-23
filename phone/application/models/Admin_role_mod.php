<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_role_mod extends MY_Model {
    public function __construct(){
        parent::__construct();
        $this->_table = $this->getDb(DB_CENTER)->dbprefix.'admin_role';
        $this->_id = 'id';
    }

    public function getRoleList($db, $conditions,$limit=null,&$item_count){
        $sql = "SELECT * from {$this->_table} " . $conditions . " order by id DESC ";
        $item_count = $this->getSingle($db, "SELECT count(*) from {$this->_table} " . $conditions);
        $sql .= " limit {$limit}";
        $res['result'] = $this->getList($db, $sql);
        return $res;
    }

    public function dropItem($db, $table,$id){
        $retDb = $this->getDb($db);
        $table = $retDb->dbprefix.$table;
        $sql = "DELETE FROM {$table} where id IN ($id)";
        return $retDb->query($sql);
    }



    public function getItems($db, $ids,$table = 'admin_role'){
        $table = $this->getDb($db)->dbprefix.$table;
        $sql = "select * from {$table} where id in ($ids)";
        return $this->getList($db, $sql);
    }

    public function getRoleActions($db, $id){
        $role = $this->get_one($db, $id);
        if(count($role) > 0){
            $roleActionSql = "select * from {$this->getDb($db)->dbprefix}admin_role_action where role_id = '{$role['id']}'";
            $role['action_detail'] = $this->getList($db, $roleActionSql);
        }
        return $role;
    }
}