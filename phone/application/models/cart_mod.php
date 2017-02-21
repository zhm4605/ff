<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//购物车
class Cart_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'shopping_cart';
	}

	//加入购物车
	public function add_good($data)
	{
		$this->db->set($data)->insert($this->_table);
		$id = $this->db->insert_id();		

		return $id;
	}

	//删除商品
	public function remove_good($id)
	{
		$this->db->where('id', $id)->delete($this->_table);
	}

	
	/************查询************/
	
	//商品列表（页码，排序方式）
	public function get_cart_list($where=array(),$page=1,$order='update_time')
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
	
	//某条记录
	public function get_cart_by_id()
	{

	}
	
}