<?php
require_once("../locnguyen/db.php");
require_once("../locnguyen/helpers.php");

if ($LOCNGUYEN_SIEUTHICODE->site('status_acb') != '1') {
    die('Chức năng đang tắt.');
}
if ($LOCNGUYEN_SIEUTHICODE->site('token_acb') == '') {
    die('Thiếu API');
}

$token = $LOCNGUYEN_SIEUTHICODE->site('token_acb');
$MEMO_PREFIX = $LOCNGUYEN_SIEUTHICODE->site('noidung_naptien');

$result = curl_get("https://api.vpnfast.vn/api/historyacb/$token");
$result = json_decode($result, true);
if(!isset($result['data'])){
    exit('Không thể lấy được dữ liệu');
}
foreach ($result['data'] as $data) {
    $des = $data['description'];
    $amount = $data['amount'];
    $tid = $data['activeDatetime'];
    $id = parse_order_id($des, $MEMO_PREFIX);
    if ($amount < $LOCNGUYEN_SIEUTHICODE->site('min_recharge')) {
        continue;
    }
    if ($id) {
        $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_users` WHERE `id` = '$id' ");
        if ($row['username']) {
            if ($LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `bank_auto` WHERE `tranId` = '$tid' ") == 0) {
               
                    /* GHI LOG BANK AUTO */
                    $create = $LOCNGUYEN_SIEUTHICODE->insert("bank_auto", array(
                        'tranId' => $tid,
                        'comment' => $des,
                        'amount' => $amount,
                        'create_date' => gettime(),
                        'user_id' => $row['id'],
                        'payment_method' => 'ACB'
                    ));
                    if ($create) {
                        $real_amount = $amount + $amount * $LOCNGUYEN_SIEUTHICODE->site('ck_bank') / 100;
                        $isCheckMoney = PlusCredits($row['id'], $real_amount, 'Nạp tiền tự động ngân hàng (ACB Bank | ' . $tid . ')');
                        if ($isCheckMoney) {
                            echo '[<b style="color:green">-</b>] Xử lý thành công 1 hoá đơn.' . PHP_EOL;
                            // BotTele($row['username'] . " Nạp tiền tự động ngân hàng (MB Bank | " . $tid . ") Số tiền: " . format_cash(floor($real_amount)) . "đ");
                        }
                    }
                
            }
        }
    }
}
