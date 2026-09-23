<?php
CheckLogin();
CheckAdmin();
?>

<style>
    :root{
        --card:#0f172a;
        --card2:#0b142c;
        --border: rgba(255,255,255,.10);
        --muted: rgba(255,255,255,.70);
        --text: rgba(255,255,255,.92);
        --shadow: 0 18px 60px rgba(0,0,0,.35);
        --radius: 16px;
        --primary:#3b82f6;
        --primary2:#2563eb;
        --good:#22c55e;
        --danger:#ef4444;
        --chip: rgba(255,255,255,.08);
        --focus: rgba(59,130,246,.40);
    }
    .dash-wrap{ padding: 14px 10px; }

    .hero{
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        overflow:hidden;
        background:
            radial-gradient(1100px 260px at 10% 0%, rgba(59,130,246,.28), transparent 60%),
            radial-gradient(1100px 280px at 90% 0%, rgba(34,197,94,.14), transparent 55%),
            linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        padding: 16px 18px;
        color: var(--text);
        margin-bottom: 14px;
    }
    .hero-top{
        display:flex;
        align-items:flex-start;
        justify-content:space-between;
        gap:12px;
        flex-wrap:wrap;
    }
    .hero h3{
        margin:0;
        font-weight: 900;
        letter-spacing:.2px;
        font-size: 18px;
        line-height: 1.2;
    }
    .hero p{ margin:6px 0 0 0; color: var(--muted); font-size: 13px; }
    .chip{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding: 6px 10px;
        border-radius: 999px;
        background: var(--chip);
        border: 1px solid rgba(255,255,255,.10);
        font-weight: 900;
        font-size: 12px;
        color: rgba(255,255,255,.88);
        white-space: nowrap;
    }
    .btn-soft{
        border-radius: 12px !important;
        padding: 10px 14px !important;
        font-weight: 900 !important;
        letter-spacing: .15px;
        border: 1px solid rgba(255,255,255,.12) !important;
        background: rgba(255,255,255,.06) !important;
        color: rgba(255,255,255,.92) !important;
        display:inline-flex;
        align-items:center;
        gap:8px;
        white-space:nowrap;
        transition:.18s ease;
        text-decoration:none !important;
    }
    .btn-soft:hover{ transform: translateY(-1px); background: rgba(255,255,255,.10) !important; color:#fff !important; }

    .grid{
        display:grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 12px;
    }
    .cardx{
        grid-column: span 3;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        background: linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        box-shadow: var(--shadow);
        overflow:hidden;
        padding: 14px;
    }
    .cardx .kpi{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:10px;
    }
    .kpi h2{
        margin:0;
        font-size: 22px;
        font-weight: 900;
        color: rgba(255,255,255,.92);
        line-height: 1.1;
    }
    .kpi p{
        margin:6px 0 0 0;
        color: rgba(255,255,255,.68);
        font-size: 12.5px;
        font-weight: 700;
    }
    .iconbox{
        width: 44px; height: 44px;
        border-radius: 14px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.10);
        display:flex;
        align-items:center;
        justify-content:center;
        color: rgba(255,255,255,.80);
        flex: 0 0 auto;
    }

    .panel{
        grid-column: span 8;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        background: linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        box-shadow: var(--shadow);
        overflow:hidden;
    }
    .panel-head{
        padding: 14px 16px;
        border-bottom: 1px solid var(--border);
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        flex-wrap:wrap;
    }
    .panel-title{
        margin:0;
        font-size: 13px;
        font-weight: 900;
        color: rgba(255,255,255,.92);
        letter-spacing:.2px;
        display:flex;
        align-items:center;
        gap:10px;
    }
    .dot{
        width:10px;height:10px;border-radius:50%;
        background: linear-gradient(135deg, #22c55e, #3b82f6);
        box-shadow: 0 0 0 4px rgba(34,197,94,.12);
    }
    .panel-body{ padding: 14px 16px; }
    .panel-sub{ margin:0; color: rgba(255,255,255,.65); font-size: 12.5px; }

    .panel-small{ grid-column: span 4; }

    .table-shell{
        border: 1px solid rgba(255,255,255,.10);
        border-radius: 14px;
        overflow:hidden;
        background: rgba(2,6,23,.25);
    }
    table{ margin:0 !important; }
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
        vertical-align: middle !important;
        font-size: 13.5px;
        color: rgba(255,255,255,.90) !important;
    }
    .table-modern tbody tr:hover{ background: rgba(255,255,255,.03); }

    .badge-soft{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.10);
        font-weight: 900;
        font-size: 12px;
        color: rgba(255,255,255,.88);
    }
    .b-dot{ width:9px;height:9px;border-radius:50%; background: rgba(255,255,255,.45); box-shadow: 0 0 0 4px rgba(255,255,255,.08); }
    .b-dot.good{ background: var(--good); box-shadow:0 0 0 4px rgba(34,197,94,.15); }
    .b-dot.bad{ background: var(--danger); box-shadow:0 0 0 4px rgba(239,68,68,.15); }

    .mini{
        display:flex;
        gap:10px;
        flex-wrap:wrap;
        align-items:center;
        justify-content:flex-end;
    }
    .switchx{
        display:flex; align-items:center; gap:8px;
        color: rgba(255,255,255,.78); font-weight: 800; font-size: 12.5px;
        user-select:none;
    }
    .switchx input{ accent-color: var(--primary); width: 16px; height: 16px; }

    @media (max-width: 1200px){
        .cardx{ grid-column: span 6; }
        .panel{ grid-column: span 12; }
        .panel-small{ grid-column: span 12; }
    }
    @media (max-width: 576px){
        .cardx{ grid-column: span 12; }
    }
