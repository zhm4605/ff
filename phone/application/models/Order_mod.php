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
		$query = $this->db->where($where)->get($this->_table);
		return $query->num_rows();
	}

	public function get_total_count($order_id)
	{
		$query = $this->db->like('order_id',$order_id,'after')->get($this->_table);

		return $query->num_rows();
	}

	//生成订单
	public function create_order($data,$user_id,$order_num)
	{
		$total_price = 0;
		$items = array();
		$list = $data["list"];
		foreach ($list as $key => $item) {
			$value = array(
				"user_id"=>$user_id,
				"good_id"=>$item["good_id"],
				"sort_id"=>$item["sort_id"],
				"number"=>$item["number"]
			);

			$query = $this->db->select('name as good_name,pic_url as good_pic,price_min as unit_price')->where('id',$item['good_id'])->get($this->_table_good);
			$good = $query->row_array();
			$value = array_merge($value,$good);

			if($item["sort_id"]>0)
			{
				$query = $this->db->select('sorts,price as unit_price')->where('id',$item['sort_id'])->get($this->_table_sort);
				$sort = $query->row_array();
				$value = array_merge($value,$sort);
			}

			$items[] = $value;
			$total_price += $value['number']*$value["unit_price"];
		}
		//地址
		$address_id = $data['address_id'];
		$query = $this->db->select('name,mobile,areatext as address')->where('id',$address_id)->get($this->_table_address);
		$address = $query->row_array();
		//状态 0未支付未发货 1已支付未发货 2未支付已发货 3已支付已发货 4确认收货已完成
		$order_arr = array(
			"order_num"=>$order_num,
			"user_id"=>$user_id,
			"total_price"=>$total_price,
			"state"=>0,  //未支付未发货
			"create_time"=>date('Y-m-d H:i:s')
		);
		$order_arr = array_merge($address,$order_arr);

		$this->db->set($order_arr)->insert($this->_table);
		$order_id = $this->db->insert_id();

		//订单子表
		//print_r($items);
		foreach ($items as $key => $item) {
			$item['order_id'] = $order_id;
			$this->db->set($item)->insert($this->_table_item);
			$item_id = $this->db->insert_id();
		}
		return $order_id;
	}

	//删除
	public function remove_order($id)
	{
		return $this->db->where('id', $id)->delete($this->_table);
	}

	
	/************查询************/
	
	//商品列表（页码，排序方式）
	public function get_order_list($where=array(),$page=1,$order='create_time desc')
	{	
		$limit = $this->config->item('pageCount');
		//查询条件
		$this->db->start_cache();
		
		$basic_where = array();
		
		$where = array_merge($basic_where,$where);
		$this->db->where($where);
		$this->db->stop_cache();

		//$this->db->select('*');
		$this->db->order_by($order);
		$this->db->limit($limit,($page-1)*$limit);
		$query = $this->db->get($this->_table);
		$result['list'] = $query->result_array();

		$query = $this->db->get($this->_table);
		$result['total'] = $query->num_rows();
		$this->db->flush_cache();
		$result['pageSize'] = $limit;
		$result['page'] = $page;

		foreach ($result['list'] as $key => $value) {
			$this->db->select('id,good_id,good_name,good_pic,sort_id,sorts,number,unit_price');
			$this->db->where('order_id',$value['id']);
			$query = $this->db->get($this->_table_item);
			$result['list'][$key]['items'] = $query->result_array();
		}
		//print_r($result);
		return $result;
	}	
	
	//某条记录
	public function get_order_by_id($id)
	{
		$query = $this->db->select('id,good_id,user_id,count')->get_where("id",$id);
		return $query->row_array();
	}
	
}