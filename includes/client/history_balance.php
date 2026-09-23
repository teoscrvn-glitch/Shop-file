<?php
CheckLogin();

$sotin1trang = 10;
$page = isset($_GET['page']) ? xss((int)$_GET['page']) : 1;
$page = max(1, $page);
$from = ($page - 1) * $sotin1trang;
?>

<style>
    :root{
        --bg0:#070b14;
        --bg1:#0b1220;
        --panel: rgba(255,255,255,.06);
        --panel2: rgba(255,255,255,.08);
        --border: rgba(255,255,255,.12);
        --text: rgba(255,255,255,.92);
        --muted: rgba(255,255,255,.68);
        --shadow: 0 18px 55px rgba(0,0,0,.45);
        --radius: 18px;

        --good:#22c55e;
        --bad:#ef4444;
        --warn:#f59e0b;
        --blue:#3b82f6;
    }

    /* ===== FORCE DARK (fix chỗ trắng chỗ đen) ===== */
    html, body{
        background:
            radial-gradient(900px 380px at 10% -10%, rgba(59,130,246,.26), transparent 55%),
            radial-gradient(820px 360px at 95% 0%, rgba(34,197,94,.18), transparent 60%),
            linear-gradient(180deg, var(--bg0), var(--bg1) 55%, #070a12) !important;
        color: var(--text) !important;
    }

    /* các khung theme hay làm nền trắng */
    .container, .box-home, .box-cate, .table-popcart,
    .card, .card-body, .content, .content-wrapper,
    .block-content, .all{
        background: transparent !important;
        color: var(--text) !important;
    }

    /* tiêu đề cũ */
    .title01{
        font-weight: 900;
        letter-spacing: .2px;
        font-size: 18px;
        color: var(--text) !important;
        margin: 0 0 10px 0;
    }

    /* ===== Layout wrapper ===== */
    .wrap-balance{
        margin-top: 80px;
        padding-bottom: 26px;
    }

    .hero{
        border-radius: var(--radius);
        padding: 18px 18px 14px;
        background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.04)) !important;
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }
    .hero:before{
        content:"";
        position:absolute; inset:-2px;
        background:
            radial-gradient(520px 180px at 10% 10%, rgba(239,68,68,.14), transparent 60%),
            radial-gradient(520px 180px at 95% 0%, rgba(59,130,246,.22), transparent 62%);
        pointer-events:none;
    }
    .hero > *{ position: relative; }

    .hero-title{
        margin:0;
        display:flex;
        align-items:center;
        gap:10px;
        font-weight: 900;
        font-size: 20px;
    }
    .hero-sub{
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.45;
    }

    .panel{
        margin-top: 14px;
        border-radius: var(--radius);
        background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.04)) !important;
        border: 1px solid var(--border);
        box-shadow: 0 14px 45px rgba(0,0,0,.35);
        overflow: hidden;
    }
    .panel-head{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:10px;
        padding: 12px 14px;
        border-bottom: 1px solid rgba(255,255,255,.08);
        background: rgba(0,0,0,.14);
    }
    .pill{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding: 7px 10px;
        border-radius: 999px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.10);
        color: var(--muted);
        font-size: 13px;
        white-space: nowrap;
    }

    /* ===== Table: override sạch bootstrap trắng ===== */
    .table-wrap{
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        background: transparent !important;
    }

    table.table{
        min-width: 980px;
        margin: 0 !important;
        color: var(--text) !important;
        background: transparent !important;
    }

    .table-bordered{
        border: 1px solid rgba(255,255,255,.12) !important;
    }

    .table thead{
        background: transparent !important;
    }
    .table thead th{
        position: sticky;
        top: 0;
        z-index: 2;
        background: rgba(0,0,0,.35) !important;
        color: rgba(255,255,255,.92) !important;
        border-color: rgba(255,255,255,.12) !important;
        font-weight: 900;
        letter-spacing: .2px;
        white-space: nowrap;
    }

    .table tbody tr{
        background: rgba(255,255,255,.02) !important;
    }
    .table-striped tbody tr:nth-of-type(odd){
        background: rgba(255,255,255,.04) !important; /* không trắng nữa */
    }

    .table td, .table th{
        border-color: rgba(255,255,255,.10) !important;
        vertical-align: middle !important;
        background: transparent !important;
    }

    .mono{
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono","Courier New", monospace;
        font-size: 13px;
    }

    .amt{
        font-weight: 900;
        letter-spacing: .15px;
        white-space: nowrap;
    }
    .amt.in{ color: rgba(34,197,94,.95) !important; }
    .amt.out{ color: rgba(239,68,68,.95) !important; }
    .amt.neu{ color: rgba(245,158,11,.95) !important; }

    .badge-soft{
        display:inline-flex;
        align-items:center;
        gap:6px;
        padding: 5px 10px;
        border-radius: 999px;
        font-weight: 900;
        font-size: 12px;
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.06);
        color: rgba(255,255,255,.92);
        white-space: nowrap;
    }
    .dot{
        width: 8px; height: 8px; border-radius: 999px; display:inline-block;
        background: rgba(255,255,255,.35);
        box-shadow: 0 0 0 3px rgba(255,255,255,.06);
    }
    .dot.in{ background: var(--good); box-shadow: 0 0 0 3px rgba(34,197,94,.16); }
    .dot.out{ background: var(--bad); box-shadow: 0 0 0 3px rgba(239,68,68,.16); }
    .dot.neu{ background: var(--warn); box-shadow: 0 0 0 3px rgba(245,158,11,.16); }

    .note{
        max-width: 520px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: rgba(255,255,255,.86);
    }

    /* pagination (nếu theme ra nền trắng) */
    .pagination, .page-item, .page-link{
        background: transparent !important;
    }
    .page-link{
        background: rgba(255,255,255,.06) !important;
        border: 1px solid rgba(255,255,255,.12) !important;
        color: rgba(255,255,255,.88) !important;
        border-radius: 12px !important;
        margin: 0 4px;
    }
    .page-item.active .page-link{
        background: rgba(59,130,246,.25) !important;
        border-color: rgba(59,130,246,.45) !important;
        color: #fff !important;
    }
    .page-link:hover{
        filter: brightness(1.06);
    }

    @media (max-width: 576px){
        .wrap-balance{ margin-top: 70px; }
        .hero{ padding: 16px 14px 12px; }
        .hero-title{ font-size: 19px; }
        .hero-sub{ font-size: 13px; }
        .panel-head{ padding: 11px 12px; }
        .pill{ font-size: 12px; }
    }
