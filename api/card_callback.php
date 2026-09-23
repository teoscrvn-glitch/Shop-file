<?php
/**
 * /api/card_callback.php
 * - Nhận callback từ cổng nạp thẻ
 * - Map JSON theo option card_json_map
 * - Update cards.status + cards.status_api + cards.callback_raw
 * - Cộng coin 1 lần duy nhất (credited=1)
 */

ob_start();
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json; charset=utf-8');

require_once $_SERVER['DOCUMENT_ROOT'] . '/main.php';

if (!isset($db)) {
    echo json_encode(['ok'=>false,'msg'=>'DB not initialized'], JSON_UNESCAPED_UNICODE);
    exit;
}

// lấy raw input
$raw = file_get_contents('php://input');
if ($raw === '' || $raw === false) {
    // fallback nếu cổng gửi form-data
    $raw = json_encode($_REQUEST, JSON_UNESCAPED_UNICODE);
}

// parse json
$data = json_decode($raw, true);
if (!is_array($data)) {
    // nếu là form-data thì lấy request
    $data = $_REQUEST;
    if (!is_array($data)) $data = [];
}

// JSON MAP
$mapStr = trim((string)$db->site('card_json_map'));
if ($mapStr === '') {
    $mapStr = '{"request_id":"request_id","status":"status","amount":"amount","received":"received","message":"message"}';
}
$map = json_decode($mapStr, true);
if (!is_array($map)) {
    $map = ["request_id"=>"request_id","status"=>"status","amount"=>"amount","received"=>"received","message"=>"message"];
}

// helper lấy key theo map (hỗ trợ key dạng a.b.c)
function getByPath($arr, $path) {
    if (!is_array($arr)) return null;
    if ($path === '' || $path === null) return null;
    $parts = explode('.', (string)$path);
    $cur = $arr;
    foreach ($parts as $p) {
        if (is_array($cur) && array_key_exists($p, $cur)) $cur = $cur[$p];
        else return null;
    }
    return $cur;
}

$request_id = (string)(getByPath($data, $map['request_id'] ?? 'request_id') ?? ($data['request_id'] ?? $data['trans_id'] ?? ''));
$statusRaw  = getByPath($data, $map['status'] ?? 'status');
$amount     = (int)(getByPath($data, $map['amount'] ?? 'amount') ?? 0);
$received   = (int)(getByPath($data, $map['received'] ?? 'received') ?? 0);
$message    = (string)(getByPath($data, $map['message'] ?? 'message') ?? ($data['msg'] ?? ''));

if ($request_id === '') {
    echo json_encode(['ok'=>false,'msg'=>'missing request_id'], JSON_UNESCAPED_UNICODE);
    exit;
}

// tìm bản ghi
$card = $db->get_row("SELECT * FROM `cards` WHERE `request_id`='".Anti_xss($request_id)."' OR `trans_id`='".Anti_xss($request_id)."' LIMIT 1");
if (!$card) {
    echo json_encode(['ok'=>false,'msg'=>'card not found'], JSON_UNESCAPED_UNICODE);
    exit;
}

// normalize status
// quy ước:
// - success => status=1
// - fail => status=2
// - pending => status=0
$st = strtolower((string)$statusRaw);
$isSuccess = false;
$isFail = false;

if ($statusRaw === 1 || $statusRaw === true || $st === 'success' || $st === 'ok') $isSuccess = true;
if ($st === 'fail' || $st === 'failed' || $st === 'error' || $statusRaw === 2) $isFail = true;

// nếu cổng trả code/err_code
if (!$isSuccess && !$isFail) {
    $code = (string)($data['code'] ?? $data['err_code'] ?? '');
    if ($code === '1') $isSuccess = true;
    if ($code !== '' && $code !== '1') $isFail = true;
}

$newStatus = 0;
if ($isSuccess) $newStatus = 1;
elseif ($isFail) $newStatus = 2;
else $newStatus = 0;

// cập nhật callback_raw + status_api + reason
$db->update("cards", [
    'status'       => $newStatus,
    'status_api'   => (string)$statusRaw,
    'callback_raw' => is_string($raw) ? $raw : json_encode($data, JSON_UNESCAPED_UNICODE),
    'reason'       => $message,
    'update_date'  => date('Y-m-d H:i:s'),
], " `id`='".(int)$card['id']."' ");

// cộng coin 1 lần duy nhất
if ($newStatus === 1 && (int)$card['credited'] === 0) {
    $uid = (int)$card['user_id'];
    $plus = (int)$card['price']; // bạn đang lưu thực nhận vào price

    // khóa cộng tiền: update credited trước để tránh callback bắn 2 lần
    $db->update("cards", [
        'credited' => 1,
        'update_date' => date('Y-m-d H:i:s')
    ], " `id`='".(int)$card['id']."' AND `credited`='0' ");

    // cộng coin
    $db->query("UPDATE `tbl_users` SET `coin`=`coin`+{$plus} WHERE `id`='{$uid}' LIMIT 1");
}

echo json_encode(['ok'=>true,'msg'=>'received','request_id'=>$request_id,'status'=>$newStatus], JSON_UNESCAPED_UNICODE);
exit;