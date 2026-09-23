<?php
require_once("../core/db.php");
require_once("../core/helpers.php");

if (time() > $LOCNGUYEN_SIEUTHICODE->site('check_time_cron_momo')) {
    if (time() - $LOCNGUYEN_SIEUTHICODE->site('check_time_cron_momo') < 15) {
        die('Thao tác quá nhanh, vui lòng đợi');
    }
}
$LOCNGUYEN_SIEUTHICODE->update("options", ['value' => time()], " `key` = 'check_time_cron_momo' ");

if ($LOCNGUYEN_SIEUTHICODE->site('status_momo') != '1') {
    die('Chức năng đang tắt.');
}
if ($LOCNGUYEN_SIEUTHICODE->site('token_momo') == '') {
    die('Thiếu API');
}

$token = $LOCNGUYEN_SIEUTHICODE->site('token_momo');
$MEMO_PREFIX = $LOCNGUYEN_SIEUTHICODE->site('noidung_naptien');
$result = curl_get("https://api.sieuthicode.net/historyapimomo/$token");
$result = json_decode($result, true);
if(!isset($result['momoMsg']['tranList'])){
    exit('Không thể lấy được dữ liệu');
}
foreach ($result['momoMsg']['tranList'] as $data) {
    $partnerId      = $data['partnerId'];               // SỐ ĐIỆN THOẠI CHUYỂN
    $comment        = $data['comment'];                 // NỘI DUNG CHUYỂN TIỀN
    $tranId         = $data['tranId'];                  // MÃ GIAO DỊCH
    $partnerName    = $data['partnerName'];             // TÊN CHỦ VÍ
    $id_momo        = parse_order_id($comment, $MEMO_PREFIX);         // TÁCH NỘI DUNG CHUYỂN TIỀN
    $amount         = $data['amount'];
    if ($amount < $LOCNGUYEN_SIEUTHICODE->site('min_recharge')) {
        continue;
    }

    if ($id_momo) {
        $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_users` WHERE `id` = '$id_momo' ");
        if ($row['id']) {
            if ($LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `bank_auto` WHERE `tranId` = '$tranId' AND `comment`='$comment' ") == 0) {
                $create = $LOCNGUYEN_SIEUTHICODE->insert("bank_auto", array(
                    'tranId'        => $tranId,
                    'user_id'       => $row['id'],
                    'comment'       => $comment,
                    'create_date'   => gettime(),
                    'amount'        => $amount,
                    'payment_method' => "MOMO"
                ));
                if ($create) {
                    $real_amount = $amount + ($amount * $LOCNGUYEN_SIEUTHICODE->site('ck_bank') / 100);
                    $isCheckMoney = PlusCredits($row['id'], $real_amount, 'Nạp tiền tự động qua ví MOMO (' . $tranId . ')');
                    if ($isCheckMoney) {
                        echo '[<b style="color:green">-</b>] Xử lý thành công 1 hoá đơn.' . PHP_EOL;
                    }
                }
            }
        }
    }
}
