<?php
require_once("../core/db.php");
require_once("../core/helpers.php");

if (isset($_GET['status']) && $_GET['code'] && $_GET['serial'] && $_GET['trans_id'] && $_GET['telco'] && $_GET['callback_sign']) {
    // TRẠNG THÁI
    $status = xss($_GET['status']);
    // SERIAL THẺ NẠP
    $serial = xss($_GET['serial']);
    // MÃ THẺ NẠP
    $code = xss($_GET['code']);
    // MÃ REQUEST
    $request_id = xss($_GET['request_id']);
    // TRẠNG THÁI TIN NHẮN (THẤT BẠI - THÀNH CÔNG) TỪ THESIEURE
    $message = xss($_GET['message']);
    // MỆNH GIÁ GỐC THẺ NẠP
    $real_money = xss($_GET['value']);
    // MỆNH GIÁ THỰC NHẬN
    $geted_money = xss($_GET['amount']);
    // NHÀ MẠNG THẺ CÀO
    $nhamang = xss($_GET['telco']);
    // ĐƠN GIAO DỊCH BÊN THESIEURE
    $trans_id = xss($_GET['trans_id']);
    // KIỂM TRA CHỮ KÝ MD5
    $check_sign = md5($LOCNGUYEN_SIEUTHICODE->site('partner_key_card') . $code . $serial);

    // KIỂM TRA CHỮ KÝ HỢP LỆ TRÁNH TRƯỜNG HỢP BUG
    if ($_GET['callback_sign'] == $check_sign) {
        $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `cards` WHERE `trans_id` = '$request_id' AND `status` = '0' ");
        if (!$row) {
            die("Cái quát đờ phắc gì vậy?");
        }
        $row_user = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_users` WHERE `id` = '" . $row['user_id'] . "' ");
        if ($status == 1) {
            $thucnhan = $geted_money;

            /* CẬP NHẬT TRẠNG THÁI THẺ CÀO */
            $LOCNGUYEN_SIEUTHICODE->update("cards", array(
                'status'    => '2',
                'reason'      => 'Thẻ cào hợp lệ',
                'price'  => $thucnhan
            ), " `id` = '" . $row['id'] . "' ");
            $isCheckMoney = PlusCredits($row_user['id'], $thucnhan, 'Nạp tiền tự động qua gachthe1s seri (' . $row['serial'] . ')');
            if ($isCheckMoney) {
                echo '[<b style="color:green">-</b>] Xử lý thành công 1 hoá đơn.' . PHP_EOL;
            }
        } else {
            /* CẬP NHẬT TRẠNG THÁI THẺ CÀO */
            $LOCNGUYEN_SIEUTHICODE->update("cards", array(
                'status'    => '1',
                'reason'      => 'Thẻ cào không hợp lệ hoặc đã được sử dụng',
            ), " `id` = '" . $row['id'] . "' ");
        }
    } else {
        die(json_encode([
            'status' => 'error',
            'msg'   => 'Truy cập trái phép hệ thống đã lưu IP: ' . myip() . ''
        ]));
    }
} else {
    die(json_encode([
        'status' => 'error',
        'msg'   => 'Truy cập trái phép hệ thống đã lưu IP: ' . myip() . ''
    ]));
}
