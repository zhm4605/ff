<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Good_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'good';
		$this->_id = 'id';
	}

	//添加、删除分类 ，更新good的sorts字段，添加、删除商品分类表  --商品编辑模板  --图片库
	public function update_good($data,$id)
	{	
		$this->db->set($data)->where('id',$id)->update($this->_table);
	}

	public function add_good($data)
	{
		if(isset($data['pics']))
		{
			$pics = $data['pics'];
			unset($data['pics']);
		}
		$this->db->set($data);
		$this->db->insert($this->_table);

		$goodId = $this->db->insert_id()

		
	}
	//  一移动至商品垃圾站？
	public function remove_good($id)
	{
		$data = $this->get_good_by_id($id);
		unset($data['id']);
		$this->db->set($data)->insert($this->_table.'_bin');

		$this->db->where('id', $id)->delete($this->_table);
	}

	//删除商品图片 一移动至图片垃圾站
	public function remove_good_pic($id)
	{
		$this->db->where('id', $id)->delete($this->_table."_pic");
	}
	//添加商品图片
	public function add_good_pic()
	{

	}

	//更新某类的价格、库存
	public function update_good_sort($data,$id)
	{	
		$this->db->set($data)->where('id',$id)->update($this->_table.'_sort');
	}

	//设置某类的库存、价格
	public function add_good_sort($data)
	{	
		$this->db->set($data);
		$this->db->insert($this->_table.'_sort');
	}

	//删除商品分类  总分类
	public function remove_good_sort($sortId)
	{
		$this->db->like('sorts',$sortId.':')->delete($this->_table);
	}

	//删除商品分类  子分类
	public function remove_good_sort_child($sortId)
	{
		$this->db->like('sorts',':'.$sortId)->delete($this->_table);
	}

	

	public function get_good_list($page=1,$order='updateTime')
	{
		$this->db->order_by($order,'desc');
		$this->db->limit(($page-1)*20,20);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	public function get_good_by_id($id)
	{
		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row_array();
	}

	public function get_good_by_key($key)
	{
		$query = $this->db->like('name', $key)->select('id as key,name as text')->get($this->_table);
		return $query->result_array();
	}
	
	
}