</style>

<div class="container wrap-balance">
    <div class="hero">
        <div class="hero-title">
            <i class="fa fa-fw fa-line-chart" style="color: var(--blue)"></i>
            Biến Động Số Dư
        </div>
        <div class="hero-sub">Lịch Sử thay đổi số dư.</div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <div class="pill"><i class="fa fa-user"></i> <?= htmlspecialchars(getUser($getUser['id'], 'username')) ?></div>
            <div class="pill"><i class="fa fa-list"></i> <?= (int)$sotin1trang ?> dòng / trang</div>
        </div>

        <div class="table-wrap">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width:70px">STT</th>
                        <th>TÀI KHOẢN</th>
                        <th>SỐ TIỀN TRƯỚC</th>
                        <th>SỐ TIỀN THAY ĐỔI</th>
                        <th>SỐ TIỀN HIỆN TẠI</th>
                        <th style="width:170px">THỜI GIAN</th>
                        <th>NỘI DUNG</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($LOCNGUYEN_SIEUTHICODE->get_list(" SELECT * FROM `dongtien` WHERE `user_id`='" . $getUser['id'] . "' ORDER BY id DESC LIMIT $from, $sotin1trang") as $row) {

                    $deltaRaw = (float)$row['sotienthaydoi'];
                    $deltaClass = 'neu';
                    $dotClass = 'neu';
                    $sign = '';
                    if ($deltaRaw > 0) { $deltaClass = 'in'; $dotClass='in'; $sign = '+'; }
                    elseif ($deltaRaw < 0) { $deltaClass = 'out'; $dotClass='out'; $sign = ''; }

                    $username = getUser($row['user_id'], 'username');
                ?>
                    <tr>
                        <td class="mono"><?= ++$i; ?></td>
                        <td>
                            <span class="badge-soft">
                                <span class="dot <?= $dotClass ?>"></span>
                                <?= htmlspecialchars($username) ?>
                            </span>
                        </td>
                        <td class="mono"><?= format_cash($row['sotientruoc']); ?></td>
                        <td class="mono amt <?= $deltaClass ?>"><?= $sign . format_cash($row['sotienthaydoi']); ?></td>
                        <td class="mono"><?= format_cash($row['sotiensau']); ?></td>
                        <td class="mono"><?= htmlspecialchars($row['thoigian']); ?></td>
                        <td class="note" title="<?= htmlspecialchars($row['noidung']); ?>">
                            <?= htmlspecialchars($row['noidung']); ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <div style="padding: 14px 14px 16px;">
            <?php
            $tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `dongtien` WHERE `user_id`='" . $getUser['id'] . "'");
            if ($tong > $sotin1trang) {
                echo '<div style="display:flex;justify-content:center;">' . pagination_account('index.php?action=history_balance&', $from, $tong, $sotin1trang) . '</div>';
            } else {
                echo '<div class="pill" style="justify-content:center;width:100%"><i class="fa fa-info-circle"></i><span>Không có nhiều hơn 1 trang dữ liệu.</span></div>';
            }
            ?>
        </div>
    </div>
</div>