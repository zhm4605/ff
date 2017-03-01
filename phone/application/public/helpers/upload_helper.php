<?php
/**
 * User: Jane Wu
 */
$config['upload_path']      = './upload/img/';
$config['allowed_types']    = 'gif|jpg|png';
$config['max_size']         = 100;
$config['max_width']        = 1024;
$config['max_height']       = 768;

define('IMGCONFIG', serialize($config));
?>