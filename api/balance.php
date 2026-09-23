<?php
require_once("../core/db.php");
require_once("../core/helpers.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['api_key']) && !empty($_POST['api_key'])) {
        $key = xss(trim($_POST['api_key']));
        $getData = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT `coin`,`total_coin` FROM `tbl_users` WHERE `token`='$key'");
        if ($getData) {
            die(json_encode(array('status' => true, 'balance' => $getData['coin'], 'total_balance' => $getData['total_coin'])));
        } else {
            die(json_encode(array('status' => false, 'msg' => 'api_key không hợp lệ')));
        }
    }
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'GET'.")));
}
