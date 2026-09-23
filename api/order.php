<?php
require_once("../core/db.php");
require_once("../core/helpers.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['api_key']) || empty($_POST['api_key']) || !isset($_POST['order_id']) || empty($_POST['order_id']) ) {
        exit(json_encode(array('status' => false, 'msg' => 'Thiếu tham số hoặc dữ liệu')));
    }else{
        $key = xss(trim($_POST['api_key']));
        $id = xss(preg_replace('/\D/', '', $_POST['order_id']));
        $getData = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT `id` FROM `tbl_users` WHERE `token`='$key'");
        if ($getData) {
            $data =array();
            foreach($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_history_hack` WHERE `user_id`='".$getData['id']."' AND `id`='$id'") as $row){
                $data[]=$row;
            }
            echo json_encode(array(
                "data" => $data
            ));
        } else {
            die(json_encode(array('status' => false, 'msg' => 'api_key không hợp lệ')));
        }
    }
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'GET'.")));
}