</style>

<?php
// ====== KPI HÔM NAY (giữ logic query như bạn đang dùng) ======
$todayUsers = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `tbl_users` WHERE `create_date` >= DATE(NOW()) AND `create_date` < DATE(NOW()) + INTERVAL 1 DAY ")['COUNT(id)'];
$todayCards = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `cards` WHERE `create_date` >= DATE(NOW()) AND `create_date` < DATE(NOW()) + INTERVAL 1 DAY ")['COUNT(id)'];
$todayBank  = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `bank_auto` WHERE `create_date` >= DATE(NOW()) AND `create_date` < DATE(NOW()) + INTERVAL 1 DAY ")['COUNT(id)'];
$todayRev   = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT SUM(`price`) FROM `tbl_history_hack` WHERE `create_date` >= DATE(NOW()) AND `create_date` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`price`)'];

// ====== KPI TỔNG ======
$totalUsers = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `tbl_users`")['COUNT(id)'];
$totalCards = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `cards`")['COUNT(id)'];
$totalBank  = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `bank_auto`")['COUNT(id)'];
$totalRev   = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT SUM(`price`) FROM `tbl_history_hack`")['SUM(`price`)'];

// ====== BIỂU ĐỒ 7 NGÀY (thêm chức năng) ======
$labels = [];
$seriesUsers = [];
$seriesCards = [];
$seriesBank  = [];
$seriesRev   = [];

for ($i = 6; $i >= 0; $i--) {
    $day = date('Y-m-d', strtotime("-$i day"));
    $labels[] = date('d/m', strtotime($day));

    $u = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `tbl_users` WHERE DATE(`create_date`) = '$day' ")['COUNT(id)'];
    $c = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `cards` WHERE DATE(`create_date`) = '$day' ")['COUNT(id)'];
    $b = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `bank_auto` WHERE DATE(`create_date`) = '$day' ")['COUNT(id)'];
    $r = (int)$LOCNGUYEN_SIEUTHICODE->get_row("SELECT SUM(`price`) FROM `tbl_history_hack` WHERE DATE(`create_date`) = '$day' ")['SUM(`price`)'];

    $seriesUsers[] = $u;
    $seriesCards[] = $c;
    $seriesBank[]  = $b;
    $seriesRev[]   = $r;
}

