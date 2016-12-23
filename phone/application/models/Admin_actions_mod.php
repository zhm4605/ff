<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_actions_mod extends MY_Model {

    public function __construct(){
        parent::__construct();
        $this->_table = $this->getDb(DB_CENTER)->dbprefix.'admin_actions';
        $this->_id = 'id';
    }

    public function getActions($db){
        $sql = "SELECT * from {$this->_table} WHERE status = 1";
        return $this->getList($db, $sql);
    }

    public function getActionTree($db){
        $sql = "SELECT id,parent_id,action_name from {$this->_table} WHERE status = 1";
        $cates = $res = $this->getList($db, $sql);
        $this->load->helper('html_tree');
        $tree = new tree($cates);
        $tree->icon = array('&nbsp;&nbsp;│&nbsp;','&nbsp;&nbsp;├─&nbsp;','&nbsp;&nbsp;└─&nbsp;');//树形图标
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';//三个空格
        $tree->init($cates);
        return $tree->get_tree(0, "<option value='\$id'>\$spacer\$action_name</option>\n");
    }

    public function dropItem($db, $table,$id){
        $retDb = $this->getDb($db);
        $table = $retDb->dbprefix.$table;
        $sql = "DELETE FROM {$table} where id IN ($id)";
        return $retDb->query($sql);
    }

    public function getActionOptions($db) {
        $data = $this->get_all($db, 'id, parent_id, action_name, desc', array('`desc`'=>'M','`status`' => 1,'menu!=' => 0));
        foreach ($data as $k => $v) {
            $res[$v['id']] = $v;
        }
        foreach ($res as $key => &$val) {
            $sqlApp = sprintf('SELECT id, parent_id, action_name, `desc` FROM %s WHERE `desc` = "C" AND `status` = 1 AND menu = 1 AND parent_id = %d', $this->_table, $val['id']);
            $val['childApp'] = $this->getList($db, $sqlApp);
            foreach ($val['childApp'] as $k2 => &$v2) {
                $v2['childAct'] = $this->get_all($db, 'id, parent_id, action_name, `desc`', array('`desc`'=>'A','`status`' => 1, 'parent_id' => $v2['id']));
            }
        }
        $res[0]['childApp'] = $this->get_all($db, 'id, parent_id, action_name, desc', array('`desc`'=>'C','`status`' => 1,'parent_id' => '0'));
        foreach ($res[0]['childApp'] as $key => &$val) {
            $val['childAct'] = $this->get_all($db, 'id, parent_id, action_name, `desc`', array('`desc`'=>'A','`status`' => 1, 'parent_id' => $val['id']));
        }
        return $res;
    }










}