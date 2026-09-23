<?php
require_once("../core/db.php");
require_once("../core/helpers.php");


$keyapi = ''; //  api key trên https://dailysieure.com/tich-hop-host-api 

$key = $_GET['key']; // đây là key mà hệ thống trả về, tự bọc hàm để bảo mật web của bạn
if($key == $keyapi){
    
    $taikhoan =  $_GET['tk']; // đây là tài khoản host tạo bị lỗi mà hệ thống trả về , các bạn tự code hoàn tiền, cập nhật tình trạng thành lỗi vào hệ thống của mình, tự bọc hàm để bảo mật
    
  //  mysql("UPDATE `host` SET `status` = 'thatbai' WHERE `taikhoan` = '$taikhoan' ");
    
    
}