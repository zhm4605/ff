<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jane Wu
 * Date: 2016/7/26
 * Time: 19:20
 */
class Upload_mod extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_table = $this->getDb(DB_CENTER)->dbprefix.'upload_img';
        $this->_id = 'id';
    }

    public function get_fields($db, $select = '*', $where = array())
    {
        return parent::get_fields($db, $select, $where);
    }
}