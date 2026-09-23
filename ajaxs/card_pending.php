<?php
ob_start();
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json; charset=utf-8');

try {
    // INIT đúng hệ của bạn
    require_once $_SERVER['DOCUMENT_ROOT'] . '/main.php';

    // bắt buộc login
    if (function_exists('CheckLogin')) {
        CheckLogin();
    }

    // lấy user id
    $userId = 0;
    if (isset($getUser['id'])) $userId = (int)$getUser['id'];
    if ($userId <= 0 && isset($data_user['id'])) $userId = (int)$data_user['id'];

    if ($userId <= 0) {
        echo json_encode(['status' => 'error', 'msg' => 'Not logged in'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $PENDING_STATUS = 0;

    // DB object: bạn đang dùng $LOCNGUYEN_SIEUTHICODE (thấy trong các file trước)
    if (!isset($LOCNGUYEN_SIEUTHICODE) && !isset($db)) {
        echo json_encode(['status' => 'error', 'msg' => 'DB object not found'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if (isset($LOCNGUYEN_SIEUTHICODE)) {
        $rows = $LOCNGUYEN_SIEUTHICODE->get_list("SELECT `id`,`telco`,`serial`,`pin`,`amount`,`price`,`create_date`,`status`
            FROM `cards`
            WHERE `user_id`='{$userId}' AND `status`='{$PENDING_STATUS}'
            ORDER BY `id` DESC
            LIMIT 50");
    } else {
        $rows = $db->get_list("SELECT `id`,`telco`,`serial`,`pin`,`amount`,`price`,`create_date`,`status`
            FROM `cards`
            WHERE `user_id`='{$userId}' AND `status`='{$PENDING_STATUS}'
            ORDER BY `id` DESC
            LIMIT 50");
    }

    foreach ($rows as &$r) {
        $r['serial'] = mask_middle($r['serial'] ?? '');
        $r['pin']    = mask_middle($r['pin'] ?? '');
    }

    echo json_encode(['status' => 'success', 'data' => $rows], JSON_UNESCAPED_UNICODE);
    exit;

} catch (Throwable $e) {
    @file_put_contents(__DIR__ . '/card_pending_error.log',
        date('Y-m-d H:i:s').' | '.$e->getMessage().' | '.$e->getFile().':'.$e->getLine().PHP_EOL,
        FILE_APPEND
    );
    http_response_code(500);
    echo json_encode(['status' => 'error', 'msg' => 'Server error'], JSON_UNESCAPED_UNICODE);
    exit;
}

function mask_middle($s) {
    $s = (string)$s;
    $len = strlen($s);
    if ($len <= 6) return $s;
    return substr($s, 0, 3) . str_repeat('*', $len - 6) . substr($s, -3);
}