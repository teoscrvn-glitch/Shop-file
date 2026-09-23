<?php
require_once("../core/db.php");
require_once("../core/helpers.php");

if ($LOCNGUYEN_SIEUTHICODE->site('status_zalopay') != '1') {
    die('Chức năng đang tắt.');
}
if ($LOCNGUYEN_SIEUTHICODE->site('token_zalopay') == '') {
    die('Thiếu API');
}

$token = $LOCNGUYEN_SIEUTHICODE->site('token_zalopay');
$MEMO_PREFIX = $LOCNGUYEN_SIEUTHICODE->site('noidung_naptien');
$result = curl_get("https://api.sieuthicode.net/historyapizalopay/$token");
$result = json_decode($result, true);
if(!isset($result['zalopayMsg']['tranList'])){
    exit('Không thể lấy được dữ liệu');
}
foreach ($result['zalopayMsg']['tranList'] as $data) {
    $tranId      = $data['trans_id'];               // SỐ ĐIỆN THOẠI CHUYỂN
    $comment        = $data['description'];                 // NỘI DUNG CHUYỂN TIỀN
    $id_momo        = parse_order_id($comment, $MEMO_PREFIX);         // TÁCH NỘI DUNG CHUYỂN TIỀN
    $amount         = $data['trans_amount'];
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
                    'payment_method' => "ZALOPAY"
                ));
                if ($create) {
                    $real_amount = $amount + ($amount * $LOCNGUYEN_SIEUTHICODE->site('ck_bank') / 100);
                    $isCheckMoney = PlusCredits($row['id'], $real_amount, 'Nạp tiền tự động qua ví ZALOPAY (' . $tranId . ')');
                    if ($isCheckMoney) {
                        echo '[<b style="color:green">-</b>] Xử lý thành công 1 hoá đơn.' . PHP_EOL;
                    }
                }
            }
        }
    }
}
