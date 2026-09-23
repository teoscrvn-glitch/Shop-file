<?php
require_once('../core/db.php');
require_once('../core/helpers.php');

$id = xss($_POST['id']);
if ($LOCNGUYEN_SIEUTHICODE->site('status_demo')==1) {
    die(json_encode(['status' => '0', 'messages' => 'Đây là trang web demo bạn không thể thực hiện chức năng này!']));
}
if (empty($_SESSION['username'])) {
    exit(json_encode(array('status' => 0, 'messages' => 'Vui lòng đăng nhập')));
}
if (!$user = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `username`='" . $_SESSION['username'] . "' AND `banned`=0")) {
    exit(json_encode(array('status' => 0, 'messages' => 'Vui lòng đăng nhập')));
}
if (empty($id)) {
    exit(json_encode(array('status' => 0, 'messages' => 'Vui lòng chọn mã nguồn')));
}
if (!$row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_products` WHERE `id`='" . $id . "'")) {
    exit(json_encode(array('status' => 0, 'messages' => 'Mã nguồn không tồn tại')));
}
$total = $row['price'] - ($row['price'] * $row['sale'] / 100);
if ($total > $getUser['coin']) {
    exit(json_encode(array('status' => 0, 'messages' => 'Số dư của bạn không đủ gòi, vui lòng nạp thêm để thực hiện')));
}
$isMoney = $LOCNGUYEN_SIEUTHICODE->tru("tbl_users", "coin", $row['price'], " `username` = '" . $user['username'] . "' ");
if ($isMoney) {
    /* GHI LOG DÒNG TIỀN */
    $LOCNGUYEN_SIEUTHICODE->insert("tbl_history", array(
        'user_id' => $user['id'],
        'product_id' => $row['id'],
        'price' => $total,
        'create_date' => gettime()
    ));
    $LOCNGUYEN_SIEUTHICODE->update("tbl_products", [
        'sold' => $row['sold'] + 1
    ], " `id` = '" . $row['id'] . "' ");
    $LOCNGUYEN_SIEUTHICODE->insert("dongtien", array(
        'sotientruoc' => getUser($user['id'], 'coin'),
        'sotienthaydoi' => $total,
        'sotiensau' => getUser($user['id'], 'coin') - $total,
        'thoigian' => gettime(),
        'noidung' => "Mua mã nguồn mã số #" . $row['id'],
        'user_id' => $user['id']
    ));

    exit(json_encode(array('status' => 99, 'messages' => 'Thanh toán thành công, vui lòng chờ', 'redirect' => 'index.php?action=history')));
}
