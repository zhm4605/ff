<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Good_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'good';
		$this->_table_pic = $this->getDb('')->dbprefix.'pic';
		$this->_table_sort = $this->getDb('')->dbprefix.'sort';
		$this->_id = 'id';
	}

	//添加商品
	public function add_good($data)
	{
		if(isset($data['pics']))
		{
			$pics = $data['pics'];
			unset($data['pics']);
		}
		$this->db->set($data);
		$this->db->insert($this->_table);

		$goodId = $this->db->insert_id();

		//插入商品图片
		foreach ($pics as $key => $value) {
			$value['goodId'] = $goodId;
			$this->db->set($value)->insert($this->_table_pic);
		}
	}

	//添加、删除分类 ，添加、删除商品分类表  --商品编辑模板  --图片库
	/***********编辑商品***********/
	//更新商品基本信息
	public function update_good($data,$id)
	{	
		$this->db->set($data)->where('id',$id)->update($this->_table);
	}

	/**商品图片操作**/
	//添加商品图片
	public function add_good_pic($data)
	{
		if($this->db->set($data)->insert($this->_table_pic))
		{
			retun true;
		}
	}

	//删除商品图片 --移动至图片垃圾站
	public function remove_good_pic($id)
	{
		$this->db->query("insert into ".$this->_table_pic."_bin select goodId,name,url from ".$this->_table_pic." where id='".$id."'");
		if($this->db->where('id', $id)->delete($this->_table_pic))
		{
			return true;
		}
	}

	/**商品分类操作**/
	//设置子类的库存、价格
	public function update_good_sort($data)
	{	
		$ids = array();
		foreach ($date as $key => $value) 
		{
			$id = $value["id"];
			$ids[] = $id;
			unset[$value["id"]];
			if($value["id"])
			{
				$this->db->set($value)->where('id',$id)->update($this->_table_sort);
			}
			else
			{
				$this->db->set($value)->insert($this->_table_sort);
				$ids[] = $this->db->insert_id();
			}
		}
		//删除不存在的分类
		$this->db->where_in('id', $ids)->delete($this->_table_sort);
		//更新good的sorts字段
	}


	/***********删除商品***********/
	//删除 --移动至商品垃圾站 商品主表、图片表、分类表
	public function move_good($id)
	{
		$data = $this->get_good_by_id($id);
		unset($data['id']);
		$this->db->set($data)->insert($this->_table.'_bin');

		$data = $this->get_good_by_id($id);
		unset($data['id']);
		$this->db->set($data)->insert($this->_table.'_bin');

		$this->db->where('id', $id)->delete($this->_table);
	}

	//彻底删除商品
	public function remove_good($id)
	{
		$this->db->where('id', $id)->delete($this->_table);
		$this->db->where('goodId', $id)->delete($this->_table."_sort");
		$this->db->where('goodId', $id)->delete($this->_table."_pic");
	}

	
	/************查询************/
	
	//商品列表（页码，排序方式）
	public function get_good_list($page=1,$order='updateTime')
	{	
		$this->db->order_by($order,'desc');
		$this->db->limit(($page-1)*20,20);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	//获取单个商品详情
	public function get_good_by_id($id)
	{
		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row_array();
	}

	//搜索商品
	public function get_good_by_key($key)
	{
		$query = $this->db->like('name', $key)->select('id as key,name as text')->get($this->_table);
		return $query->result_array();
	}
	
	
}