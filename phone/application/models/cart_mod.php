<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//购物车
class Cart_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'user_cart';
		$this->_table_good = $this->getDb('')->dbprefix.'good';
		$this->_table_sort = $this->_table_good.'_sort';
	}

	//加入购物车
	public function add_good($data)
	{
		$this->db->set($data)->insert($this->_table);
		$data['add_time'] = date('Y-m-d H:i:s');
		$id = $this->db->insert_id();		
		if($id>0)
		{
			//更新
			$this->db->query("update ".$this->_table." c left join ".$this->_table_good." g on c.good_id=g.id set c.good_name=g.name,c.good_pic=g.pic_url,c.price=g.priceMin where c.id='".$id."'");

			if(isset($data['sort_id'])&&$data['sort_id']>0)
			{
				$this->db->query("update ".$this->_table." c left join ".$this->_table_sort." s on c.sort_id=s.id set c.sorts=s.sorts,c.price=s.price where c.id='".$id."'");
			}
		}
		return $id;
	}

	//删除商品
	public function remove_good($id)
	{
		return $this->db->where('id', $id)->delete($this->_table);
	}

	
	/************查询************/
	
	//商品列表（页码，排序方式）
	public function get_cart_list($where=array(),$page=1,$order='add_time desc')
	{	
		$limit = $this->config->item('pageCount');
		//查询条件
		$this->db->start_cache();
		
		$basic_where = array();
		
		$where = array_merge($basic_where,$where);
		$this->db->where($where);
		$this->db->stop_cache();

		$this->db->select('id,good_id,good_name,good_pic,sort_id,sorts,number,price,add_time');
		$this->db->order_by($order);
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
	public function get_cart_by_id($id)
	{
		$query = $this->db->select('id,good_id,user_id,count')->get_where("id",$id);
		return $query->row_array();
	}
	
}