// ====== TOP DOANH THU HÔM NAY (thêm chức năng) ======
// Nếu tbl_history_hack có user_id => join sang tbl_users (phổ biến).
// Nếu bạn không có user_id, hãy đổi query sang cột phù hợp (vd: username).
$topToday = $LOCNGUYEN_SIEUTHICODE->get_list("
    SELECT h.user_id, SUM(h.price) AS total_price
    FROM tbl_history_hack h
    WHERE h.create_date >= DATE(NOW()) AND h.create_date < DATE(NOW()) + INTERVAL 1 DAY
    GROUP BY h.user_id
    ORDER BY total_price DESC
    LIMIT 5
");

// ====== HOẠT ĐỘNG GẦN ĐÂY (thêm chức năng) ======
$recent = $LOCNGUYEN_SIEUTHICODE->get_list("
    SELECT *
    FROM tbl_history_hack
    WHERE create_date >= DATE(NOW()) AND create_date < DATE(NOW()) + INTERVAL 1 DAY
    ORDER BY id DESC
    LIMIT 10
");
?>

<div class="container-fluid dash-wrap">

    <div class="hero">
        <div class="hero-top">
            <div>
                <h3>Thống Kê Hệ Thống</h3>
                <p>
                    Phiên bản hiện tại:
                    <span class="chip"><span class="b-dot"></span><?= $config['version'] ?></span>
                    <span class="chip"><span class="b-dot good"></span>24-12-2023: update website</span>
                    <span class="chip"><span class="b-dot good"></span>03-03-2026: cập nhật chức năng cần thiết</span>
                </p>
            </div>

            <div class="mini">
                <label class="switchx">
                    <input type="checkbox" id="autoRefresh">
                    Auto refresh 60s
                </label>
                <a class="btn-soft" href="javascript:void(0)" onclick="location.reload();">
                    <i class="fa fa-refresh"></i> Làm mới
                </a>
            </div>
        </div>
    </div>

    <div class="grid">
        <!-- KPI hôm nay -->
        <div class="cardx">
            <div class="kpi">
                <div>
                    <h2><?= format_cash($todayUsers) ?></h2>
                    <p>Đăng ký hôm nay</p>
                </div>
                <div class="iconbox"><i class="fa fa-user-plus"></i></div>
            </div>
        </div>

        <div class="cardx">
            <div class="kpi">
                <div>
                    <h2><?= format_cash($todayCards) ?></h2>
                    <p>Thẻ nạp hôm nay</p>
                </div>
                <div class="iconbox"><i class="fa fa-credit-card"></i></div>
            </div>
        </div>

        <div class="cardx">
            <div class="kpi">
                <div>
                    <h2><?= format_cash($todayBank) ?></h2>
                    <p>Nạp bank hôm nay</p>
                </div>
                <div class="iconbox"><i class="fa fa-university"></i></div>
            </div>
        </div>

        <div class="cardx">
            <div class="kpi">
                <div>
                    <h2><?= format_cash($todayRev) ?>đ</h2>
                    <p>Thu nhập hôm nay</p>
                </div>
                <div class="iconbox"><i class="fa fa-line-chart"></i></div>
            </div>
        </div>

        <!-- Biểu đồ 7 ngày -->
        <div class="panel">
            <div class="panel-head">
                <p class="panel-title"><span class="dot"></span>Biểu đồ 7 ngày gần nhất</p>
                <p class="panel-sub">Theo dõi xu hướng đăng ký / nạp / doanh thu</p>
            </div>
            <div class="panel-body">
                <canvas id="chart7d" height="110"></canvas>
            </div>
        </div>

        <!-- KPI tổng -->
        <div class="panel panel-small">
            <div class="panel-head">
                <p class="panel-title"><span class="dot"></span>Tổng quan hệ thống</p>
                <p class="panel-sub">Tổng số liệu</p>
            </div>
            <div class="panel-body">
                <div style="display:grid; grid-template-columns: 1fr; gap:10px;">
                    <div class="badge-soft"><span class="b-dot good"></span> Tổng thành viên: <?= format_cash($totalUsers) ?></div>
                    <div class="badge-soft"><span class="b-dot good"></span> Tổng thẻ nạp: <?= format_cash($totalCards) ?></div>
                    <div class="badge-soft"><span class="b-dot good"></span> Tổng nạp bank: <?= format_cash($totalBank) ?></div>
                    <div class="badge-soft"><span class="b-dot good"></span> Tổng thu nhập: <?= format_cash($totalRev) ?>đ</div>
                </div>
            </div>
        </div>

        <!-- Top doanh thu hôm nay -->
        <div class="panel panel-small">
            <div class="panel-head">
                <p class="panel-title"><span class="dot"></span>Top doanh thu hôm nay</p>
                <p class="panel-sub">Top 5 người mua nhiều nhất</p>
            </div>
            <div class="panel-body">
                <div class="table-shell">
                    <div class="table-responsive">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Người dùng</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($topToday)) : $i=0; foreach ($topToday as $t) : $i++; ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td>
                                            <?php
                                                // Nếu có tbl_users.id:
                                                $u = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT username FROM tbl_users WHERE id='".(int)$t['user_id']."' ");
                                                echo !empty($u['username']) ? $u['username'] : ('UID: '.(int)$t['user_id']);
                                            ?>
                                        </td>
                                        <td style="font-weight:900;"><?= format_cash((int)$t['total_price']) ?>đ</td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="3">Chưa có dữ liệu hôm nay.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hoạt động gần đây -->
        <div class="panel">
            <div class="panel-head">
                <p class="panel-title"><span class="dot"></span>Hoạt động gần đây (hôm nay)</p>
                <p class="panel-sub">10 giao dịch hack mới nhất</p>
            </div>
            <div class="panel-body">
                <div class="table-shell">
                    <div class="table-responsive">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Người dùng</th>
                                    <th>Số tiền</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($recent)) : foreach ($recent as $r) : ?>
                                    <tr>
                                        <td><?= $r['id'] ?></td>
                                        <td>
                                            <?php
                                                // Tùy bảng của bạn: nếu có user_id thì map sang username
                                                if (isset($r['user_id'])) {
                                                    $u2 = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT username FROM tbl_users WHERE id='".(int)$r['user_id']."' ");
                                                    echo !empty($u2['username']) ? $u2['username'] : ('UID: '.(int)$r['user_id']);
                                                } else {
                                                    // fallback nếu bảng không có user_id:
                                                    echo isset($r['username']) ? $r['username'] : 'N/A';
                                                }
                                            ?>
                                        </td>
                                        <td style="font-weight:900;"><?= format_cash((int)$r['price']) ?>đ</td>
                                        <td><?= $r['create_date'] ?></td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="4">Chưa có giao dịch hôm nay.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /grid -->
