<?php
/**
 * /ajaxs/card.php  (SUBMIT NẠP THẺ)
 * - KHÔNG dùng CheckLogin() vì nó redirect bằng <script> => làm AJAX hỏng
 * - Insert pending vào bảng cards (đúng cột bạn có)
 * - Gửi API theo: chargingws | json_md5 | json_hmac256
 * - Lưu raw response vào callback_raw để debug
 */

ob_start();
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json; charset=utf-8');

try {
    // hệ bạn dùng main.php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/main.php';

    // ✅ TỰ CHECK LOGIN (không redirect)
    if (!isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        @session_start();
    }
    if (empty($_SESSION['username'])) {
        echo json_encode(['status' => 'error', 'msg' => 'Chưa đăng nhập'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // db object của bạn
    if (!isset($db)) {
        echo json_encode(['status' => 'error', 'msg' => 'DB not initialized'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ((int)$db->site('status_card') !== 1) {
        echo json_encode(['status' => 'error', 'msg' => 'Hệ thống nạp thẻ đang tắt'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // ===== INPUT =====
    $telco   = Anti_xss($_POST['card_type_id'] ?? '');
    $amount  = (int)($_POST['price_guest'] ?? 0);
    $serial  = Anti_xss($_POST['seri'] ?? '');
    $pin     = Anti_xss($_POST['pin'] ?? '');

    // lấy user id từ $getUser nếu main.php có, còn không thì query theo username
    $user_id = (int)($getUser['id'] ?? 0);
    if ($user_id <= 0) {
        $u = Anti_xss($_SESSION['username']);
        $row = $db->get_row("SELECT * FROM `tbl_users` WHERE `username`='$u' LIMIT 1");
        if (!$row) {
            echo json_encode(['status' => 'error', 'msg' => 'User không tồn tại'], JSON_UNESCAPED_UNICODE);
            exit;
        }
        $user_id = (int)$row['id'];
        $getUser = $row;
    }

    if ($telco === '' || $amount <= 0 || $serial === '' || $pin === '') {
        echo json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đủ Nhà mạng / Mệnh giá / Serial / Mã thẻ'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // ===== CONFIG API =====
    $api_url  = trim((string)$db->site('card_partner_link'));
    $pid      = trim((string)$db->site('partner_id_card'));
    $pkey     = trim((string)$db->site('partner_key_card'));
    $api_type = trim((string)$db->site('card_api_type')); // chargingws | json_md5 | json_hmac256
    if ($api_type === '') $api_type = 'chargingws';

    if ($api_url === '' || $pid === '' || $pkey === '') {
        echo json_encode(['status' => 'error', 'msg' => 'Admin chưa cấu hình Partner Link/Partner Id/Partner Key'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $callback_url = trim((string)$db->site('card_callback_url')); // https://domain/api/card_callback.php

    // ===== CK =====
    $ck = (float)$db->site('ck_card');
    if ($ck < 0) $ck = 0;
    if ($ck > 100) $ck = 100;

    $request_id = (string)time() . random_int(1000, 9999);
    $received   = (int)round($amount * (100 - $ck) / 100);

    // ===== INSERT PENDING =====
    // cột bạn có: id,user_id,trans_id,telco,amount,price,serial,pin,status,create_date,update_date,reason,credited,request_id,status_api,callback_raw
    $db->insert("cards", [
        'user_id'      => $user_id,
        'trans_id'     => $request_id,
        'telco'        => strtoupper($telco),
        'amount'       => $amount,
        'price'        => $received,
        'serial'       => $serial,
        'pin'          => $pin,
        'status'       => 0, // pending
        'create_date'  => date('Y-m-d H:i:s'),
        'update_date'  => date('Y-m-d H:i:s'),
        'reason'       => '',
        'credited'     => 0,
        'request_id'   => $request_id,
        'status_api'   => '',
        'callback_raw' => '',
    ]);

    // ===== HTTP HELPER =====
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

    // ===== SEND =====
    $raw = '';
    $http = 0;
    $err = '';
    $payload_sent = [];

    if ($api_type === 'chargingws') {
        $command = 'charging';
        $codePin = $pin;
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

    // ===== PARSE RESPONSE =====
    $resp = null;
    if (is_string($raw) && $raw !== '') {
        $j = json_decode($raw, true);
        if (is_array($j)) $resp = $j;
    }

    $is_fail = false;
    $fail_msg = '';

    if ($err) {
        $is_fail = true;
        $fail_msg = 'CURL Error: ' . $err;
    } elseif ($http >= 400 || $http === 0) {
        $is_fail = true;
        $fail_msg = 'HTTP Error: ' . $http;
    } elseif (is_array($resp)) {
        $st = strtolower((string)($resp['status'] ?? ''));
        $code = (string)($resp['code'] ?? '');
        $success = false;

        if (in_array($st, ['success', 'ok', 'true'], true)) $success = true;
        if (($resp['status'] ?? null) === 1 || ($resp['status'] ?? null) === true) $success = true;
        if ($code === '1' || $code === 1) $success = true;

        if (!$success) {
            $is_fail = true;
            $fail_msg = (string)($resp['msg'] ?? $resp['message'] ?? $resp['error'] ?? 'API trả về thất bại');
        }
    }

    // ===== UPDATE LOG SUBMIT =====
    $db->update("cards", [
        'callback_raw' => (string)$raw,
        'status_api'   => is_array($resp) ? (string)($resp['status'] ?? ($resp['code'] ?? '')) : '',
        'update_date'  => date('Y-m-d H:i:s'),
        'reason'       => $is_fail ? $fail_msg : '',
        'status'       => $is_fail ? 3 : 0, // 3: lỗi gửi, 0: pending
    ], " `request_id`='" . Anti_xss($request_id) . "' ");

    if ($is_fail) {
        echo json_encode([
            'status'     => 'error',
            'msg'        => 'Gửi API thất bại: ' . $fail_msg,
            'request_id' => $request_id,
            'raw'        => $raw
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    echo json_encode([
        'status'     => 'success',
        'msg'        => 'Đã gửi thẻ, đang chờ xử lý...',
        'request_id' => $request_id
    ], JSON_UNESCAPED_UNICODE);
    exit;

} catch (Throwable $e) {
    @file_put_contents(__DIR__ . '/card_submit_error.log',
        date('Y-m-d H:i:s') . ' | ' . $e->getMessage() . ' | ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL,
        FILE_APPEND
    );
    http_response_code(500);
    echo json_encode(['status' => 'error', 'msg' => 'Server error'], JSON_UNESCAPED_UNICODE);
    exit;
}