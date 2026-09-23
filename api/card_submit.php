<?php
ob_start();
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json; charset=utf-8');

// =======================
// INIT (auto detect)
// =======================
$root = rtrim($_SERVER['DOCUMENT_ROOT'], '/');

// Ưu tiên main.php (site bạn đang dùng)
if (file_exists($root . '/main.php')) {
    require_once $root . '/main.php';
} elseif (file_exists($root . '/libs/init.php')) {
    require_once $root . '/libs/init.php';
} else {
    echo json_encode(['status'=>'error','msg'=>'Không tìm thấy main.php hoặc libs/init.php'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Nếu hệ có CheckLogin thì gọi
if (function_exists('CheckLogin')) {
    CheckLogin();
}

// =======================
// Validate objects
// =======================
if (!isset($LOCNGUYEN_SIEUTHICODE)) {
    echo json_encode(['status'=>'error','msg'=>'DB object LOCNGUYEN_SIEUTHICODE not found'], JSON_UNESCAPED_UNICODE);
    exit;
}
if (!isset($getUser['id'])) {
    echo json_encode(['status'=>'error','msg'=>'Chưa đăng nhập'], JSON_UNESCAPED_UNICODE);
    exit;
}

// =======================
// Check system on/off
// =======================
if ((int)$LOCNGUYEN_SIEUTHICODE->site('status_card') !== 1) {
    echo json_encode(['status'=>'error','msg'=>'Hệ thống nạp thẻ đang tắt'], JSON_UNESCAPED_UNICODE);
    exit;
}

// =======================
// INPUT
// =======================
$telco   = Anti_xss($_POST['card_type_id'] ?? '');
$amount  = (int)($_POST['price_guest'] ?? 0);
$serial  = Anti_xss($_POST['seri'] ?? '');
$pin     = Anti_xss($_POST['pin'] ?? '');
$user_id = (int)$getUser['id'];

if ($telco === '' || $amount <= 0 || $serial === '' || $pin === '') {
    echo json_encode(['status'=>'error','msg'=>'Vui lòng nhập đủ Nhà mạng / Mệnh giá / Serial / Mã thẻ'], JSON_UNESCAPED_UNICODE);
    exit;
}

// =======================
// CONFIG API
// =======================
$api_type = trim((string)$LOCNGUYEN_SIEUTHICODE->site('card_api_type'));
if ($api_type === '') $api_type = 'chargingws';

$api_url  = trim((string)$LOCNGUYEN_SIEUTHICODE->site('card_partner_link'));
$pid      = trim((string)$LOCNGUYEN_SIEUTHICODE->site('partner_id_card'));
$pkey     = trim((string)$LOCNGUYEN_SIEUTHICODE->site('partner_key_card'));

if ($api_url === '' || $pid === '' || $pkey === '') {
    echo json_encode(['status'=>'error','msg'=>'Admin chưa cấu hình Partner Link/Id/Key'], JSON_UNESCAPED_UNICODE);
    exit;
}

// callback url (nếu cổng hỗ trợ)
$callback_url = trim((string)$LOCNGUYEN_SIEUTHICODE->site('card_callback_url'));

// CK
$ck = (float)$LOCNGUYEN_SIEUTHICODE->site('ck_card');
if ($ck < 0) $ck = 0;
if ($ck > 100) $ck = 100;

$request_id = (string)time() . random_int(1000, 9999);
$received   = (int)round($amount * (100 - $ck) / 100); // thực nhận lưu price

// =======================
// INSERT PENDING
// =======================
$LOCNGUYEN_SIEUTHICODE->insert("cards", [
    'user_id'     => $user_id,
    'telco'       => strtoupper($telco),
    'serial'      => $serial,
    'pin'         => $pin,
    'amount'      => $amount,
    'price'       => $received,
    'status'      => 0,           // pending
    'status_api'  => '',
    'request_id'  => $request_id,
    'trans_id'    => $request_id, // giúp callback tìm theo trans_id nếu cổng trả trans_id
    'credited'    => 0,
    'reason'      => '',
    'callback_raw'=> '',
    'create_date' => date('Y-m-d H:i:s'),
    'update_date' => date('Y-m-d H:i:s'),
]);

// =======================
// CURL helper
// =======================
function http_post($url, $data, $is_json = false, $headers = []) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 25);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_POST, true);

    if ($is_json) {
        $payload = json_encode($data, JSON_UNESCAPED_UNICODE);
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    } else {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }

    if (!empty($headers)) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $res  = curl_exec($ch);
    $err  = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [$code, $res, $err];
}

