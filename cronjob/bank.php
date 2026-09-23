<?php
require_once(__DIR__ . "/../core/db.php");
require_once(__DIR__ . "/../core/helpers.php");

/**
 * AUTO BANK ALL - STC (api.sieuthicode.net)
 * - Cron/polling: gọi API lấy lịch sử giao dịch
 * - Parse user_id từ nội dung chuyển khoản theo noidung_naptien
 * - Insert bank_auto + PlusCredits
 *
 * YÊU CẦU:
 * - options/setting có các key:
 *   status_<bank> = 1/0  (vd: status_mbbank)
 *   token_<bank>  = token (vd: token_mbbank)
 * - noidung_naptien, min_recharge, ck_bank đã có sẵn như hệ bạn.
 */

// =====================
// COMMON SETTINGS
// =====================
$MEMO_PREFIX   = (string)$LOCNGUYEN_SIEUTHICODE->site('noidung_naptien');
$MIN_RECHARGE  = (float)$LOCNGUYEN_SIEUTHICODE->site('min_recharge');
$BONUS_PERCENT = (float)$LOCNGUYEN_SIEUTHICODE->site('ck_bank');

// =====================
// LOCK chống cron chạy chồng
// =====================
$lockFile = __DIR__ . '/.lock_bank_auto_all.lock';
$fp = @fopen($lockFile, 'c+');
if (!$fp) die("Không tạo được lock file.");
if (!flock($fp, LOCK_EX | LOCK_NB)) die("Cron đang chạy, bỏ qua.");

// =====================
// HELPERS
// =====================
function to_amount($v): float {
    // "10,000" -> 10000
    $s = trim((string)$v);
    $s = str_replace([',', ' '], '', $s);
    // giữ dấu trừ nếu có
    if ($s === '' || !is_numeric($s)) return 0;
    return (float)$s;
}

function first_non_empty(...$vals) {
    foreach ($vals as $v) {
        if (isset($v) && $v !== null && $v !== '') return $v;
    }
    return null;
}

function log_ok($msg){
    echo '[<b style="color:green">-</b>] ' . $msg . PHP_EOL;
}

function log_err($msg){
    echo '[<b style="color:red">x</b>] ' . $msg . PHP_EOL;
}

/**
 * Lưu bank_auto + cộng tiền (chống trùng theo tranId)
 */
function process_topup($LOCNGUYEN_SIEUTHICODE, $user, $tid, $des, $amount, $bankName, $MIN_RECHARGE, $BONUS_PERCENT) {

    if ($amount <= 0) return false;
    if ($amount < $MIN_RECHARGE) return false;

    $tid = trim((string)$tid);
    $des = trim((string)$des);
    if ($tid === '' || $des === '') return false;

    // chống trùng
    if ($LOCNGUYEN_SIEUTHICODE->num_rows("SELECT * FROM `bank_auto` WHERE `tranId` = '" . addslashes($tid) . "' ") > 0) {
        return false;
    }

    $create = $LOCNGUYEN_SIEUTHICODE->insert("bank_auto", array(
        'tranId'         => $tid,
        'comment'        => $des,
        'amount'         => $amount,
        'create_date'    => gettime(),
        'user_id'        => $user['id'],
        'payment_method' => $bankName
    ));
    if (!$create) return false;

    $real_amount = $amount + ($amount * $BONUS_PERCENT / 100);
    $ok = PlusCredits($user['id'], $real_amount, "Nạp tiền tự động ngân hàng ({$bankName} | {$tid})");
    if ($ok) {
        log_ok("Thành công: {$user['username']} +".format_cash((int)floor($real_amount))."đ ({$bankName} | {$tid})");
        return true;
    }
    return false;
}

/**
 * Từ description -> user_id theo memo prefix
 */
function get_user_from_memo($LOCNGUYEN_SIEUTHICODE, $MEMO_PREFIX, $des) {
    $id = parse_order_id($des, $MEMO_PREFIX);
    if (!$id) return null;
    $id = (int)$id;
    if ($id <= 0) return null;

    $user = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `id` = '{$id}' ");
    if (!$user || empty($user['username'])) return null;
    return $user;
}