</div>

<!-- Chart.js (thêm chức năng) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    // Call update.php như code cũ của bạn (giữ nguyên logic)
    $.ajax({
        url: "update.php",
        type: "GET",
        dateType: "text",
        data: {},
        success: function(result) {}
    });

    const labels = <?= json_encode($labels) ?>;
    const dataUsers = <?= json_encode($seriesUsers) ?>;
    const dataCards = <?= json_encode($seriesCards) ?>;
    const dataBank  = <?= json_encode($seriesBank) ?>;
    const dataRev   = <?= json_encode($seriesRev) ?>;

    const ctx = document.getElementById('chart7d');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    { label: 'Đăng ký', data: dataUsers, tension: 0.35 },
                    { label: 'Thẻ nạp', data: dataCards, tension: 0.35 },
                    { label: 'Nạp bank', data: dataBank, tension: 0.35 },
                    { label: 'Doanh thu (đ)', data: dataRev, tension: 0.35 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { labels: { color: 'rgba(255,255,255,.85)', font: { weight: '700' } } },
                    tooltip: { enabled: true }
                },
                scales: {
                    x: { ticks: { color: 'rgba(255,255,255,.75)' }, grid: { color: 'rgba(255,255,255,.06)' } },
                    y: { ticks: { color: 'rgba(255,255,255,.75)' }, grid: { color: 'rgba(255,255,255,.06)' } }
                }
            }
        });
    }

    // Auto refresh 60s (tùy chọn - UI only)
    (function(){
        const cb = document.getElementById('autoRefresh');
        let timer = null;
        if (!cb) return;

        cb.addEventListener('change', function(){
            if (this.checked) {
                timer = setInterval(() => location.reload(), 60000);
            } else {
                if (timer) clearInterval(timer);
                timer = null;
            }
        });
    })();
</script>