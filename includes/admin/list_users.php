<?php
CheckLogin();
CheckAdmin();

$sotin1trang = 10;
$page = isset($_GET['page']) ? max(1, (int)xss($_GET['page'])) : 1;
$from = ($page - 1) * $sotin1trang;

$where = ' `id` > 0 ';
$username = '';
$email = '';
$banned = '';

if (!empty($_GET['username'])) {
    $username = xss($_GET['username']);
    $where .= ' AND `username` LIKE "%' . $username . '%" ';
}
if (!empty($_GET['email'])) {
    $email = xss($_GET['email']);
    $where .= ' AND `email` LIKE "%' . $email . '%" ';
}
if (!empty($_GET['banned'])) {
    $banned = xss($_GET['banned']);
    if ($banned == 1) {
        $where .= ' AND `banned` = 0 ';
    } else if ($banned == 2) {
        $where .= ' AND `banned` = 1 ';
    }
}

$onlineSeconds = 60; // <= chỉnh: trong vòng 60s gần nhất coi là Online

// =====================================================
// ✅ FIX: AJAX JSON phải xử lý TRƯỚC mọi HTML/CSS/JS
// gọi: main.php?action=list_users&ajax=online_status&... (giữ filter)
// =====================================================
if (isset($_GET['ajax']) && $_GET['ajax'] === 'online_status') {
    header('Content-Type: application/json; charset=utf-8');

    $users = $LOCNGUYEN_SIEUTHICODE->get_list("
        SELECT `id`,`last_activity`
        FROM `tbl_users`
        WHERE $where
        ORDER BY `id` DESC
        LIMIT $from,$sotin1trang
    ");

    $now = time();
    $data = [];
    $onlineCount = 0;

    foreach ($users as $it) {
        $on = false;
        if (!empty($it['last_activity'])) {
            $on = (strtotime($it['last_activity']) >= ($now - $onlineSeconds));
        }
        if ($on) $onlineCount++;

        $data[] = [
            'id' => (int)$it['id'],
            'online' => $on ? 1 : 0,
            'last_activity' => $it['last_activity'] ? $it['last_activity'] : ''
        ];
    }

    echo json_encode([
        'status' => 'success',
        'onlineSeconds' => $onlineSeconds,
        'onlineCount' => $onlineCount,
        'rows' => $data
    ]);
    exit;
}

// load data cho trang HTML
$listUser = $LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_users` WHERE $where ORDER BY `id` DESC LIMIT $from,$sotin1trang ");
$tong = (int)$LOCNGUYEN_SIEUTHICODE->num_rows("SELECT * FROM `tbl_users` WHERE $where");
?>

<style>
    :root{
        --card:#0f172a;
        --card2:#0b142c;
        --border: rgba(255,255,255,.10);
        --muted: rgba(255,255,255,.70);
        --text: rgba(255,255,255,.92);
        --focus: rgba(59,130,246,.40);
        --primary:#3b82f6;
        --primary2:#2563eb;
        --danger:#ef4444;
        --good:#22c55e;
        --warn:#f59e0b;
        --shadow: 0 18px 60px rgba(0,0,0,.35);
        --radius: 16px;
        --chip: rgba(255,255,255,.08);
        --glass: rgba(2,6,23,.25);
    }

    .u-wrap{ padding: 14px 10px; }

    .u-hero{
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        overflow:hidden;
        background:
            radial-gradient(1100px 260px at 10% 0%, rgba(59,130,246,.28), transparent 60%),
            radial-gradient(1100px 280px at 90% 0%, rgba(245,158,11,.14), transparent 55%),
            linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        padding: 16px 18px;
        color: var(--text);
        margin-bottom: 14px;
    }
    .u-hero h3{ margin:0; font-weight:900; letter-spacing:.2px; font-size:18px; }
    .u-hero p{ margin:8px 0 0 0; color: var(--muted); font-size:13px; line-height:1.4; display:flex; gap:10px; flex-wrap:wrap; }

    .chip{
        display:inline-flex; align-items:center; gap:8px;
        padding: 6px 10px; border-radius: 999px;
        background: var(--chip);
        border: 1px solid rgba(255,255,255,.10);
        font-weight: 900; font-size: 12px;
        color: rgba(255,255,255,.88);
        white-space: nowrap;
    }
    .dot{ width:9px; height:9px; border-radius:50%;
        background: rgba(255,255,255,.45);
        box-shadow: 0 0 0 4px rgba(255,255,255,.08);
    }
    .dot.good{ background: var(--good); box-shadow:0 0 0 4px rgba(34,197,94,.15); }
    .dot.bad{ background: var(--danger); box-shadow:0 0 0 4px rgba(239,68,68,.15); }

    .cardx{
        background: linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow:hidden;
    }
    .cardx .head{
        padding: 14px 16px;
        border-bottom: 1px solid var(--border);
        display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap;
    }
    .cardx .title{
        margin:0; font-size: 13px; font-weight: 900;
        color: rgba(255,255,255,.92); letter-spacing:.2px;
        display:flex; align-items:center; gap:10px;
        text-transform: uppercase;
    }
    .cardx .body{ padding: 16px; }

    .f-input,.f-select{
        width:100%;
        border-radius: 12px !important;
        border: 1px solid rgba(255,255,255,.14) !important;
        background: rgba(15,23,42,.65) !important;
        color: rgba(255,255,255,.92) !important;
        padding: 11px 12px !important;
        outline:none !important;
        transition:.18s ease;
    }
    .f-input:focus,.f-select:focus{ box-shadow: 0 0 0 4px var(--focus) !important; border-color: rgba(59,130,246,.55) !important; }

    .btnx{
        border-radius: 12px !important;
        padding: 10px 14px !important;
        font-weight: 900 !important;
        letter-spacing: .2px;
        border: 0 !important;
        color:#fff !important;
        display:inline-flex !important;
        align-items:center !important;
        gap:8px !important;
        cursor:pointer !important;
        transition:.18s ease !important;
        text-decoration:none !important;
        white-space: nowrap;
    }
    .btnx:hover{ filter: brightness(1.05); transform: translateY(-1px); }
    .btn-search{ background: linear-gradient(135deg, var(--primary), var(--primary2)) !important; box-shadow: 0 12px 34px rgba(59,130,246,.22); }
    .btn-all{ background: linear-gradient(135deg, var(--danger), #dc2626) !important; box-shadow: 0 12px 34px rgba(239,68,68,.18); }

    .table-shell{
        border: 1px solid rgba(255,255,255,.10);
        border-radius: 14px;
        overflow:hidden;
        background: var(--glass);
    }
    .table-modern{ margin:0; color: rgba(255,255,255,.92); width:100%; }
    .table-modern thead th{
        background: rgba(255,255,255,.06) !important;
        color: rgba(255,255,255,.85) !important;
        font-weight: 900 !important;
        border-bottom: 1px solid rgba(255,255,255,.10) !important;
        white-space: nowrap;
        font-size: 12.5px;
        letter-spacing:.2px;
        padding: 12px 12px !important;
    }
    .table-modern tbody td{
        border-top: 1px solid rgba(255,255,255,.06) !important;
        padding: 12px 12px !important;
        vertical-align: top !important;
        font-size: 13.5px;
        color: rgba(255,255,255,.90) !important;
    }
    .table-modern tbody tr:hover{ background: rgba(255,255,255,.03); }

    .u-box{
        margin:0;
        padding-left: 16px;
        color: rgba(255,255,255,.88);
    }
    .u-box li{ margin-bottom: 4px; }
    .u-k{ color: rgba(255,255,255,.70); font-weight:800; }
    .u-v{ color: rgba(255,255,255,.92); font-weight:900; }

    .pill{
        display:inline-flex; align-items:center; gap:8px;
        padding: 6px 10px; border-radius: 999px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.10);
        font-weight: 900; font-size: 12px;
        color: rgba(255,255,255,.88);
        white-space: nowrap;
    }

    .btn-icon{
        border-radius: 12px !important;
        border: 1px solid rgba(255,255,255,.12) !important;
        background: rgba(255,255,255,.06) !important;
        color: rgba(255,255,255,.92) !important;
        padding: 8px 10px !important;
        display:inline-flex;
        align-items:center;
        gap:8px;
        text-decoration:none !important;
        transition:.18s ease;
        white-space:nowrap;
        cursor:pointer;
    }
    .btn-icon:hover{ transform: translateY(-1px); background: rgba(255,255,255,.10) !important; color:#fff !important; }
    .btn-icon.del{ border-color: rgba(239,68,68,.35) !important; }
    .btn-icon.edit{ border-color: rgba(59,130,246,.35) !important; }

    .online-badge{
        display:inline-flex; align-items:center; gap:8px;
        padding: 6px 10px;
        border-radius: 999px;
        border: 1px solid rgba(255,255,255,.10);
        background: rgba(255,255,255,.06);
        font-weight: 900;
        font-size: 12px;
        white-space: nowrap;
    }
    .online-badge small{ font-weight:800; opacity:.75; }
    .online-on{ border-color: rgba(34,197,94,.35); }
    .online-off{ border-color: rgba(148,163,184,.35); }
    .online-on .dot{ background: var(--good); box-shadow:0 0 0 4px rgba(34,197,94,.15); }
    .online-off .dot{ background: rgba(148,163,184,.85); box-shadow:0 0 0 4px rgba(148,163,184,.12); }

    @media (max-width: 576px){
        .cardx .body{ padding: 14px; }
        .btnx{ width:100%; justify-content:center; }
    }
</style>

<div class="container-fluid u-wrap">

    <div class="u-hero">
        <h3>Danh Sách Khách Hàng</h3>
        <p>
            <span class="chip"><span class="dot good"></span>Kết quả: <?= format_cash($tong) ?></span>
            <span class="chip"><span class="dot"></span>Trang: <?= $page ?></span>
            <span class="chip"><span class="dot"></span>Online: <span id="onlineCount">...</span></span>
        </p>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="cardx">
                <div class="head">
                    <p class="title"><span class="dot"></span>Bộ lọc</p>
                </div>
                <div class="body">
                    <form action="" method="GET" enctype="multipart/form-data" id="filterForm">
                        <input type="hidden" name="action" value="list_users">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-3">
                                <input type="text" name="username" class="f-input" placeholder="Tên đăng nhập"
                                       value="<?= htmlspecialchars($username) ?>">
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <input type="email" name="email" class="f-input" placeholder="Email"
                                       value="<?= htmlspecialchars($email) ?>">
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <select name="banned" class="f-select" data-toggle="select2">
                                    <option value="">Trạng thái</option>
                                    <option value="1" <?= ($banned==='1' ? 'selected' : '') ?>>Hoạt động</option>
                                    <option value="2" <?= ($banned==='2' ? 'selected' : '') ?>>Đang khóa</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3 d-flex" style="gap:10px; flex-wrap:wrap;">
                                <button class="btnx btn-search" type="submit" name="filter" value="1">
                                    <i class="fa fa-search"></i> Tìm kiếm
                                </button>
                                <a href="main.php?action=list_users" class="btnx btn-all">
                                    <i class="fa fa-refresh"></i> Tất cả
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="table-shell mt-2">
                        <div class="table-responsive">
                            <table class="table table-modern" id="usersTable">
                                <thead>
                                    <tr>
                                        <th>Tài khoản</th>
                                        <th>Ví</th>
                                        <th>Bảo mật</th>
                                        <th>Admin</th>
                                        <th>Online</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($listUser)): foreach ($listUser as $u):
                                    $isOnline = false;
                                    if (!empty($u['last_activity'])) {
                                        $isOnline = (strtotime($u['last_activity']) >= (time() - $onlineSeconds));
                                    }
                                ?>
                                    <tr data-user-id="<?= (int)$u['id'] ?>">
                                        <td>
                                            <ul class="u-box">
                                                <li>
                                                    <span class="u-k">Tên đăng nhập:</span>
                                                    <span class="u-v"><?= $u['username']; ?></span>
                                                    <span class="pill">#<?= $u['id']; ?></span>
                                                </li>
                                                <li><span class="u-k">Email:</span>
                                                    <span class="u-v" style="color: rgba(34,197,94,.95)"><?= $u['email']; ?></span>
                                                </li>
                                                <li>
                                                    <?php if ($u['banned'] == '0'): ?>
                                                        <span class="pill"><span class="dot good"></span>Đang hoạt động</span>
                                                    <?php else: ?>
                                                        <span class="pill"><span class="dot bad"></span>Đang khóa</span>
                                                    <?php endif; ?>
                                                </li>
                                            </ul>
                                        </td>

                                        <td>
                                            <ul class="u-box">
                                                <li><span class="u-k">Số dư khả dụng:</span>
                                                    <span class="u-v" style="color: rgba(59,130,246,.95)"><?= format_cash($u['coin']); ?></span>
                                                </li>
                                                <li><span class="u-k">Tổng số tiền nạp:</span>
                                                    <span class="u-v" style="color: rgba(239,68,68,.95)"><?= format_cash($u['total_coin']); ?></span>
                                                </li>
                                            </ul>
                                        </td>

                                        <td>
                                            <ul class="u-box">
                                                <li><span class="u-k">IP:</span> <span class="u-v"><?= $u['ip']; ?></span></li>
                                                <li><span class="u-k">Ngày tham gia:</span> <span class="u-v"><?= $u['create_date']; ?></span></li>
                                            </ul>
                                        </td>

                                        <td><?= role($u['role']); ?></td>

                                        <td class="online-cell">
                                            <?php if ($isOnline): ?>
                                                <span class="online-badge online-on">
                                                    <span class="dot"></span> ON
                                                    <small class="ml-1">(<?= htmlspecialchars($u['last_activity']) ?>)</small>
                                                </span>
                                            <?php else: ?>
                                                <span class="online-badge online-off">
                                                    <span class="dot"></span> OFF
                                                    <small class="ml-1">(<?= $u['last_activity'] ? htmlspecialchars($u['last_activity']) : '---' ?>)</small>
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <div class="d-flex flex-wrap" style="gap:8px;">
                                                <a class="btn-icon edit" href="main.php?action=edit_users&id=<?= (int)$u['id'] ?>" title="Chỉnh sửa thành viên">
                                                    <i class="fa fa-edit"></i> Sửa
                                                </a>
                                                <button type="button" class="btn-icon del" onclick="RemoveRow(<?= (int)$u['id'] ?>)" title="Xóa thành viên">
                                                    <i class="fa fa-trash"></i> Xóa
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="6" style="padding:18px 12px;">Không có dữ liệu.</td></tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php
                    if ($tong > $sotin1trang) {
                        $base = 'main.php?action=list_users&';
                        if ($username !== '') $base .= 'username=' . urlencode($username) . '&';
                        if ($email !== '') $base .= 'email=' . urlencode($email) . '&';
                        if ($banned !== '') $base .= 'banned=' . urlencode($banned) . '&';

                        echo '<center>' . pagination_account($base, $from, $tong, $sotin1trang) . '</center>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function RemoveRow(id) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Xóa Thành Viên",
            message: "Bạn có chắc chắn muốn xóa thành viên này không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
        }).then((e) => {
            if (e) {
                $.ajax({
                    url: "/ajaxs/action/removeUser.php",
                    method: "POST",
                    dataType: "JSON",
                    data: { action: "delete", id: id },
                    success: function(respone) {
                        if (respone.status == 'success') {
                            cuteToast({ type: "success", message: respone.msg, timer: 1000 });
                            location.reload();
                        } else {
                            cuteAlert({ type: "error", title: "Error", message: respone.msg, buttonText: "Okay" });
                        }
                    },
                    error: function() {
                        location.reload();
                    }
                });
            }
        })
    }
</script>

<script>
(function(){
    function buildAjaxUrl(){
        const url = new URL(window.location.href);
        url.searchParams.set('ajax', 'online_status');
        url.searchParams.set('action', 'list_users');
        return url.toString();
    }

    function renderBadge(isOnline, last){
        const safeLast = last ? last : '---';
        if (isOnline){
            return `
                <span class="online-badge online-on">
                    <span class="dot"></span> ON
                    <small class="ml-1">(${safeLast})</small>
                </span>
            `;
        }
        return `
            <span class="online-badge online-off">
                <span class="dot"></span> OFF
                <small class="ml-1">(${safeLast})</small>
            </span>
        `;
    }

    async function refreshOnline(){
        try{
            const r = await fetch(buildAjaxUrl(), { cache: "no-store", credentials: "include" });
            const j = await r.json();
            if (!j || j.status !== 'success') return;

            const oc = document.getElementById('onlineCount');
            if (oc) oc.textContent = j.onlineCount;

            (j.rows || []).forEach(item => {
                const tr = document.querySelector(`tr[data-user-id="${item.id}"]`);
                if (!tr) return;
                const td = tr.querySelector('.online-cell');
                if (!td) return;
                td.innerHTML = renderBadge(item.online === 1, item.last_activity);
            });
        }catch(e){}
    }

    refreshOnline();
    setInterval(refreshOnline, 15000);
})();
</script>