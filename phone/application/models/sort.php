<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sort extends MY_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function get_sort_list($parentId=0,$level=0)
	{
		if($parentId==0)
		{
			$sql = "select * from sorts where level=0";
		}
		else
		{
			$sql = "select * from sorts where parentId='".$parentId."'";
		}

		$query = $this->db->query($sql);
		$list = $query->result_array();

		foreach ($list as $key=>$item)
		{
		   $list[$key]["children"] = $this->get_sort_list($item['id']);
		}

		return $list;

	}
	
}