// =====================
// BANKS CONFIG (STC endpoints)
// status_key / token_key phải tồn tại trong options/setting của bạn
// =====================
$banks = [
    // key => [status_key, token_key, endpoint, handler_name]
    'TPBANK'        => ['status_tpbank',      'token_tpbank',      'https://api.sieuthicode.net/historyapitpb/%s',        'handle_tpbank'],
    'VIETCOMBANK'   => ['status_vcb',         'token_vcb',         'https://api.sieuthicode.net/historyapivcb/%s',        'handle_vcb'],
    'ACB'           => ['status_acb',         'token_acb',         'https://api.sieuthicode.net/historyapiacb/%s',        'handle_acb'],
    'MBBANK'        => ['status_mbbank',      'token_mbbank',      'https://api.sieuthicode.net/historyapimbbank/%s',     'handle_mbbank'],
    'BIDV'          => ['status_bidv',        'token_bidv',        'https://api.sieuthicode.net/historyapibidv/%s',       'handle_bidv'],
    'SEABANK'       => ['status_seabank',     'token_seabank',     'https://api.sieuthicode.net/historyapiseabank/%s',    'handle_seabank'],
    'VIETTELMONEY'  => ['status_viettel',     'token_viettel',     'https://api.sieuthicode.net/historyapiviettel/%s',    'handle_viettel'],
    'THESIEURE'     => ['status_thesieure',   'token_thesieure',   'https://api.sieuthicode.net/historyapithesieure/%s',  'handle_thesieure'],
    'MSB'           => ['status_msb',         'token_msb',         'https://api.sieuthicode.net/historyapimsb/%s',        'handle_msb'],
    'TECHCOMBANK'   => ['status_tcb',         'token_tcb',         'https://api.sieuthicode.net/historyapitcb/%s',        'handle_tcb'],
    'VPBANK'        => ['status_vpbank',      'token_vpbank',      'https://api.sieuthicode.net/historyapivpbank/%s',     'handle_vpbank'],
    'TIMO'          => ['status_timo',        'token_timo',        'https://api.sieuthicode.net/historyapitimo/%s',       'handle_timo'],
    'VIETABANK'     => ['status_vietabank',   'token_vietabank',   'https://api.sieuthicode.net/historyapivietabank/%s',  'handle_vietabank'],
];

// =====================
// HANDLERS (parse response theo docs)
// Mỗi handler trả về mảng giao dịch chuẩn: [ ['tid'=>..,'amount'=>..,'des'=>..,'in'=>true/false], ... ]
// =====================
function handle_mbbank($json){
    $out = [];
    if (!is_array($json) || !isset($json['TranList']) || !is_array($json['TranList'])) return $out;
    foreach ($json['TranList'] as $t){
        $tid = $t['tranId'] ?? '';
        $amount = to_amount($t['creditAmount'] ?? 0);
        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>($amount>0)];
    }
    return $out;
}

function handle_tpbank($json){
    $out = [];
    if (!is_array($json) || !isset($json['transactionInfos']) || !is_array($json['transactionInfos'])) return $out;
    foreach ($json['transactionInfos'] as $t){
        $tid = $t['id'] ?? '';
        $amount = to_amount($t['amount'] ?? 0);

        // TPB có creditDebitIndicator: DBIT thường là ra, CRDT thường là vào (có thể khác tùy api)
        $cdi = strtoupper((string)($t['creditDebitIndicator'] ?? ''));
        $isIn = ($cdi !== 'DBIT'); // ưu tiên loại bỏ DBIT (ra)

        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>$isIn && $amount>0];
    }
    return $out;
}

function handle_acb($json){
    $out = [];
    if (!is_array($json) || !isset($json['data']) || !is_array($json['data'])) return $out;
    foreach ($json['data'] as $t){
        // ACB không có transId trong mẫu -> dùng postingDate + description + amount làm id tạm
        $tid = first_non_empty($t['transId'] ?? null, $t['transactionId'] ?? null, $t['postingDate'] ?? null);
        $amount = to_amount($t['amount'] ?? 0);
        $type = strtoupper((string)($t['type'] ?? '')); // OUT / IN
        $isIn = ($type !== 'OUT');
        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid.'_'.$amount, 'amount'=>$amount, 'des'=>$des, 'in'=>$isIn && $amount>0];
    }
    return $out;
}

function handle_vcb($json){
    $out = [];
    if (!is_array($json) || !isset($json['transactions']) || !is_array($json['transactions'])) return $out;

    foreach ($json['transactions'] as $t){
        $tid = $t['Reference'] ?? '';
        $amount = to_amount($t['Amount'] ?? 0);
        $des = $t['Description'] ?? '';

        // CD: thường "+" là vào, "-" là ra (tùy api). Mình ưu tiên chỉ nhận tiền vào khi CD != '-'
        $cd = (string)($t['CD'] ?? '');
        $isIn = ($cd !== '-');

        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>$isIn && $amount>0];
    }
    return $out;
}

function handle_bidv($json){
    $out = [];
    if (!is_array($json) || !isset($json['txnList']) || !is_array($json['txnList'])) return $out;
    foreach ($json['txnList'] as $t){
        $amount = to_amount($t['amount'] ?? 0);
        $des = $t['txnRemark'] ?? '';
        $tid = first_non_empty($t['txnId'] ?? null, ($t['txnDate'] ?? '').'_'.md5($des.$amount));
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>($amount>0)];
    }
    return $out;
}

