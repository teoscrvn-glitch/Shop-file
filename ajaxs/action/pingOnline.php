<?php
ob_start();
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json; charset=utf-8');

// ✅ INIT đúng hệ của bạn (site bạn có main.php ở public_html)
require_once $_SERVER['DOCUMENT_ROOT'] . '/main.php';

// ✅ nếu có hàm login thì gọi luôn
if (function_exists('CheckLogin')) {
    // Nếu CheckLogin redirect/echo thì nên tránh trong ajax,
    // nhưng hệ bạn đang dùng ok thì cứ gọi:
    CheckLogin();
}

// ===== Xác định user_id =====
$user_id = 0;

// Ưu tiên biến user hệ thống nếu có
if (isset($getUser['id'])) {
    $user_id = (int)$getUser['id'];
} elseif (isset($data_user['id'])) {
    $user_id = (int)$data_user['id'];
}

// Fallback: lấy từ session nếu hệ bạn có set
if ($user_id <= 0) {
    if (isset($_SESSION['user_id'])) {
        $user_id = (int)$_SESSION['user_id'];
    } elseif (isset($_SESSION['username'])) {
        // dùng object DB nào có sẵn
        if (isset($LOCNGUYEN_SIEUTHICODE)) {
            $u = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT `id` FROM `tbl_users` WHERE `username`='".xss($_SESSION['username'])."' LIMIT 1");
        } elseif (isset($db)) {
            $u = $db->get_row("SELECT `id` FROM `tbl_users` WHERE `username`='".Anti_xss($_SESSION['username'])."' LIMIT 1");
        } else {
            $u = null;
        }
        $user_id = $u ? (int)$u['id'] : 0;
    }
}

if ($user_id <= 0) {
    echo json_encode(['status' => 'error', 'msg' => 'not_login'], JSON_UNESCAPED_UNICODE);
    exit;
}

// ===== Update last_activity =====
$now = date('Y-m-d H:i:s');

try {
    if (isset($LOCNGUYEN_SIEUTHICODE)) {
        $LOCNGUYEN_SIEUTHICODE->update("tbl_users", [
            'last_activity' => $now
        ], " `id` = '{$user_id}' ");
    } elseif (isset($db)) {
        $db->update("tbl_users", [
            'last_activity' => $now
        ], " `id` = '{$user_id}' ");
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'DB object not found'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    echo json_encode(['status' => 'success', 'time' => $now], JSON_UNESCAPED_UNICODE);
    exit;

} catch (Throwable $e) {
    // log để debug
    @file_put_contents(__DIR__ . '/../ping_online_error.log',
        date('Y-m-d H:i:s').' | '.$e->getMessage().' | '.$e->getFile().':'.$e->getLine().PHP_EOL,
        FILE_APPEND
    );

    http_response_code(500);
    echo json_encode(['status' => 'error', 'msg' => 'server_error'], JSON_UNESCAPED_UNICODE);
    exit;
}