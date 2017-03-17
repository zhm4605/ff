<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//购物车
class Cart_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'user_cart';
		$this->_table_good = $this->getDb('')->dbprefix.'good';
		$this->_table_good_sort = $this->_table_good.'_sort';
	}

	public function get_cart_number($user_id)
	{
		$query = $this->db->where('user_id',$user_id)->get($this->_table);

		return $query->num_rows();
	}

	//加入购物车 相同商品增加数量
	public function add_good($data)
	{
		//print_r($data);
		$data = fetch_arr(array("user_id","good_id","sort_id","number"),$data);
		$data['add_time'] = date('Y-m-d H:i:s');

		//相同商品增加数量
		$where = fetch_arr(array("user_id","good_id","sort_id"),$data);
		$query = $this->db->select('id,number')->where($where)->get($this->_table);
		$has = $query->row_array();
		//print_r($has);
		if($has)
		{
			$id = $has['id'];
			$this->db->set('number',$has['number']+$data['number'])->where('id',$id)->update($this->_table);
		}
		else
		{
			$this->db->set($data)->insert($this->_table);
			$id = $this->db->insert_id();
		}
				
		if($id>0)
		{
			//更新
			$sql = "update ".$this->_table." c left join ".$this->_table_good." g on c.good_id=g.id set c.good_name=g.name,c.good_pic=g.pic_url,c.price=g.price_min where c.id='".$id."'";
			$this->db->query($sql);

			if(isset($data['sort_id'])&&$data['sort_id']>0)
			{
				$this->db->query("update ".$this->_table." c left join ".$this->_table_sort." s on c.sort_id=s.id set c.sorts=s.sorts,c.price=s.price where c.id='".$id."'");
			}
		}
		return $id;
	}

	//更新商品
	public function update_good($data,$id)
	{
		$data = fetch_arr(array("number","sort_id"),$data);
		//print_r($data);

		//更新sorts

		return $this->db->set($data)->where('id',$id)->update($this->_table);
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

		//print_r($where);

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
		$query = $this->db->select('id,good_id,user_id,number')->where("id",$id)->get($this->_table);
		return $query->row_array();
	}
	
}