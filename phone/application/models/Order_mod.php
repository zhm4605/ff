<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//订单
class Order_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb('')->dbprefix.'user_order';
		$this->_table_item = $this->_table.'_item';

		$this->_table_good = $this->getDb('')->dbprefix.'good';
		$this->_table_sort = $this->_table_good.'_sort';

		$this->_table_address = $this->getDb('')->dbprefix.'user_address';

	}

	public function get_good_details($where)
	{
		$query = $this->db->select('id,name,pic_url')->where($where)->get($this->_table_good);
		return $query->row_array();
	}

	public function get_address($user_id)
	{
		$query = $this->db->select('id,name,mobile,areatext,defaut')->where('user_id',$user_id)->get($this->_table_address);
		return $query->result_array();
	}

	public function get_count($where)
	{
		$this->db->where($where)->from($this->_table);

		return $this->db->count_all_result();
	}

	public function get_total_count($order_id)
	{
		$this->db->like('order_id',$order_id,'after')->from($this->_table);

		return $this->db->count_all_result();
	}

	//生成订单
	public function create_order($data,$user_id)
	{
		//地址
		$address_id = $data['address_id'];
		$this->db->select('name,mobile,areatext as address')->where('id',$address_id)->get($this->_table_address);

		$address = $this->db->row_array();

		$order_arr = array(
			"user_id"=>$user_id,
			"total_price"=>$data['total_price'],
			"state"=>0,
			"create_time"=>date('Y-m-d H:i:s')
		);

		$order_arr = array_merge($address,$order_arr);

		$this->db->set()->insert($this->_table);
		$data['add_time'] = date('Y-m-d H:i:s');
		$order_id = $this->db->insert_id();

		//订单子表
		$list = $data["list"];
		foreach ($list as $key => $item) {
			$value = array(
				"user_id"=>$user_id,
				"order_id"=>$order_id,
				"good_id"=>$item["good_id"],
				"sort_id"=>$item["sort_id"],
				"number"=>$item["number"]
			);
			$this->db->set($value)->insert($this->_table_item);
			$item_id = $this->db->insert_id();

			$this->db->query("update ".$this->_table_item." i left join ".$this->_table_good." g on i.good_id=i.id set i.good_name=g.name,i.good_pic=g.pic_url,i.unit_price=g.price_min where i.id='".$item_id."'");
			if($item["sort_id"]>0)
			{
				$this->db->query("update ".$this->_table_item." i left join ".$this->_table_sort." s on s.id=i.sort_id set i.sorts=s.sorts,i.unit_price=s.price where i.id='".$item_id."'");
			}
		}
		
		
		
	}

	//删除
	public function remove_order($id)
	{
		return $this->db->where('id', $id)->delete($this->_table);
	}

	
	/************查询************/
	
	//商品列表（页码，排序方式）
	public function get_order_list($where=array(),$page=1,$order='add_time desc')
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
	public function get_order_by_id($id)
	{
		$query = $this->db->select('id,good_id,user_id,count')->get_where("id",$id);
		return $query->row_array();
	}
	
}