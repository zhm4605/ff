<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Controller {
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('good_mod','sort_mod'));
	}

  public function index()
  {
    //$orderValidTime = $this->config->item('orderValidTime');
    //print_r($orderValidTime);
  }

  //汇率 7天自动更新
  public function get_rate()
  {
  	if(isset($_COOKIE['rate']))
  	{
  		$rate = json_decode($_COOKIE['rate'],true);
  	}
  	else
		{
			$rate = $this->update_rate();
		}
		print_r($rate);
  }

  public function update_rate()
  {
  	$json = get('http://api.k780.com:88/?app=finance.rate&scur=EUR&tcur=CNY&appkey=23250&sign=b3c6698cefad755003800ed9bf9fdadf');
  	
  	$data = json_decode($json, true);
  	$rate = array();
  	if($data['success']==1)
  	{
  		$rate = $data["result"];
  		$timeout = time() + 60 * 60 * 24 * 7;
  		setcookie('rate', json_encode($rate), $timeout,"/");
  	}
  	return $rate;
  }

 
}


