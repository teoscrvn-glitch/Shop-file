<?php
require_once("../core/db.php");
require_once("../core/helpers.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die(json_encode(['status' => false, 'msg' => 'Đây là trang web demo bạn không thể thực hiện chức năng này!']));
    }
    if (!isset($_POST['api_key']) || empty($_POST['api_key']) || !isset($_POST['id_group']) || empty($_POST['id_group']) || !isset($_POST['id_package']) || empty($_POST['id_package'])) {
        exit(json_encode(array('status' => false, 'msg' => 'Thiếu tham số hoặc dữ liệu')));
    }
    $key = xss(trim($_POST['api_key']));
    $id = xss(preg_replace('/\D/', '', $_POST['id_group']));
    $type = xss(preg_replace('/\D/', '', $_POST['id_package']));

    if (!$user = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `token`='" . $key . "' AND `banned`=0")) {
        exit(json_encode(array('status' => false, 'msg' => 'Api key không chính xác')));
    }

    if (!$checkGroups = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_groups_hack` WHERE `id`='" . $id . "' AND `status`=1")) {
        exit(json_encode(array('status' => false, 'msg' => 'Nhóm hack không tồn tại')));
    }
    if (!$row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_package_hack` WHERE `id`='" . $type . "' AND `groups_id`='" . $checkGroups['id'] . "'")) {
        exit(json_encode(array('status' => false, 'msg' => 'Gói hack không tồn tại')));
    }
    $total = $row['price'];
    if ($total > $user['coin']) {
        exit(json_encode(array('status' => false, 'msg' => 'Số dư của bạn không đủ gòi, vui lòng nạp thêm để thực hiện')));
    }
    $countLicense = $LOCNGUYEN_SIEUTHICODE->num_rows("SELECT * FROM `tbl_license` WHERE `package_id`='" . $row['id'] . "' AND `status`='1'");
    if ($countLicense <= 0) {
        die(json_encode(array('status' => false, 'msg' => 'Đã hết Key hack rồi, vui lòng quay lại sau')));
    }
    $isMoney = $LOCNGUYEN_SIEUTHICODE->tru("tbl_users", "coin", $total, " `username` = '" . $user['username'] . "' ");
    if ($isMoney) {
        $license = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_license` WHERE `package_id`='" . $row['id'] . "' AND `status`='1' LIMIT 1");
        /* GHI LOG DÒNG TIỀN */
        $LOCNGUYEN_SIEUTHICODE->insert("dongtien", array(
            'sotientruoc' => getUser($user['id'], 'coin'),
            'sotienthaydoi' => $total,
            'sotiensau' => getUser($user['id'], 'coin') - $total,
            'thoigian' => gettime(),
            'noidung' => "Mua License hack " . $checkGroups['name'],
            'user_id' => $user['id'],
        ));
        $LOCNGUYEN_SIEUTHICODE->insert("tbl_logs_orders", [
            'user_id' => $user['id'],
            'ip' => myip(),
            'amount' => $total,
            'device' => $_SERVER['HTTP_USER_AGENT'],
            'create_date' => gettime(),
            'action' => "Mua License hack " . $checkGroups['name'],
        ]);
        $LOCNGUYEN_SIEUTHICODE->update("tbl_license", [
            'status' => 0,
        ], " `id` = '" . $license['id'] . "' ");
        $LOCNGUYEN_SIEUTHICODE->insert("tbl_history_hack", array(
            'user_id' => $user['id'],
            'groups_name' => $checkGroups['name'],
            'thoigian' => $row['thoigian'],
            'price' => $total,
            'license' => $license['license'],
            'create_date' => gettime(),
            'update_date' => gettime(),
        ));
        die(json_encode(array('status' => true, 'order_id' => $LOCNGUYEN_SIEUTHICODE->get_id_insert())));
    } else {
        die(json_encode(array('status' => false, 'msg' => 'Đã xảy ra lỗi')));
    }
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'GET'.")));
}