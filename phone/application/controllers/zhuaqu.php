<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zhuaqu extends MY_Controller {

    public function __construct(){
      parent::__construct();

      $this->load->model(array('sort_mod','good_mod'));

      $this->load->helper('simple_html_dom.php');
    }
    public function index(){
      //1085
      set_time_limit(30000);
      $page = $_GET['page'];
      $data = array();
      $value =  $this->good_mod->get_url($page);
      print_r($value);
      //$value = array('url'=>'https://magboss.pl/anti-fingerprint-color-film-mercury-2in1-samsung-n7000-galaxy-note-purple-original,p,en,31894.html');
      $page = file_get_html($value['url']."?currency=EUR");
      $html = $page->find('div[class=page-content]',0)->innertext; 
      $data["html"] = $html;
      $data["page"] = $page;
      $this->load->view('zhuaqu',$data);

    }
    //5001-
    public function zhuaqu1(){

      set_time_limit(30000);
      $page = $_GET['page'];
      $data = array();
      $value =  $this->good_mod->get_url($page);
      //print_r($value);
      //$value = array('url'=>'https://magboss.pl/anti-fingerprint-color-film-mercury-2in1-samsung-n7000-galaxy-note-purple-original,p,en,31894.html');
      $page = file_get_html($value['url']."?currency=EUR");
      if($page)
      {
        $html = $page->find('div[class=page-content]',0)->innertext; 
        $data["html"] = $html;
        $data["page"] = $page;
        $this->load->view('zhuaqu1',$data);
      }
      else
      {
        header('Location:/zhuaqu/zhuaqu1/?page='.$page);
      }
      

    }

    //2501-5000
    public function zhuaqu2(){

      set_time_limit(30000);
      $page = $_GET['page'];
      $data = array();
      $value =  $this->good_mod->get_url($page);
      //print_r($value);
      //$value = array('url'=>'https://magboss.pl/anti-fingerprint-color-film-mercury-2in1-samsung-n7000-galaxy-note-purple-original,p,en,31894.html');
      $page = file_get_html($value['url']."?currency=EUR");
      $html = $page->find('div[class=page-content]',0)->innertext; 
      $data["html"] = $html;
      $data["page"] = $page;
      $this->load->view('zhuaqu1',$data);

    }

    public function get_html($id)
    {

    }

    public function aa(){
    }

    public function all_url()
    {
      //
      //echo ("<script>window.open('".$ur.$tb."');</script>"); 

      $list = $_POST['list'];

      $this->good_mod->add_url($list);

      echo json_encode(array());
    }

    //添加
    public function good()
    {

      $data = $_POST;

      foreach ($data['pics'] as $key => $value) {
        
        $type=explode(".",$value['url']); 
        $name = time().'_'.rand(100,999).'.'.$type[count($type)-1];

        $img = file_get_contents($value['url']); 
        $pic_name = '/upload/import/20170320/'.$name;
        file_put_contents($_SERVER['DOCUMENT_ROOT'].$pic_name,$img); 
        $data['pics'][$key]['url'] = $pic_name;

        //$type=explode(".",$value['thumbnail']); 
        $img = file_get_contents($value['thumbnail']); 
        $pic_name = '/upload/import/20170320/thumbnail/'.$name;
        file_put_contents($_SERVER['DOCUMENT_ROOT'].$pic_name,$img); 
        $data['pics'][$key]['thumbnail'] = $pic_name;

      }
     
      $data['piecewise_price'] = serialize($data['piecewise_price']);
      $data['putaway_time'] = date('Y-m-d H:i:s');
      $sort = $this->sort_mod->get_sort(array("category"=>$data['category']));
      if($sort)
      {
        $data['category'] = $sort['parent_ids'].','.$sort['id'];
      }
      else
      {
        $data['category'] = '';
      }
      
      $has = $this->good_mod->get_good(array('import_id'=>$data['import_id']));
      if($has)
      {
        $id = $has['id'];
        $this->good_mod->update_good($data,$id);
      }
      else
      {
        $id = $this->good_mod->add_good($data);
      }
      echo json_encode(array('id'=>$id));
    }

    public function zz()
    {
      
      //$data = json_decode($str,true);
      $data = $_POST;
      print_r($data);
      /*
      foreach ($data as $key => $value) {

        $item = fetch_arr(array('name','count','category'),$value);
        $item['parent_id'] = 0;
        $item['level'] = 0;
        //$list[]=$item;
        $parent_id = $this->sort_mod->add_sort($item);
        foreach ($value['sub'] as $k => $sub) {
          $item = fetch_arr(array('name','count','category'),$sub);
          $item['parent_id'] = $parent_id;
          $item['parent_ids'] = $parent_id;
          $item['level'] = 1;
          if($item['sub'])
          {
            $ssubs = $item['sub'];
            unset($item['sub']);
            $sparent_id = $this->sort_mod->add_sort($item);
            foreach ($ssubs as $i => $ssub) {
              $item = fetch_arr(array('name','count','category'),$ssub);
              $item['parent_id'] = $sparent_id;
              $item['parent_ids'] = $parent_id.$sparent_id;
              $item['level'] = 2;
              $ssparent_id = $this->sort_mod->add_sort($item);
            }
          }
          else
          {
            $sparent_id = $this->sort_mod->add_sort($item);
          }
        }

      }*/

      foreach ($data as $category => $v) {
        $info  = $this->sort_mod->get_sort(array('category'=>$category));
        foreach ($v as $key => $value) {
          $item = fetch_arr(array('name','count','category'),$value);

          if(!$this->sort_mod->get_sort(array('category'=>$item['category'])))
          {
            $item['parent_id'] = $info['id'];
            $item['parent_ids'] = $info['parent_ids'].','.$info['id'];
            $item['level'] = $info['level']+1;
            $id = $this->sort_mod->add_sort($item);
          }

        }
        
        
      }

      //echo json_encode(array());

    }

    private function getImage($url,$save_dir='',$filename='',$type=0){ 
    if(trim($url)==''){ 
        return array('file_name'=>'','save_path'=>'','error'=>1); 
    } 
    if(trim($save_dir)==''){ 
        $save_dir='./'; 
    } 
    if(trim($filename)==''){//保存文件名 
        $ext=strrchr($url,'.'); 
        if($ext!='.gif'&&$ext!='.jpg'){ 
            return array('file_name'=>'','save_path'=>'','error'=>3); 
        } 
        $filename=time().$ext; 
    } 
    if(0!==strrpos($save_dir,'/')){ 
        $save_dir.='/'; 
    } 
    //创建保存目录 
    if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){ 
        return array('file_name'=>'','save_path'=>'','error'=>5); 
    } 
    //获取远程文件所采用的方法  
    if($type){ 
        $ch=curl_init(); 
        $timeout=5; 
        curl_setopt($ch,CURLOPT_URL,$url); 
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); 
        $img=curl_exec($ch); 
        curl_close($ch); 
    }else{ 
        ob_start();  
        readfile($url); 
        $img=ob_get_contents();  
        ob_end_clean();  
    } 
    //$size=strlen($img); 
    //文件大小  
    $fp2=@fopen($save_dir.$filename,'a'); 
    fwrite($fp2,$img); 
    fclose($fp2); 
    unset($img,$url); 
    return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0); 
} 
}


