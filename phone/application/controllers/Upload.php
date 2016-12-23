<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jane Wu
 * Date: 2016/7/26
 * Time: 14:52
 */

class Upload extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('upload');
        $this->load->model('upload_mod');
    }

    public function index()
    {
        $this->load->view("upload/index");
    }

    public function do_upload()
    {
        $config['upload_path']      = './upload/img/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = 100;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('userfile'))
        {
//            echo "failed!"
            echo $this->upload->display_errors('<p style="font-size:2em;">','</p>');
//            $error = array('error' => $this->upload->display_errors());
//
//            $this->load->view('upload_form', $error);
        }
        else
        {
            $ret = $this->upload->data();
            $data["name"] = trim($_POST["imgName"]);
            $data["class"] = trim($_POST["imgClass"]);
            $data["url"] = $ret["full_path"];
            $data["size"] = $ret["image_width"] . "*" . $ret["image_height"];
            $data["time"] = time();
            $this->upload_mod->insert($data);
            echo"<script>history.go(-1);</script>";
//            echo "success!";
//            $data = array('upload_data' => $this->upload->data());
//
//            $this->load->view('upload_success', $data);
        }
    }

}