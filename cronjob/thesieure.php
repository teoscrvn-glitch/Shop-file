<?php
/*Thực hiện bởi Nguyễn Nhật Lộc - SIEUTHICODE.NET - 0978364572*/
define("IN_SITE", true);
require_once("../core/db.php");
require_once("../core/helpers.php");


/* START CHỐNG SPAM */
$token_tsr = $LOCNGUYEN_SIEUTHICODE->site('token_tsr');
$result = curl_get("https://api.sieuthicode.net/historyapithesieure/$token_tsr");
$result = json_decode($result, true);
if(!isset($result['tranList'])){
    exit('Không thể lấy được dữ liệu');
}
foreach ($result['tranList'] as $data) {
    $tid            = check_string($data['transId']);
    $description    = check_string($data['description']);
    $amount         = str_replace(',', '', $data['amount']);
    $amount         = str_replace('đ', '', $amount);               // SỐ TIỀN CHUYỂN
    $user_id        = parse_order_id($description, $LOCNGUYEN_SIEUTHICODE->site('noidung_naptien'));         // TÁCH NỘI DUNG CHUYỂN TIỀN
    // XỬ LÝ AUTO


    if ($getUser = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_users` WHERE `id` = '$user_id' ")) {
        if ($LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `bank_auto` WHERE `tranId` = '$tid' AND `comment` = '$description' ") == 0) {
            $create = $LOCNGUYEN_SIEUTHICODE->insert("bank_auto", array(
                'user_id'      => $getUser['id'],
                'tranId'        => $tid,
                'comment'       => $description,
                'amount'        => $amount,
                'payment_method'       => 'THESIEURE',
                'create_date'        => gettime(),
            ));
            if ($create) {
                $real_amount = $amount + $amount * $LOCNGUYEN_SIEUTHICODE->site('ck_bank') / 100;
                $isCheckMoney = PlusCredits($getUser['id'], $real_amount, 'Nạp tiền tự động qua Ví Thesieure (#' . $tid . ' - ' . $description . ' - ' . $amount . ')');
                if ($isCheckMoney) {
                    echo '[<b style="color:green">-</b>] Xử lý thành công 1 hoá đơn.' . PHP_EOL;
                }
            }
        }
    }
}
