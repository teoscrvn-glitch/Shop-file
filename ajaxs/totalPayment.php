<?php
require_once '../core/db.php';
require_once '../core/helpers.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['qty'])) {
        die(format_cash(0));
    }
    if ($row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_package_hack` WHERE `id`='" . xss($_POST['type']) . "'")) {
        $qty = xss(preg_replace('/\D/', '', $_POST['qty']));
        $total = $qty * $row['price'];
        die(format_cash($total));
    }else{
        die('Vui lòng chọn gói trước khi nhập số lượng');
    }
    die(format_cash(0));
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'GET'.")));
}
