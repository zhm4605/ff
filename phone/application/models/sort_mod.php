<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sort_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'sorts';
		$this->_id = 'id';
	}

	public function update_sort($data,$id)
	{	
		$this->db->set($data)->where('id',$id)->update($this->_table);
	}

	public function add_sort($data)
	{
		$this->db->set($data);
		$this->db->insert($this->_table);
		//$this->db->insert_id()
	}

	public function remove_sort($id)
	{
		$this->db->where('id', $id)->delete($this->_table);
	}

	public function get_sort_list($parentId=0,$level=0)
	{
		if($parentId==0)
		{
			$this->db->where('level',0);
		}
		else
		{
			$this->db->where('parentId',$parentId);
		}

		$query = $this->db->select('id as key,name as title')->get($this->_table);
		$list = $query->result_array();

		foreach ($list as $key=>$item)
		{
		   $list[$key]["children"] = $this->get_sort_list($item['key']);
		}

		return $list;

	}

	public function get_sort_by_id($id)
	{
		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row_array();
	}

	public function get_sort_by_key($key)
	{
		$query = $this->db->like('name', $key)->select('id ,name')->get($this->_table);
		return $query->result_array();
	}
	
	
}