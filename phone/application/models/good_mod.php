<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Good_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'good';
		$this->_table_pic = $this->_table.'_pic';
		$this->_table_sort = $this->_table.'_sort';
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
		if(isset($pics))
		{
			foreach ($pics as $key => $value) {
				$value['goodId'] = $goodId;
				$this->db->set($value)->insert($this->_table_pic);
			}
		}
		
		return $goodId;
	}

	//添加、删除分类 ，添加、删除商品分类表  --商品编辑模板  --图片库
	/***********编辑商品***********/
	//更新商品基本信息
	public function update_good($data,$id)
	{	
		if(isset($data["pics"]))
		{
			unset($data["pics"]);
		}
		
		if($this->db->set($data)->where('id',$id)->update($this->_table))
		{
			return $id;
		}
		else
		{
			return false;
		}
	}

	/**商品图片操作**/
	//添加商品图片
	public function add_good_pic($data)
	{
		if($this->db->set($data)->insert($this->_table_pic))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
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
		else
		{
			return false;
		}
	}

	/**商品分类操作**/
	//设置子类的库存、价格
	public function update_good_sort($data,$goodId)
	{	
		$ids = array();
		foreach ($data as $key => $value) 
		{
			if(isset($value["id"]))
			{
				$id = $value["id"];
				$ids[] = $id;
				unset($value["id"]);
				$this->db->set($value)->where('id',$id)->update($this->_table_sort);
			}
			else
			{
				$value["goodId"] = $goodId;
				$this->db->set($value)->insert($this->_table_sort);
				$ids[] = $this->db->insert_id();
			}
		}
		//删除不存在的分类
		$this->db->where_not_in('id', $ids)->where('goodId', $goodId)->delete($this->_table_sort);
		//更新good的库存、价格
		if($this->db->query("update ".$this->_table." as g left join (select goodId,MIN(price) as priceMin,MAX(price) as priceMax,sum(remain) as remain from ".$this->_table_sort." where goodId='".$goodId."') s on s.goodId=g.id set g.priceMin=s.priceMin,g.priceMax=s.priceMax,g.remain=s.remain where g.id='".$goodId."'"))
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	/***********删除商品***********/
	//删除 --移动至商品垃圾站 商品主表、图片表、分类表
	public function move_good($id)
	{
		$data = $this->get_good_by_id($id);
		unset($data['id']);
		$sort_list = $data['sort_list'];
		unset($data['sort_list']);
		$pics = $data['pics'];
		unset($data['pics']);
		$this->db->set($data)->insert($this->_table.'_bin');
		foreach ($sort_list as $key => $value) {
			unset($value['id']);
			$this->db->set($value)->insert($this->_table_sort.'_bin');
		}
		foreach ($pics as $key => $value) {
			unset($value['id']);
			$this->db->set($value)->insert($this->_table_pic.'_bin');
		}
		$this->db->where('goodId', $id)->delete($this->_table_sort);
		$this->db->where('goodId', $id)->delete($this->_table_pic);

		return $this->db->where('id', $id)->delete($this->_table);


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
		$result = $query->result_array();
		foreach ($result as $key => $value) {
			if($value['sorts'])
			{
				$result[$key]['sorts'] = unserialize($value['sorts']);
			}
			else
			{
				$result[$key]['sorts'] = array();
			}
			
		}
		return $result;
	}

	//获取单个商品详情
	public function get_good_by_id($id)
	{
		$query = $this->db->get_where($this->_table, array('id' => $id));
		$data = $query->row_array();
		
		$query = $this->db->get_where($this->_table_pic, array('goodId' => $id));
		$data["pics"] = $query->result_array();

		$query = $this->db->get_where($this->_table_sort, array('goodId' => $id));
		$data['sort_list'] = $query->result_array();
		return $data;
	}

	//搜索商品
	public function get_good_by_key($key)
	{
		$query = $this->db->like('name', $key)->select('id as key,name as text')->get($this->_table);
		return $query->result_array();
	}
	
	
}