<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Controller {
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('good_mod','sort_mod'));
    $this->lang->load('common', 'chinese');
    $this->load->library('session');
	}

  public function index()
  {

  }
  //注册邮件发送
  public function send_email($to_email)
  {

    $to_email = '460569137@qq.com';

    $captcha = generate_captcha();

    $this->load->library('email');

    $this->email->from('18768122041@163.com', $this->lang->line('email_name'));
    $this->email->to($to_email);

    $this->email->subject($this->lang->line('user_register'));
    $this->email->message($this->lang->line('send_email_info').'<br>'.$captcha);

    $this->email->send();
    $this->session->set_userdata('captcha', $captcha);

    $output = array();
    $output['state'] = 1;
    echo json_encode($output);
  }

  //用于筛选的分类
  public function get_category()
  {
    $list = $this->sort_mod->get_filter_condition();
    echo json_encode($list);
  }

  //汇率 7天自动更新
  public function get_rate()
  {
    //汇率存放路径
    $rate_json_url = $_SERVER['DOCUMENT_ROOT'].'/json/rate.json';
    //汇率更新时间
    $rateUpdatePeriod = $this->config->item('rateUpdatePeriod');

    $json = file_get_contents($rate_json_url);
    $rate = json_decode($json, true);
    //超出周期重新获取
    if((time()-strtotime($rate['update']))>$rateUpdatePeriod)
    {
      $rate = $this->update_rate();
      file_put_contents($rate_json_url, json_encode($rate));
    }
    echo json_encode($rate);
  }

  public function update_rate()
  {
  	$json = get('http://api.k780.com:88/?app=finance.rate&scur=CNY&tcur=EUR&appkey=23250&sign=b3c6698cefad755003800ed9bf9fdadf');
  	
  	$data = json_decode($json, true);
  	$rate = array();
  	if($data['success']==1)
  	{
  		$rate = $data["result"];

  	}
  	return $rate;
  }

 
}


