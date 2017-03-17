<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sort_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'sorts';
		$this->_id = 'id';
	}

	public function get_list()
	{
		$query = $this->db->select('id,name,category,parent_ids');

		return $query->result_array();
	}


	public function update_sort($data,$id)
	{	
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
		if($this->db->set($data)->insert($this->_table))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	public function get_level($parent_id)
	{
		if($parent_id>0)
		{
			$query = $this->db->select('level')->get_where($this->_table, array('id' => $parent_id));
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
		if($this->db->where('id', $id)->delete($this->_table)&&$this->db->where('parent_id', $id)->delete($this->_table))
		{
			return true;
		}
		else
		{
			return false;
		};
	}

	//分类列表
	public function get_sort_list($simple=false,$parent_id=0)
	{
		if($simple)
		{
			$this->db->select('id,name,parent_ids');
		}

		if($parent_id>0)
		{
			$this->db->where('parent_id',$parent_id);
		}
		else
		{
			$this->db->where('level',0);
		}

		$query = $this->db->get($this->_table);
		$list = $query->result_array();

		foreach ($list as $key=>$item)
		{
			$list[$key]["parent_ids"] = $list[$key]["parent_ids"]?explode(",", $list[$key]["parent_ids"]):array();
		  $list[$key]["children"] = $this->get_sort_list($simple,$item['id']);
		}

		return $list;
	}
	//搜索分类列表
	/*
	public function get_simple_sort_list()
	{
		$query = $this->db->select('id,name')->get($this->_table);
		$list = $query->result_array();
		return $list;
	}*/
	//目录分类
	public function get_filter_condition()
	{
		$this->db->select('id,name,parent_ids')->where('filter_condition','1');
		$query = $this->db->get($this->_table);
		$list = $query->result_array();
		$arr = array();
		foreach ($list as $key => $value) {
			$value['parent_ids'] = $value['parent_ids']?explode(',', $value['parent_ids']):array();
			$value['children'] = $this->get_sort_list(true,$value['id']);
			$arr[] = $value;
		}
		return $arr;
	}
	public function get_sort_by_id($id)
	{
		$query = $this->db->get_where($this->_table, array('id' => $id));
		$arr = $query->row_array();
		//$arr["children"] = $this->get_sort_list(true,$id);
		$arr["children"] = [];
		return $arr;
	}

	public function get_sort_by_key($key)
	{
		$query = $this->db->like('name', $key)->select('id ,name')->get($this->_table);
		return $query->result_array();
	}
	
	
}