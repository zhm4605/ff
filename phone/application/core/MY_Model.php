<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: Jane Wu
 * Date: 2016/6/24
 * Time: 9:45
 */

class MY_Model extends CI_Model
{
    public $_table;
    public $_id;
    public $db_center;
    public $db_data;


    function __construct()
    {
        parent::__construct();
    }

    public function getDb($db) {
        switch ($db){
            case DB_DATA:
                return $this->load->database('phone', TRUE);
                break;
            default:
                return $this->load->database('phone', TRUE);;
                break;
        }
    }

    public function insert($db, $data)
    {
        $retDb = $this->getDb($db);
        return $retDb -> insert($this->_table, $data);
    }

    public function insert_id($db)
    {
        $retDb = $this->getDb($db);
        return $retDb->insert_id();
    }

    public function get_all($db, $select = "*", $where = array(), $start = 0, $length = 1000, $orderby = '')
    {
        $retDb = $this->getDb($db);
        if (is_array($select) && !empty($select)) {
            $select = implode(',', $select);
        }
        $retDb->select($select);
        if (!empty($orderby)) {
            list($field, $desc) = explode(' ', $orderby);
            $retDb->order_by($field, $desc);
        }
        $query = $retDb->get_where($this->_table, $where, (int)$length, (int)$start);
        return $query->result_array();
    }


    public function delete($db, $id, $feild = '')
    {
        $retDb = $this->getDb($db);
        $feild ? $retDb->where($feild, $id) : $retDb->where($this->_id, $id);
        $feild ? '' : $retDb->limit(1);
        return $retDb->delete($this->_table);
    }

    public function get_one($db, $id)
    {
        $retDb = $this->getDb($db);
        $query = $retDb->get_where($this->_table, array($this->_id => $id));
        return $query->row_array();
    }

    public function update($db, $id, $data)
    {
        $retDb = $this->getDb($db);
        $retDb->where($this->_id, $id);
        $retDb->limit(1);
        return $retDb->update($this->_table, $data);
    }


    public function tbl_count($db, $where = '')
    {
        $retDb = $this->getDb($db);
        if ($where) {
            $retDb->where($where);
        }
        return $retDb->count_all_results($this->_table);
    }

    public function get_fields($db, $select = '*', $where = array())
    {
        $retDb = $this->getDb($db);
        if (is_array($select) && !empty($select)) {
            $select = implode(',', $select);
        }
        $retDb->select($select);
        $query = $retDb->get_where($this->_table, $where);
        return $query->row_array();
    }

    //获取单条记录
    public function get_compile_row($db, $select = "*", $data)
    {
        $retDb = $this->getDb($db);
        $retDb->select($select);
        foreach ($data as $key => $val){
            $retDb->where($key, $val);
        }
        return $retDb->get($this->_table)->row_array();
    }

    public final function getSingle($db, $sql)
    {
        $result = $this->getDb($db)->query($sql);
        if (!is_array($result->row_array())) return;
        foreach ($result->row_array() as $value) {
            return $value;
        }
    }

    public final function getList($db, $sql)
    {
        return $this->getDb($db)->query($sql)->result_array();
    }

    public final function getRow($db, $sql)
    {
        return $this->getDb($db)->query($sql)->row_array();
    }
}


/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */