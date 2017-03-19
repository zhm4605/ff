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

		$good_id = $this->db->insert_id();

		//插入商品图片
		if(isset($pics))
		{
			foreach ($pics as $key => $value) {
				$value['good_id'] = $good_id;
				$this->db->set($value)->insert($this->_table_pic);
			}
		}
		$this->update_good_pic($good_id);
		
		return $good_id;
	}
	//更新商品主图
	public function update_good_pic($good_id)
	{
		$this->db->query("update good a left join (select good_id,url from good_pic where good_id='".$good_id."' order by id limit 1) b on a.id=b.good_id set a.pic_url=b.url where a.id='".$good_id."'");

		//echo "update good a left join (select good_id,url from good_pic where good_id='".$good_id."' order by id limit 1) b on a.id=b.good_id set a.picUrl=b.url where a.id='".$good_id."'";
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
			$id = $this->db->insert_id();
			$this->update_good_pic($data['good_id']);
			return $id;
		}
		else
		{
			return false;
		}
		
	}

	//删除商品图片 --移动至图片垃圾站
	public function remove_good_pic($id)
	{
		$this->db->select('good_id');
		$this->db->where('id',$id);
		$query = $this->db->get($this->_table_pic);
		$result = $query->row_array();
		//print_r($result);
		$good_id = $result['good_id'];
		$this->db->query("insert into ".$this->_table_pic."_bin select good_id,name,url from ".$this->_table_pic." where id='".$id."'");
		if($this->db->where('id', $id)->delete($this->_table_pic))
		{
			$this->update_good_pic($good_id);
			return true;
		}
		else
		{
			return false;
		}
	}

	/**商品分类操作**/
	//设置子类的库存、价格
	public function update_good_sort($data,$good_id)
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
				$value["good_id"] = $good_id;
				$this->db->set($value)->insert($this->_table_sort);
				$ids[] = $this->db->insert_id();
			}
		}
		//删除不存在的分类
		$this->db->where_not_in('id', $ids)->where('good_id', $good_id)->delete($this->_table_sort);
		//更新good的库存、价格
		if($this->db->query("update ".$this->_table." as g left join (select good_id,MIN(price) as price_min,MAX(price) as price_max,sum(remain) as remain from ".$this->_table_sort." where good_id='".$good_id."') s on s.good_id=g.id set g.price_min=s.price_min,g.price_max=s.price_max,g.remain=s.remain where g.id='".$good_id."'"))
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
		$this->db->where('good_id', $id)->delete($this->_table_sort);
		$this->db->where('good_id', $id)->delete($this->_table_pic);

		return $this->db->where('id', $id)->delete($this->_table);


	}

	//彻底删除商品
	public function remove_good($id)
	{
		$this->db->where('id', $id)->delete($this->_table);
		$this->db->where('good_id', $id)->delete($this->_table."_sort");
		$this->db->where('good_id', $id)->delete($this->_table."_pic");
	}

	
	/************查询************/
	
	//商品列表（页码，排序方式）
	public function get_good_list($where=array(),$page=1,$order='update_time')
	{	
		$limit = $this->config->item('pageCount');
		//查询条件
		$this->db->start_cache();
		//分类
		if(isset($where['category']))
		{
			$category = $where['category'];
			unset($where['category']);
			if($category)
			{
				$this->db->like('category',$category);
			}
		}
		//名称
		if(isset($where['name']))
		{
			$name = $where['name'];
			unset($where['name']);
			if($name)
			{
				$this->db->like('name',$name);
			}
		}

		$basic_where = array(
			"lock"=>0,
			"UNIX_TIMESTAMP(putaway_time)<"=>time()
		);
		$where = array_merge($basic_where,$where);
		$this->db->where($where);
		$this->db->stop_cache();

		$this->db->select('id,name,price_min,price_max,pic_url,hot,update_time');
		$this->db->order_by($order,'desc');
		$this->db->limit($limit,($page-1)*$limit);
		$query = $this->db->get($this->_table);

		$result['list'] = $query->result_array();

		$query = $this->db->get($this->_table);
		$result['total'] = $query->num_rows();
		$this->db->flush_cache();
		$result['pageSize'] = $limit;
		$result['page'] = $page;
		return $result;
	}

	//后台商品列表
	public function admin_good_list($where=array(),$page=1,$order='update_time')
	{	
		$limit = $this->config->item('pageCount');
		$this->db->order_by($order,'desc');
		$this->db->limit($limit,($page-1)*$limit);
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
		
		$query = $this->db->select('id,id as uid,url')->get_where($this->_table_pic, array('good_id' => $id));
		$data["pics"] = $query->result_array();

		$query = $this->db->get_where($this->_table_sort, array('good_id' => $id));
		$data['sort_list'] = $query->result_array();
		return $data;
	}

	//搜索商品
	public function get_good_by_key($key)
	{
		$query = $this->db->like('name', $key)->select('id as key,name as text')->get($this->_table);
		return $query->result_array();
	}

	public function get_good($where)
	{
		$query = $this->db->where($where)->select('id')->get($this->_table);
		return $query->row_array();
	}
	
	public function add_url($list) 
	{
		foreach ($list as $key => $value) {
			$this->db->set(array("url"=>$value))->insert('goods_url');
		}
	}

	public function get_url($page)
	{
		//$this->db->order_by("id");
		//$this->db->limit(($page-1)*20,1);
		$limit = 1;
		$query = $this->db->order_by("id",'asc')->limit($limit,($page-1)*$limit)->get('goods_url');
		return $query->row_array();
	}
	
}