// =======================
// SEND API
// =======================
$raw = '';
$http = 0;
$err = '';
$payload_sent = [];

if ($api_type === 'chargingws') {
    $command = 'charging';
    $codePin = $pin;

    // sign chuẩn chargingws phổ biến
    $sign = md5($pkey . $codePin . $command . $pid . $request_id . $serial . strtoupper($telco));

    $payload_sent = [
        'telco'      => strtoupper($telco),
        'amount'     => $amount,
        'serial'     => $serial,
        'code'       => $codePin,
        'command'    => $command,
        'request_id' => $request_id,
        'partner_id' => $pid,
        'sign'       => $sign,
    ];
    if ($callback_url !== '') $payload_sent['callback_url'] = $callback_url;

    [$http, $raw, $err] = http_post($api_url, $payload_sent, false);

} elseif ($api_type === 'json_md5') {

    $payload_sent = [
        'partner_id' => $pid,
        'request_id' => $request_id,
        'telco'      => strtoupper($telco),
        'amount'     => $amount,
        'serial'     => $serial,
        'code'       => $pin,
    ];
    if ($callback_url !== '') $payload_sent['callback_url'] = $callback_url;

    // md5 mẫu chung - nếu cổng của bạn khác công thức thì phải đổi
    $payload_sent['sign'] = md5($pid . $pkey . $request_id . $serial . $pin);

    [$http, $raw, $err] = http_post($api_url, $payload_sent, true);

} else { // json_hmac256
    $payload_sent = [
        'partner_id' => $pid,
        'request_id' => $request_id,
        'telco'      => strtoupper($telco),
        'amount'     => $amount,
        'serial'     => $serial,
        'code'       => $pin,
    ];
    if ($callback_url !== '') $payload_sent['callback_url'] = $callback_url;

    $payload_sent['sign'] = hash_hmac('sha256', json_encode($payload_sent, JSON_UNESCAPED_UNICODE), $pkey);

    [$http, $raw, $err] = http_post($api_url, $payload_sent, true);
}

// =======================
// UPDATE LOG to DB (luôn lưu raw để debug)
// =======================
$LOCNGUYEN_SIEUTHICODE->update("cards", [
    'callback_raw' => (string)$raw,
    'update_date'  => date('Y-m-d H:i:s'),
], " `request_id`='{$request_id}' LIMIT 1");

// FAIL conditions
$ok_send = true;
$fail_msg = '';

if ($err) {
    $ok_send = false;
    $fail_msg = 'CURL Error: ' . $err;
} elseif ($http >= 400 || $http === 0) {
    $ok_send = false;
    $fail_msg = 'HTTP Error: ' . $http;
}

// Nếu fail thì set status=3 + reason
if (!$ok_send) {
    $LOCNGUYEN_SIEUTHICODE->update("cards", [
        'status'     => 3,
        'reason'     => $fail_msg,
        'status_api' => '',
        'update_date'=> date('Y-m-d H:i:s'),
    ], " `request_id`='{$request_id}' LIMIT 1");

    echo json_encode([
        'status' => 'error',
        'msg' => 'Gửi API thất bại: ' . $fail_msg,
        'request_id' => $request_id,
        'raw' => $raw
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// OK: pending
echo json_encode([
    'status' => 'success',
    'msg' => 'Đã gửi thẻ, đang chờ xử lý...',
    'request_id' => $request_id
], JSON_UNESCAPED_UNICODE);
exit;