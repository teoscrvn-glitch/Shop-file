<?php
require_once '../core/db.php';
require_once '../core/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(array('message' => "The requested resource does not support http method 'GET'.")));
}

/**
 * ✅ QUAN TRỌNG:
 * - Nếu tbl_license.status = 1 là KEY CÒN HÀNG (chưa dùng) -> giữ 1
 * - Nếu tbl_license.status = 0 là KEY CÒN HÀNG (chưa dùng) -> đổi thành 0
 */
$AVAILABLE_STATUS = 1; // <<< nếu bạn còn tiền mà báo thiếu, thử đổi 1 -> 0

if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
    die(json_encode(['status' => 'error', 'msg' => 'Đây là trang web demo bạn không thể thực hiện chức năng này!']));
}

if (empty($_SESSION['username'])) {
    exit(json_encode(array('status' => 'error', 'msg' => 'Vui lòng đăng nhập')));
}

$user = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `username`='" . $_SESSION['username'] . "' AND `banned`=0");
if (!$user) {
    exit(json_encode(array('status' => 'error', 'msg' => 'Vui lòng đăng nhập')));
}

$id  = (int) xss(preg_replace('/\D/', '', $_POST['id'] ?? ''));
$type = (int) xss(preg_replace('/\D/', '', $_POST['type'] ?? ''));
$qty = (int) xss(preg_replace('/\D/', '', $_POST['qty'] ?? ''));

if (empty($id) || empty($type)) {
    exit(json_encode(array('status' => 'error', 'msg' => 'Vui lòng chọn gói')));
}
if ($qty <= 0) {
    exit(json_encode(array('status' => 'error', 'msg' => 'Vui nhập số lượng cần mua')));
}

$checkGroups = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_groups_hack` WHERE `id`='{$id}' AND `status`=1");
if (!$checkGroups) {
    exit(json_encode(array('status' => 'error', 'msg' => 'Nhóm hack không tồn tại')));
}

$row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_package_hack` WHERE `id`='{$type}' AND `groups_id`='{$checkGroups['id']}'");
if (!$row) {
    exit(json_encode(array('status' => 'error', 'msg' => 'Gói hack không tồn tại')));
}

/* ====== CHECK KHO KEY/LICENCE (SỐ LƯỢNG HỆ THỐNG) ====== */
$countRow = $LOCNGUYEN_SIEUTHICODE->get_row(
    "SELECT COUNT(`id`) AS `total`
     FROM `tbl_license`
     WHERE `package_id`='{$row['id']}' AND `status`='{$AVAILABLE_STATUS}'"
);
$totalAvailable = isset($countRow['total']) ? (int)$countRow['total'] : 0;

if ($qty > $totalAvailable) {
    exit(json_encode(array('status' => 'error', 'msg' => 'Số lượng trong hệ thống không đủ')));
}

/* ====== TÍNH TIỀN ====== */
$total = $qty * (int)$row['price'];

/* ✅ Dùng $user['coin'] vì file này không set $getUser */
if ($total > (int)$user['coin']) {
    exit(json_encode(array('status' => 'error', 'msg' => 'Số dư của bạn không đủ gòi, vui lòng nạp thêm để thực hiện')));
}

/* ====== TRỪ TIỀN ====== */
$beforeCoin = (int)$user['coin'];
$isMoney = $LOCNGUYEN_SIEUTHICODE->tru("tbl_users", "coin", $total, " `username` = '" . $user['username'] . "' ");

if (!$isMoney) {
    die(json_encode(array('status' => 'error', 'msg' => 'Đã xảy ra lỗi')));
}

/* ====== GHI LOG DÒNG TIỀN (GIỮ NGUYÊN Ý NGHĨA) ====== */
$LOCNGUYEN_SIEUTHICODE->insert("dongtien", array(
    'sotientruoc'    => $beforeCoin,
    'sotienthaydoi'  => $total,
    'sotiensau'      => $beforeCoin - $total,
    'thoigian'       => gettime(),
    'noidung'        => "Mua License hack " . $checkGroups['name'],
    'user_id'        => $user['id'],
));

/* ====== LẤY KEY THEO SỐ LƯỢNG ====== */
$licenses = $LOCNGUYEN_SIEUTHICODE->get_list(
    "SELECT * FROM `tbl_license`
     WHERE `package_id`='{$row['id']}' AND `status`='{$AVAILABLE_STATUS}'
     LIMIT {$qty}"
);

if (!$licenses || count($licenses) <= 0) {
    // Trường hợp race-condition: vừa trừ tiền xong nhưng kho bị lấy mất
    // (giữ nguyên behavior báo hết key)
    die(json_encode(array('status' => 'error', 'msg' => 'Đã hết Key hack rồi, vui lòng quay lại sau')));
}

foreach ($licenses as $info) {
    $LOCNGUYEN_SIEUTHICODE->insert("tbl_history_hack", array(
        'user_id'      => $user['id'],
        'groups_name'  => $checkGroups['name'],
        'thoigian'     => $row['thoigian'],
        'price'        => $row['price'],
        'license'      => $info['license'],
        'create_date'  => gettime(),
        'update_date'  => gettime(),
    ));

    // ✅ Đánh dấu đã dùng (đổi status ngược lại AVAILABLE_STATUS)
    $LOCNGUYEN_SIEUTHICODE->update("tbl_license", [
        'status'      => ($AVAILABLE_STATUS == 1 ? 0 : 1),
        'update_date' => gettime()
    ], " `id` = '" . $info['id'] . "'");
}

$LOCNGUYEN_SIEUTHICODE->insert("tbl_logs_orders", [
    'user_id'     => $user['id'],
    'ip'          => myip(),
    'amount'      => $total,
    'device'      => $_SERVER['HTTP_USER_AGENT'],
    'create_date' => gettime(),
    'action'      => "Mua License hack " . $checkGroups['name'],
]);

die(json_encode(array(
    'title'    => 'Thành công',
    'status'   => 'success',
    'msg'      => 'Đã thuê gói thành công, chúng tôi sẽ đưa bạn tới trang quản lý',
    'redirect' => 'index.php?action=history_license'
)));