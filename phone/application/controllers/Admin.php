<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	public $_tpl_path = 'admin/admin/';
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('admin_mod','admin_actions_mod','admin_role_mod','admin_role_action_mod','upload_mod'));
		$this->load->library('form_validation');
		$this->load->helper('admin');
		//is_login();//?登陆
	}

    public function index(){

         $this->load->view('index/index.html');
    }

    public function addAdmin(){
        //add admin
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $roles = $this->admin_role_mod->get_all(DB_CENTER);
            $data['roles'] = $roles;

            $this->view('admin/admin.form.php',$data);
        }else{
            $data = $_POST;
            unset($data['re_password']);
            $data['dateline'] = time();
            $data['password'] = md5($data['password']);
            $data['platform_id'] = isset($_POST['platform_id']) ? join(',',$_POST['platform_id']) : '';
            if($this->admin_mod->insert(DB_CENTER, $data)){
                $link[0]['link_url'] = '?app=admin';
                $link[0]['link_name'] = '返回列表';
                showmsg('保存成功', $link);
            }else{
                showmsg('保存失败');
            }
        }
    }

    public function editAdmin(){
        //edit admin
        if(!$id = intval($_GET['id'])){
            showmsg('参数有误');die;
        }
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = $this->admin_mod->get_one(DB_CENTER, $id);
            $roles = $this->admin_role_mod->get_all(DB_CENTER);
            $data['roles'] = $roles;
//            $data['platforms'] = $this->platform_mod->getPlatformNames();
            $this->view('admin/admin.form.php',$data);
        }
        else{
            $data = $_POST;
            unset($data['re_password']);
            $data['dateline'] = time();
            $data['salt'] = 'CwrFTvWR';
            if(!empty($data['password'])){
                $data['password'] = md532($data['password'], $data['salt']);
            }else{
                unset($data['password']);
            }
            $data['platform_id'] = isset($_POST['platform_id']) ? join(',',$_POST['platform_id']) : '';
            if($this->admin_mod->update(DB_CENTER, $id,$data)){
                $link[0]['link_url'] = '?app=admin';
                $link[0]['link_name'] = '返回列表';
                showmsg('保存成功', $link);
            }else{
                showmsg('保存失败');
            }
        }
    }

    public function permitAction(){
        // function list
        $actions = $this->admin_actions_mod->getActions(DB_CENTER);
        if(!$actions){
            $data['actions'] = false;
            $this->view('admin/permitAction.list.php',$data);return;
        }
        $action_tree = array();
        foreach($actions as $key=>$val)
        {
            $action_tree[$val['id']] = $val;
        }
        $tree =& $this->_tree($action_tree);
        /* 先根排序 */
        $sort_action = array();
        $action_childs = $tree->getChilds();
        foreach ($action_childs as $id)
        {
            $sort_action[] = array_merge($action_tree[$id],array('layer' => $tree->getLayer($id),'parent_children_valid'=>'true'));
        }
        /* 构造映射表（每个结点的父结点对应的行，从1开始） */
        $row = array(0 => 0);   // cate_id对应的row
        $map = array();         // parent_id对应的row
        foreach ($sort_action as $key => $action)
        {
            $row[$action['id']] = $key + 1;
            $map[] = $row[$action['parent_id']];
        }
        $data['map'] = json_encode($map);
        $data['cates'] = $sort_action;
        $this->view('admin/permitAction.list.php',$data);
    }

    public function addPermitAction(){
        //add function list
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data['actions']  = $this->admin_actions_mod->getActionTree(DB_CENTER);
            $data[] = time();
            $this->view('admin/permitAction.form.php',$data);
        }else{
            if($this->admin_actions_mod->insert(DB_CENTER, $_POST)){
                $link[0]['link_url'] = '?app=admin&act=permitAction';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg('保存成功', $link);
            }else{
                showmsg('保存失败');
            }
        }
    }


    /**
     * @param $cate_id
     * @return string '2,3,4' [说明：2是自身，3 ，4 是2的child]
     */
    private function _getChildCates(&$cate_id){
        $allCates = $this->acategory_mod->getCategorys();
        $acategories = array();
        foreach($allCates as $key=>$val)
        {
            $acategories[$val['id']] = $val;
        }
        $tree =& $this->_tree($acategories);

        $childs = $tree->getChilds($cate_id);
        if($childs){
            $ids = ','. join(',',$childs);
            $cate_id .= $ids;
        }
        return $cate_id;
    }

    /* 构造并返回树 */
    function &_tree($acategories){
        $this->load->helper('tree');
        $tree = new NodeTree();
        $tree->setTree($acategories, 'id', 'parent_id', 'action_name');
        return $tree;
    }

    /* 取得可以作为上级的商品分类数据 */
    function _get_options($except = NULL){
        $acategories = $this->acategory_mod->get_all(DB_CENTER, '*', array(), 0, 100);
        $tree =& $this->_tree($acategories);
        return $tree->getOptions(0, 0, $except);
    }

    public function Role(){
        //Role management list
        $data = array();
        $where = " where 1=1 ";
        $item_count = 0;
        $page = $this->_get_page(15);
        $games = $this->admin_role_mod->getRoleList(DB_CENTER,$where,$page['limit'],$item_count);
        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['admin'] = $games['result'];
        $this->view('admin/role.list.php',$data);
    }

    public function addRole(){
        //add role
        if($_SERVER["REQUEST_METHOD"] == "GET"){
//            $data['platforms'] = $this->platform_mod->getPlatformNames();
            $actions = $this->admin_actions_mod->getActionOptions(DB_CENTER);
            $data['actions'] = $actions;
            $this->view('admin/role.form.php',$data);
        }else{
            
            $data['role_name'] = $_POST['role_name'];
            $data['role_source'] = $_POST['role_source'];
//            $data['platform_id'] = join(',',$_POST['platform_id']);
            $data['desc'] = $_POST['desc'];
            $data['add_time'] = time();
            $insert_res= $this->admin_role_mod->insert(DB_CENTER, $data);
            $insert_id = $this->admin_role_mod->insert_id(DB_CENTER);
            if(isset($_POST['action_detail']) && count($_POST['action_detail']) > 0){
                foreach($_POST['action_detail'] as $key=>$val){
                    $actions['role_id'] = $insert_id;
                    $actions['action_id'] = $val;
                    $this->admin_role_action_mod->insert(DB_CENTER, $actions);
                }
            }
            if($insert_res){
                $link[0]['link_url'] = '?app=admin&act=Role';
                $link[0]['link_name'] = '返回列表';
                showmsg('保存成功', $link);
            }else{
                showmsg('保存失败');
            }
        }
    }

    public function editRole(){
        //edit Role
        if(!$id = intval($_GET['id'])){
            showmsg($this->MyLang['param_error']);die;
        }
        if($_SERVER["REQUEST_METHOD"] == "GET"){

            $data = $this->admin_role_mod->getRoleActions(DB_CENTER, $id);
            $actions = $this->admin_actions_mod->getActionOptions(DB_CENTER);
            $data['actions'] = $actions;
            $this->view('admin/role.form.php',$data);
        }
        else{

            $data['role_name'] = $_POST['role_name'];
            $data['role_source'] = $_POST['role_source'];
            $data['desc'] = $_POST['desc'];
            $data['add_time'] = time();
            $update_res = $this->admin_role_mod->update(DB_CENTER, $id,$data);
            if(isset($_POST['action_detail']) && count($_POST['action_detail']) > 0){
                $this->admin_role_action_mod->dropItem(DB_CENTER, null,$id);
                foreach($_POST['action_detail'] as $key=>$val){
                    $actions['role_id'] = $id;
                    $actions['action_id'] = $val;
                    $this->admin_role_action_mod->insert(DB_CENTER, $actions);
                }
            }
            if($update_res){
                $link[0]['link_url'] = '?app=admin&act=Role';
                $link[0]['link_name'] = '返回列表';
                showmsg('保存成功', $link);
            }else{
                showmsg('保存失败');
            }
        }
    }


    public function drop(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $id_arr = explode(',',$_GET['id']);
            foreach($id_arr as $k=>$v){
            	$id =  intval($v);
            	if(!$id){
            		showmsg('参数有误');die;
            	}elseif($id<2){
            		showmsg($this->MyLang['adminCannotDelete']);die;
            	}else{
            		$ids[] = $id;
            	}
            }
            

            $id = join(',',$ids);
            
            
            if($this->admin_mod->dropItem(DB_CENTER,null,$id)){
                $link[0]['link_url'] = '?app=admin';
                $link[0]['link_name'] = '返回列表';
                showmsg($this->MyLang['handle_success'], $link);die;
            }
        }
        showmsg($this->MyLang['param_error']);die;
    }

    public function dropRole(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
         
            $id_arr = explode(',',$_GET['id']);
            foreach($id_arr as $k=>$v){
            	$id =  intval($v);
            	if(!$id){
            		showmsg($this->MyLang['param_error']);die;
            	}elseif($id<2){
            		showmsg($this->MyLang['adminCannotDelete']);die;
            	}else{
            		$ids[] = $id;
            	}
            }
            
            $id = join(',',$ids);
            
            $this->admin_role_mod->dropItem(DB_CENTER,'admin_role',$id);
            $this->admin_role_action_mod->dropItem(DB_CENTER,null,$id);

            $link[0]['link_url'] = '?app=admin&act=role';
            $link[0]['link_name'] = $this->MyLang['back_list'];
            showmsg($this->MyLang['handle_success'], $link);die;
        }
        showmsg($this->MyLang['param_error']);die;
    }

}


