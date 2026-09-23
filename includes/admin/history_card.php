<?php
CheckLogin();
CheckAdmin();

$sotin1trang = 10;
$page = isset($_GET['page']) ? xss((int)$_GET['page']) : 1;
if ($page <= 0) $page = 1;
$from = ($page - 1) * $sotin1trang;
?>

<style>
    :root{
        --bg1:#0b1220;
        --card:#0f172a;
        --card2:#0b142c;
        --border: rgba(255,255,255,.10);
        --muted: rgba(255,255,255,.70);
        --text: rgba(255,255,255,.92);
        --focus: rgba(99,102,241,.45);
        --primary: #6366f1;
        --primary2:#4f46e5;
        --shadow: 0 18px 60px rgba(0,0,0,.35);
        --radius: 16px;
    }

    .u-wrap{ padding: 14px 10px; }

    .u-card{
        background: linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .u-head{
        display:flex;
        gap:12px;
        align-items:center;
        justify-content:space-between;
        padding: 16px 18px;
        border-bottom: 1px solid var(--border);
        background: radial-gradient(900px 200px at 10% 0%, rgba(99,102,241,.30), transparent 60%),
                    radial-gradient(900px 240px at 90% 0%, rgba(34,197,94,.18), transparent 55%);
    }
    .u-title{
        margin:0;
        color:var(--text);
        font-weight:900;
        letter-spacing:.2px;
        font-size: 18px;
        line-height: 1.2;
    }
    .u-sub{
        margin:4px 0 0 0;
        color: var(--muted);
        font-size: 13px;
    }
    .u-actions{
        display:flex;
        gap:10px;
        flex-wrap:wrap;
        align-items:center;
        justify-content:flex-end;
    }
    .u-pill{
        border: 1px solid rgba(255,255,255,.14);
        background: rgba(15,23,42,.55);
        color: rgba(255,255,255,.88);
        border-radius: 999px;
        padding: 9px 12px;
        font-weight: 800;
        font-size: 12px;
        white-space: nowrap;
    }

    .u-table-wrap{ padding: 14px 18px 18px 18px; }

    .u-table{
        width:100%;
        margin:0;
        border-collapse: separate;
        border-spacing: 0;
        overflow:hidden;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,.10);
        background: rgba(2,6,23,.22);
    }
    .u-table thead th{
        background: rgba(15,23,42,.75);
        color: rgba(255,255,255,.88);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .25px;
        text-transform: uppercase;
        padding: 12px 12px;
        border-bottom: 1px solid rgba(255,255,255,.10);
        white-space: nowrap;
    }
    .u-table tbody td{
        color: rgba(255,255,255,.86);
        padding: 12px 12px;
        border-bottom: 1px solid rgba(255,255,255,.08);
        vertical-align: middle;
        font-weight: 700;
        font-size: 13px;
    }
    .u-table tbody tr:hover td{ background: rgba(99,102,241,.08); }

    .u-code{
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-size: 12px;
        font-weight: 900;
        color: #c7d2fe;
        background: rgba(99,102,241,.12);
        border: 1px solid rgba(99,102,241,.25);
        padding: 6px 10px;
        border-radius: 999px;
        display:inline-block;
        max-width: 100%;
        overflow:hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .u-money{
        font-weight: 900;
        color: #bbf7d0;
        white-space: nowrap;
    }
    .u-money.dim{
        color: rgba(255,255,255,.78);
        font-weight: 900;
    }
    .u-telco{
        font-weight: 900;
        color: rgba(255,255,255,.92);
        white-space: nowrap;
    }
    .u-time{
        color: rgba(255,255,255,.72);
        font-weight: 800;
        white-space: nowrap;
    }

    /* status pill (bọc lại status_card output) */
    .u-status{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding: 6px 10px;
        border-radius: 999px;
        border: 1px solid rgba(255,255,255,.14);
        background: rgba(15,23,42,.55);
        font-weight: 900;
        font-size: 12px;
        color: rgba(255,255,255,.88);
        white-space: nowrap;
    }
    .u-status .dot{
        width:8px;height:8px;border-radius:50%;
        background: rgba(255,255,255,.55);
        box-shadow: 0 0 0 4px rgba(255,255,255,.08);
    }
    /* tự tô màu theo status text trả về (không đụng logic status_card) */
    .u-status.ok{ border-color: rgba(34,197,94,.30); background: rgba(34,197,94,.10); color:#bbf7d0; }
    .u-status.ok .dot{ background:#22c55e; box-shadow:0 0 0 4px rgba(34,197,94,.14); }
    .u-status.bad{ border-color: rgba(239,68,68,.30); background: rgba(239,68,68,.10); color:#fecaca; }
    .u-status.bad .dot{ background:#ef4444; box-shadow:0 0 0 4px rgba(239,68,68,.14); }
    .u-status.wait{ border-color: rgba(245,158,11,.28); background: rgba(245,158,11,.10); color:#fde68a; }
    .u-status.wait .dot{ background:#f59e0b; box-shadow:0 0 0 4px rgba(245,158,11,.14); }

    /* mobile cards */
    .u-mobile-cards{ display:none; }
    .u-item{
        border: 1px solid rgba(255,255,255,.10);
        background: rgba(2,6,23,.22);
        border-radius: 14px;
        padding: 12px;
        margin-bottom: 10px;
    }
    .u-item .top{
        display:flex;
        align-items:flex-start;
        justify-content:space-between;
        gap:10px;
        flex-wrap:wrap;
        margin-bottom: 8px;
    }
    .u-item .line{
        display:flex;
        justify-content:space-between;
        gap:10px;
        padding: 6px 0;
        border-top: 1px dashed rgba(255,255,255,.10);
    }
    .u-item .k{
        color: rgba(255,255,255,.65);
        font-weight: 900;
        font-size: 12px;
        white-space: nowrap;
    }
    .u-item .v{
        color: rgba(255,255,255,.90);
        font-weight: 800;
        font-size: 13px;
        text-align:right;
        word-break: break-word;
    }

    @media (max-width: 768px){
        .u-table{ display:none; }
        .u-mobile-cards{ display:block; }
        .u-table-wrap{ padding: 12px; }
        .u-head{ flex-direction: column; align-items:flex-start; }
        .u-actions{ width:100%; justify-content:flex-start; }
    }

    .u-pagination{
        padding: 12px 18px 18px 18px;
        text-align:center;
    }
    .u-pagination *{ color: rgba(255,255,255,.85) !important; }
</style>

<div class="container-fluid u-wrap">
    <div class="row">
        <div class="col-12">
            <div class="card u-card">

                <div class="u-head">
                    <div>
                        <h4 class="u-title">Lịch sử nạp thẻ</h4>
                        <p class="u-sub">Hiển thị dạng bảng trên PC và dạng thẻ trên mobile — chữ rõ, gọn, đẹp.</p>
                    </div>
                    <div class="u-actions">
                        <span class="u-pill">Hiển thị: <?= (int)$sotin1trang; ?>/trang</span>
                    </div>
                </div>

                <div class="u-table-wrap">
                    <?php
                    $list = $LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `cards` ORDER BY `id` DESC LIMIT $from,$sotin1trang");
                    ?>

                    <!-- DESKTOP TABLE -->
                    <div class="table-responsive">
                        <table class="u-table">
                            <thead>
                                <tr>
                                    <th style="width:70px;">STT</th>
                                    <th>LOẠI THẺ</th>
                                    <th>SERIAL</th>
                                    <th>MÃ THẺ</th>
                                    <th>MỆNH GIÁ</th>
                                    <th>THỰC NHẬN</th>
                                    <th>THỜI GIAN</th>
                                    <th>TRẠNG THÁI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($list):
                                    $i = 1;
                                    foreach ($list as $row):
                                        $status_html = status_card($row['status']);
                                        // auto detect class theo chữ (không sửa logic status_card)
                                        $plain = mb_strtolower(strip_tags($status_html), 'UTF-8');
                                        $cls = 'wait';
                                        if (strpos($plain, 'thành công') !== false || strpos($plain, 'success') !== false) $cls = 'ok';
                                        if (strpos($plain, 'thất bại') !== false || strpos($plain, 'sai') !== false || strpos($plain, 'error') !== false) $cls = 'bad';
                                ?>
                                        <tr>
                                            <td style="font-weight:900;color:rgba(255,255,255,.8);"><?= $i++; ?></td>
                                            <td class="u-telco"><?= $row['telco']; ?></td>
                                            <td><span class="u-code" title="<?= $row['serial']; ?>"><?= $row['serial']; ?></span></td>
                                            <td><span class="u-code" title="<?= $row['pin']; ?>"><?= $row['pin']; ?></span></td>
                                            <td class="u-money dim"><?= format_cash($row['amount']); ?>đ</td>
                                            <td class="u-money"><?= format_cash($row['price']); ?>đ</td>
                                            <td class="u-time"><?= $row['create_date']; ?></td>
                                            <td>
                                                <span class="u-status <?= $cls; ?>">
                                                    <span class="dot"></span>
                                                    <?= $status_html; ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                else: ?>
                                    <tr>
                                        <td colspan="8" style="padding:18px;color:rgba(255,255,255,.75);text-align:center;">
                                            Chưa có lịch sử nạp thẻ.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- MOBILE CARDS -->
                    <div class="u-mobile-cards">
                        <?php
                        if ($list):
                            $i2 = 1;
                            foreach ($list as $row):
                                $status_html = status_card($row['status']);
                                $plain = mb_strtolower(strip_tags($status_html), 'UTF-8');
                                $cls = 'wait';
                                if (strpos($plain, 'thành công') !== false || strpos($plain, 'success') !== false) $cls = 'ok';
                                if (strpos($plain, 'thất bại') !== false || strpos($plain, 'sai') !== false || strpos($plain, 'error') !== false) $cls = 'bad';
                        ?>
                                <div class="u-item">
                                    <div class="top">
                                        <div>
                                            <div style="font-weight:900;color:rgba(255,255,255,.92);">
                                                #<?= $i2++; ?> • <span style="color:#c7d2fe;"><?= $row['telco']; ?></span>
                                            </div>
                                            <div style="margin-top:6px;display:flex;gap:8px;flex-wrap:wrap;">
                                                <span class="u-code" title="<?= $row['serial']; ?>">SER: <?= $row['serial']; ?></span>
                                                <span class="u-code" title="<?= $row['pin']; ?>">PIN: <?= $row['pin']; ?></span>
                                            </div>
                                        </div>
                                        <div style="text-align:right;">
                                            <div class="u-money" style="font-size:16px;"><?= format_cash($row['price']); ?>đ</div>
                                            <div class="u-time" style="margin-top:4px;"><?= $row['create_date']; ?></div>
                                        </div>
                                    </div>

                                    <div class="line">
                                        <div class="k">Mệnh giá</div>
                                        <div class="v"><?= format_cash($row['amount']); ?>đ</div>
                                    </div>
                                    <div class="line">
                                        <div class="k">Thực nhận</div>
                                        <div class="v"><?= format_cash($row['price']); ?>đ</div>
                                    </div>
                                    <div class="line">
                                        <div class="k">Trạng thái</div>
                                        <div class="v">
                                            <span class="u-status <?= $cls; ?>">
                                                <span class="dot"></span>
                                                <?= $status_html; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;
                        else: ?>
                            <div class="u-item" style="text-align:center;color:rgba(255,255,255,.75);">
                                Chưa có lịch sử nạp thẻ.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                $tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `cards`");
                if ($tong > $sotin1trang) {
                    echo '<div class="u-pagination">' . pagination_account('index.php?action=history_card&', $from, $tong, $sotin1trang) . '</div>';
                }
                ?>

            </div>
        </div>
    </div>
</div>