function handle_seabank($json){
    $out = [];
    if (!is_array($json) || !isset($json['data']) || !is_array($json['data'])) return $out;
    foreach ($json['data'] as $t){
        $tid = $t['transID'] ?? '';
        $amount = to_amount($t['totalAmount'] ?? 0);
        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>($amount>0)];
    }
    return $out;
}

function handle_viettel($json){
    $out = [];
    $content = $json['data']['content'] ?? null;
    if (!is_array($content)) return $out;

    foreach ($content as $t){
        $tid = $t['bankTransId'] ?? '';
        $amount = to_amount($t['amount'] ?? 0);
        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>($amount>0)];
    }
    return $out;
}

function handle_thesieure($json){
    $out = [];
    if (!is_array($json) || !isset($json['data']) || !is_array($json['data'])) return $out;
    foreach ($json['data'] as $t){
        $tid = $t['transId'] ?? '';
        $amount = to_amount($t['amount'] ?? 0);
        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>($amount>0)];
    }
    return $out;
}

function handle_msb($json){
    $out = [];
    if (!is_array($json) || !isset($json['data']) || !is_array($json['data'])) return $out;
    foreach ($json['data'] as $t){
        $tid = $t['transactionId'] ?? '';
        $amount = to_amount($t['amount'] ?? 0);
        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>($amount>0)];
    }
    return $out;
}

function handle_tcb($json){
    $out = [];
    if (!is_array($json) || !isset($json['transactions']) || !is_array($json['transactions'])) return $out;
    foreach ($json['transactions'] as $t){
        $tid = $t['transactionID'] ?? '';
        $amount = to_amount($t['amount'] ?? 0);
        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>($amount>0)];
    }
    return $out;
}

function handle_vpbank($json){
    $out = [];
    if (!is_array($json) || !isset($json['data']) || !is_array($json['data'])) return $out;
    foreach ($json['data'] as $t){
        $tid = $t['transId'] ?? '';
        $amount = to_amount($t['amount'] ?? 0);
        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>($amount>0)];
    }
    return $out;
}

function handle_timo($json){
    $out = [];
    if (!is_array($json) || !isset($json['data']) || !is_array($json['data'])) return $out;
    foreach ($json['data'] as $t){
        $tid = $t['transId'] ?? '';
        $amount = to_amount($t['amount'] ?? 0);
        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>($amount>0)];
    }
    return $out;
}

function handle_vietabank($json){
    $out = [];
    if (!is_array($json) || !isset($json['data']) || !is_array($json['data'])) return $out;
    foreach ($json['data'] as $t){
        $tid = $t['transId'] ?? '';
        $amount = to_amount($t['amount'] ?? 0);
        $des = $t['description'] ?? '';
        $out[] = ['tid'=>$tid, 'amount'=>$amount, 'des'=>$des, 'in'=>($amount>0)];
    }
    return $out;
}

// =====================
// RUN ALL BANKS
// =====================
$totalSuccess = 0;
$totalSeen = 0;

foreach ($banks as $bankName => $cfg) {
    [$statusKey, $tokenKey, $endpointFmt, $handler] = $cfg;

    $enabled = (string)$LOCNGUYEN_SIEUTHICODE->site($statusKey);
    $token = trim((string)$LOCNGUYEN_SIEUTHICODE->site($tokenKey));

    if ($enabled !== '1') continue;
    if ($token === '') { log_err("{$bankName}: thiếu token ({$tokenKey})"); continue; }

    $url = sprintf($endpointFmt, rawurlencode($token));

    $raw = curl_get($url);
    if (!$raw) { log_err("{$bankName}: API empty"); continue; }

    $json = json_decode($raw, true);
    if (!is_array($json)) { log_err("{$bankName}: JSON lỗi"); continue; }

    // parse list
    if (!function_exists($handler)) { log_err("{$bankName}: handler không tồn tại"); continue; }
    $txs = $handler($json);

    if (!is_array($txs) || count($txs) == 0) {
        // không có giao dịch / sai format
        continue;
    }

    foreach ($txs as $tx) {
        $totalSeen++;

        $tid = $tx['tid'] ?? '';
        $amount = (float)($tx['amount'] ?? 0);
        $des = $tx['des'] ?? '';
        $isIn = (bool)($tx['in'] ?? false);

        if (!$isIn) continue;
        if ($amount <= 0) continue;

        $user = get_user_from_memo($LOCNGUYEN_SIEUTHICODE, $MEMO_PREFIX, $des);
        if (!$user) continue;

        $ok = process_topup($LOCNGUYEN_SIEUTHICODE, $user, $tid, $des, $amount, $bankName, $MIN_RECHARGE, $BONUS_PERCENT);
        if ($ok) $totalSuccess++;
    }
}

flock($fp, LOCK_UN);
fclose($fp);

echo "DONE. Seen={$totalSeen} | Success={$totalSuccess}" . PHP_EOL;