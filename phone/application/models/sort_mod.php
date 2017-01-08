<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sort_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'sorts';
		$this->_id = 'id';
	}

	public function update_sort($data,$id)
	{	
		$data["level"]=$this->get_level($data["parentId"]);
		
		if($this->db->set($data)->where('id',$id)->update($this->_table))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function add_sort($data)
	{
		$data["level"]=$this->get_level($data["parentId"]);
		if($this->db->set($data)->insert($this->_table))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	public function get_level($parentId)
	{
		if($parentId>0)
		{
			$query = $this->db->select('level')->get_where($this->_table, array('id' => $parentId));
			$result = $query->row_array();
			$level = $result["level"]+1;
		}
		else
		{
			$level = 0;
		}
		return $level;
	}

	public function remove_sort($id)
	{
		$this->db->where('id', $id)->delete($this->_table);
	}

	//分类列表
	public function get_sort_list($parentId=0,$level=0)
	{
		if($parentId>0)
		{
			$this->db->where('parentId',$parentId);
		}
		else
		{
			$this->db->where('level',0);
		}

		$query = $this->db->get($this->_table);
		$list = $query->result_array();

		foreach ($list as $key=>$item)
		{
		   $list[$key]["children"] = $this->get_sort_list($item['id']);
		}

		return $list;
	}
	//搜索分类列表
	public function get_simple_sort_list()
	{
		$query = $this->db->select('id,name')->get($this->_table);
		$list = $query->result_array();
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