<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public $time;
    public function __construct()
    {
        parent::__construct();
        $this->time = time();
        $this->load->helper('admin','cookie');
        $this->load->model(array('admin_mod'));
    }

    public function index()
	{
        is_login();//?登陆
        $data['userInfo'] = $this->session->all_userdata();
        $this->view('common/bootindex',$data);
	}

    public function register()
    {
        $this->view('welcome/register');
    }

    public function login(){
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            $username = trim(addslashes($this->input->post('username')));
            $password = $this->input->post('password');
            if(empty($username)){
                showmsg('请输入用户名');
            } 

            if(empty($password)){
                showmsg('请输入密码');
            }
            //以用户名查信息
            $data = $this->admin_mod->get_by_username(DB_CENTER, $username);

            if(empty($data)){
                showmsg('用户输入有误');
            }

            if(md532($password) != $data['password']){
                showmsg('密码不正确');
            }

            //登陆成功
            $session = array(
                'user_id'	=> $data['id'],
                'user_name'	=> $data['username'],
                'login_time'=> $this->time,
                'login_ip'	=> $this->input->ip_address(),
                'last_login_time' => $data['login_time'],
                'last_login_ip'	=> $data['login_ip']
            );

            $_SESSION = $session;
            $this->role_info = $this->__setCurrentUserRole($data);
            //权限写入session
            //$_SESSION['currentModelId'] = 1;
            $this->_get_actions();
            //更新数据库
            $udata = array(
                'login_time'	=> $this->time,
                'login_ip'		=> $this->input->ip_address()
            );

            $this->admin_mod->update(DB_CENTER, $data['id'], $udata);
            $link[0]['link_url'] = '?app=welcome';
            $link[0]['link_name']= '后台管理首页';
            showmsg('登陆成功', $link);
        }

        $this->load->view('common/bootlogin');
    }

    public function __setCurrentUserRole($data = array()){
        $currentUserRole = $this->session->userdata('currentUserRole');
        if(!empty($data)){
            $this->session->unset_userdata('currentUserRole');
            $sesData['user_id'] = $data['id'];
            $sesData['user_name'] = $data['username'];
            $sesData['role_id'] = isset($data['role_id']) ? $data['role_id'] : 0;
            $this->load->model(array('admin_role_mod'));
            $role_info = $this->returnRoleInfoByRoleID($data['role_id']);
            $sesData['role_info'] = $role_info;
            $this->session->unset_userdata('currentUserRole');
            $this->session->set_userdata('currentUserRole',$sesData);
            return $sesData;
        }
        return $currentUserRole;
    }

    /**
     * @param $role_id
     * @return mixed
     */
    public function returnRoleInfoByRoleID($role_id)
    {
        $role_info = array();
        $this->load->model(array('admin_role_mod'));
        $role_info = $this->admin_role_mod->get_one(DB_CENTER, $role_id);

        $power_plus_num = 0;
        $currentUserPowerCode = decbin($power_plus_num);
        $role_info['power_code'] = $power_plus_num;
        $role_info['power_code_binary'] = $currentUserPowerCode;
        //$role_info['server_ids'] = empty($serverIds) ? '' :  implode(',', $serverIds);
        //$role_info['sIDs'] = empty($sIDs) ? '' :  implode(',', $sIDs);
        return $role_info;
    }

    //记录最后一次浏览的控制器
    public function refreshLink(){
        if(!(isset($_GET['refreshLink']) && !empty($_GET['refreshLink']))){
            $data = array();
            $data['msg'] = '参数错误';
            $this->_error($data);
        }
        $this->session->unset_userdata('refreshLink');
        delete_cookie('refreshLink');
        $refreshLink = array('link'=>$_GET['refreshLink'],'position'=>$_GET['position']);
        $this->session->set_userdata('refreshLink',$refreshLink);
        $data['msg'] = json_encode($refreshLink);
        $this->_error($data,0);
    }

    //登出
    public function loginout(){
        is_login();//登陆
        $this->session->sess_destroy();
        $link[0]['link_url'] = '?app=welcome&act=login';
        $link[0]['link_name']= '登陆';
        showmsg('退出成功', $link, 2);
    }

}
