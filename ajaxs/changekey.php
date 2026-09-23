<?php
require_once '../core/db.php';
require_once '../core/helpers.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die(json_encode(['status' => 'error', 'msg' => 'Đây là trang web demo bạn không thể thực hiện chức năng này!']));
    }
    if (empty($_SESSION['username'])) {
        exit(json_encode(array('status' => 'error', 'msg' => 'Vui lòng đăng nhập')));
    }
    if (!$user = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `username`='" . $_SESSION['username'] . "' AND `banned`=0")) {
        exit(json_encode(array('status' => 'error', 'msg' => 'Vui lòng đăng nhập')));
    }
    $token = md5(random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 6) . time());

    $LOCNGUYEN_SIEUTHICODE->update("tbl_users", [
        'token' => $token,
        'update_date' => gettime(),
    ], " `id` = '" . $user['id'] . "' ");

    $LOCNGUYEN_SIEUTHICODE->insert("logs", [
        'user_id' => $user['id'],
        'ip' => myip(),
        'device' => $_SERVER['HTTP_USER_AGENT'],
        'create_date' => gettime(),
        'action' => "Thay đổi api key",
    ]);
    exit(json_encode(array('status' => 'success', 'msg' => 'Thay đổi API KEY thành công', 'redirect' => 'index.php?action=document_api')));
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'GET'.")));
}
