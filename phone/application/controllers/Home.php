<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct(){
        parent::__construct();

    }
    public function index(){
        $data = array();
        $this->view('index/index',$data);
    }

    public function basic(){
        $data = array("aa"=>"bb");
        echo json_encode($data);
    }

    public function upload()
    {
        echo json_encode($_FILES);
    }
    
}


