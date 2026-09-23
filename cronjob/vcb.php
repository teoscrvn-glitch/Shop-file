<?php
require_once("../core/db.php");
require_once("../core/helpers.php");

if ($LOCNGUYEN_SIEUTHICODE->site('status_vcb') != '1') {
    die('Chức năng đang tắt.');
}
if ($LOCNGUYEN_SIEUTHICODE->site('token_vcb') == '') {
    die('Thiếu API');
}

$token = $LOCNGUYEN_SIEUTHICODE->site('token_vcb');
$MEMO_PREFIX = $LOCNGUYEN_SIEUTHICODE->site('noidung_naptien');

$result = curl_get("https://api.vpnfast.vn/api/historyvietcombank/$token");
$result = json_decode($result, true);
if(!isset($result['transactions'])){
    exit('Không thể lấy được dữ liệu');
}
foreach ($result['transactions'] as $data) {
    $des = $data['Description'];
    $amount = $data['Amount'];
    $tid = $data['Reference'];
    $id = parse_order_id($des, $MEMO_PREFIX);
    if ($amount < $LOCNGUYEN_SIEUTHICODE->site('min_recharge')) {
        continue;
    }
    if ($id) {
        $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_users` WHERE `id` = '$id' ");
        if ($row['username']) {
            if ($LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `bank_auto` WHERE `tranId` = '$tid' ") == 0) {
                if ($LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `bank_auto` WHERE `comment` = '$des' ") == 0) {
                    /* GHI LOG BANK AUTO */
                    $create = $LOCNGUYEN_SIEUTHICODE->insert("bank_auto", array(
                        'tranId' => $tid,
                        'comment' => $des,
                        'amount' => $amount,
                        'create_date' => gettime(),
                        'user_id' => $row['id'],
                        'payment_method' => 'VIETCOMBANK'
                    ));
                    if ($create) {
                        $real_amount = $amount + $amount * $LOCNGUYEN_SIEUTHICODE->site('ck_bank') / 100;
                        $isCheckMoney = PlusCredits($row['id'], $real_amount, 'Nạp tiền tự động ngân hàng (VIETCOMBANK | ' . $tid . ')');
                        if ($isCheckMoney) {
                            echo '[<b style="color:green">-</b>] Xử lý thành công 1 hoá đơn.' . PHP_EOL;
                        }
                    }
                }
            }
        }
    }
}
