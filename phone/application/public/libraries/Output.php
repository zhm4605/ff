<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jane Wu
 * Date: 2016/7/19
 * Time: 20:24
 */
class Output {
    private $result;
    private $data;
    private $errorcode;

    public function setParam($result, $data, $errorcode){
        $this->result = $result;
        $this->data = $data;
        $this->errorcode = $errorcode;
    }

    public function output(){
        if ($this->result == 1) {
            $ret = array("result"=>$this->result,"data"=>$this->data);
            echo json_encode($ret);
        } elseif ($this->result == 0) {
            $ret = array("result"=>$this->result,"errorCode"=>$this->errorcode);
            echo json_encode($ret);
        } else {
            $ret = array("result"=>$this->result);
            echo json_encode($ret);
        }
    }
}