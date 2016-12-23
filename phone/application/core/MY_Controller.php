<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: Jane Wu
 * Date: 2016/6/24
 * Time: 14:33
 */
class MY_Controller extends CI_Controller {
    public $MyLang;

    public function __construct(){
        parent::__construct();
        $this->load->library(array('MY_Lang','upload'));
//        $this->load->library('chinese');
	$this->load->model('admin_role_action_mod');
//        $this->checkAction();
        $this->__setLang();//语言
    }

    private function __setLang(){
        $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : '';

        if( !$lang ){
            if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
                $lang = preg_match( "/zh-c/i", substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4) ) ? 'Chinese' : 'English';
            }else{
                $lang = 'Chinese';
            }
        }
        define('LANG', $lang);
        MY_Lang::load(lang_file('controller'));
//        MY_Lang::load(lang_file('common'));
        MY_Lang::load(lang_file(APP));
        $this->MyLang = getLang();
    }

    public function view($view,$vars = array(),$return = FALSE)
    {
        //资源版本号
        $this->load->helper('version');
        $resources_v = unserialize(RESOURCES_V);
        $vars['css_v'] = $resources_v["css_v"];
        $vars['js_v'] = $resources_v["js_v"];
        $vars['img_v'] = $resources_v["img_v"];
        $vars['mz_version'] = $resources_v["mz_version"];
        //here well assgin the user login info add by verne
//        $connectInfo = $this->session->userdata('currentConnectInfo');
//        $vars['currentConnectInfo'] =  isset($connectInfo) && !empty($connectInfo) ?  $connectInfo : array();
        $vars['refreshLink'] = $this->session->userdata('refreshLink');

        $this->load->view($view,$vars,$return = FALSE);
    }

    /**
     *    获取分页信息  
     *    @return    array
     */
    function _get_page($page_per = 9)
    {
        $page = empty($_REQUEST['page']) ? 1 : intval($_REQUEST['page']);
        $start = ($page -1) * $page_per;

        return array('limit' => "{$start},{$page_per}", 'curr_page' => $page, 'pageper' => $page_per);
    }

    function _format_page(&$page, $num = 7)
    {
        $page['page_count'] = ceil($page['item_count'] / $page['pageper']);
        $mid = ceil($num / 2) - 1;

        if ($page['page_count'] <= $num)
        {
            $from = 1;
            $to   = $page['page_count'];
        }
        else
        {
            $from = $page['curr_page'] <= $mid ? 1 : $page['curr_page'] - $mid + 1;
            $to   = $from + $num - 1;
            $to > $page['page_count'] && $to = $page['page_count'];
        }

        /* 生成app=goods&act=view之类的URL */
        if (preg_match('/[&|\?]?page=\w+/i', $_SERVER['QUERY_STRING']) > 0)
        {
            $url_format = preg_replace('/[&|\?]?page=\w+/i', '', $_SERVER['QUERY_STRING']);
            $url_format = '?'.$url_format;
        }
        else
        {
            $url_format = '?'.$_SERVER['QUERY_STRING'];
        }

        $page['page_links'] = array();
        $page['first_link'] = ''; // 首页链接
        $page['first_suspen'] = ''; // 首页省略号
        $page['last_link'] = ''; // 尾页链接
        $page['last_suspen'] = ''; // 尾页省略号
        for ($i = $from; $i <= $to; $i++)
        {
            $page['page_links'][$i] = "{$url_format}&page={$i}";
        }
        if (($page['curr_page'] - $from) < ($page['curr_page'] -1) && $page['page_count'] > $num)
        {
            $page['first_link'] = "{$url_format}&page=1";
            if (($page['curr_page'] -1) - ($page['curr_page'] - $from) != 1)
            {
                $page['first_suspen'] = '..';
            }
        }
        if (($to - $page['curr_page']) < ($page['page_count'] - $page['curr_page']) && $page['page_count'] > $num)
        {
            $page['last_link'] = "{$url_format}&page=" . $page['page_count'];
            if (($page['page_count'] - $page['curr_page']) - ($to - $page['curr_page']) != 1)
            {
                $page['last_suspen'] = '..';
            }
        }

        $page['prev_link'] = $page['curr_page'] > $from ? "{$url_format}&page=" . ($page['curr_page'] - 1) : "";
        $page['next_link'] = $page['curr_page'] < $to ? "{$url_format}&page=" . ($page['curr_page'] + 1) : "";
    }

    //权限检查
    public function checkAction(){
        $currentUserRole = $this->session->userdata('currentUserRole');
        $role_id = $currentUserRole['role_id'] ? intval($currentUserRole['role_id']) : 0;
        $this->load->model('admin_role_action_mod');
        $controller = $this->router->class;
        $action = $this->router->method;
        $flag = true;
        if(in_array($controller,array('welcome','file'))){
            return $flag;
        }
        if(!$this->admin_role_action_mod->getUserCanActions(DB_CENTER,$role_id,$controller,$action)){
            $flag = false;
            showmsg('您未被赋予相应权限');die();
        }
        return $flag;
    }

    /**
     * 判断生产环境
     */
    function _get_environment()
    {
        switch (ENVIRONMENT) {
            case 'development':
                return 0;
                break;
            default:
                if (!isset($_SESSION["currentUser"]["roleId"]) || empty($_SESSION["currentUser"]["roleId"])) {
                    return 10014;       //登录后再操作
                } elseif ($_SESSION["currentUser"]["roleId"] == $_POST["roleId"]){
                    return 0;
                } else {
                    return 10013;       //不能操作别人的数据
                }
                break;
        }
    }
    //获得毫秒
    function getMillisecond() {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }

    //权限
    function _get_actions() {
        $mod = array();         //模块
        $mApp = array();        //从属于模块的controller
        $app = array();         //controller
        $act = array();         //action
        $currentUserRole = $this->session->userdata('currentUserRole');
        $role_id = $currentUserRole['role_id'] ? intval($currentUserRole['role_id']) : 0;
        $ret = $this->admin_role_action_mod->getCanActions(DB_CENTER, $role_id);
        // foreach ($ret as $k => $v) {
        //     if ($v['menu'] == 2) {
        //         $mod[$v['id']] = $v;
        //     } elseif($v['parent_id'] == 0) {
        //         $app[$v['id']] = $v;
        //     } else {
        //         $act[$v['parent_id']][$v['id']] = $v;
        //     }
        // }
        foreach ($ret as $k => $v) {
            if ($v['menu'] == 2) {
                $mod[$v['id']] = $v;
            }
        }
        foreach ($ret as $k => $v) {
            if ($v['menu'] == 1) {
                if (array_key_exists($v['parent_id'], $mod)) {
                    $mApp[$v['id']] = $v;
                } elseif ($v['parent_id'] == 0) {
                    $app[$v['id']] = $v;
                } else {
                    $act[$v['parent_id']][$v['id']] = $v;
                }
            }
        }
        $_SESSION['admin'] = array('model' => $mod, 'mApp' => $mApp, 'controller' => $app, 'action' => $act);
    }
}
