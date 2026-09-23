<?php
require_once("../core/db.php");
require_once("../core/helpers.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['api_key']) && !empty($_POST['api_key'])) {
        $key = xss(trim($_POST['api_key']));
        $getData = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT `id` FROM `tbl_users` WHERE `token`='$key'");
        if ($getData) {
            $data =array();
            foreach($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_history_hack` WHERE `user_id`='".$getData['id']."'") as $row){
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