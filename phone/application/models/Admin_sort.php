<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_sort extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->getDb(DB_CENTER)->dbprefix.'admin';
		$this->_id = 'id';
	}

	
	
}