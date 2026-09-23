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

    /* table */
    .u-table-wrap{
        padding: 14px 18px 18px 18px;
    }

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
        font-weight: 600;
        font-size: 13px;
    }

    .u-table tbody tr:hover td{
        background: rgba(99,102,241,.08);
    }

    .u-amount{
        font-weight: 900;
        color: #bbf7d0;
    }

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

    .u-method{
        font-weight: 900;
        color: rgba(255,255,255,.90);
    }

    .u-note{
        color: rgba(255,255,255,.72);
        font-weight: 600;
        max-width: 520px;
        overflow:hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .u-time{
        color: rgba(255,255,255,.72);
        font-weight: 700;
        white-space: nowrap;
    }

    /* responsive table -> card list */
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
        font-weight: 800;
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

    @media (max-width: 992px){
        .u-note{ max-width: 280px; }
    }
    @media (max-width: 768px){
        .u-table{ display:none; }
        .u-mobile-cards{ display:block; }
        .u-table-wrap{ padding: 12px; }
        .u-head{ flex-direction: column; align-items:flex-start; }
        .u-actions{ width:100%; justify-content:flex-start; }
    }

    /* pagination container (giữ pagination_account của bạn) */
    .u-pagination{
        padding: 12px 18px 18px 18px;
        text-align:center;
    }
    .u-pagination *{
        color: rgba(255,255,255,.85) !important;
    }
</style>

<div class="container-fluid u-wrap">

    <div class="row">
        <div class="col-12">
            <div class="card u-card">

                <div class="u-head">
                    <div>
                        <h4 class="u-title">Lịch sử nạp bank</h4>
                        <p class="u-sub">Danh sách giao dịch nạp bank tự động (hiển thị đẹp trên mobile + PC).</p>
                    </div>
                    <div class="u-actions">
                        <span class="u-pill">
                            Hiển thị: <?= (int)$sotin1trang; ?>/trang
                        </span>
                    </div>
                </div>

                <div class="u-table-wrap">

                    <!-- DESKTOP TABLE -->
                    <div class="table-responsive">
                        <table class="u-table">
                            <thead>
                                <tr>
                                    <th style="width:70px;">STT</th>
                                    <th>PHƯƠNG THỨC NẠP</th>
                                    <th>MÃ GIAO DỊCH</th>
                                    <th>SỐ TIỀN</th>
                                    <th>NỘI DUNG NẠP</th>
                                    <th>THỜI GIAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $list = $LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `bank_auto` ORDER BY `id` DESC LIMIT $from,$sotin1trang");
                                if ($list):
                                    foreach ($list as $row): ?>
                                        <tr>
                                            <td style="font-weight:900;color:rgba(255,255,255,.8);"><?= $i++; ?></td>
                                            <td class="u-method"><?= $row['payment_method']; ?></td>
                                            <td><span class="u-code" title="<?= $row['tranId']; ?>"><?= $row['tranId']; ?></span></td>
                                            <td><span class="u-amount"><?= format_cash($row['amount']); ?>đ</span></td>
                                            <td><span class="u-note" title="<?= $row['comment']; ?>"><?= $row['comment']; ?></span></td>
                                            <td class="u-time"><?= $row['create_date']; ?></td>
                                        </tr>
                                    <?php endforeach;
                                else: ?>
                                    <tr>
                                        <td colspan="6" style="padding:18px;color:rgba(255,255,255,.75);text-align:center;">
                                            Chưa có giao dịch nào.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- MOBILE CARDS -->
                    <div class="u-mobile-cards">
                        <?php
                        $i2 = 1;
                        if ($list):
                            foreach ($list as $row): ?>
                                <div class="u-item">
                                    <div class="top">
                                        <div>
                                            <div style="font-weight:900;color:rgba(255,255,255,.92);">
                                                #<?= $i2++; ?> • <span style="color:#c7d2fe;"><?= $row['payment_method']; ?></span>
                                            </div>
                                            <div style="margin-top:6px;">
                                                <span class="u-code" title="<?= $row['tranId']; ?>"><?= $row['tranId']; ?></span>
                                            </div>
                                        </div>
                                        <div style="text-align:right;">
                                            <div class="u-amount" style="font-size:16px;"><?= format_cash($row['amount']); ?>đ</div>
                                            <div class="u-time" style="margin-top:4px;"><?= $row['create_date']; ?></div>
                                        </div>
                                    </div>

                                    <div class="line">
                                        <div class="k">Nội dung</div>
                                        <div class="v"><?= $row['comment']; ?></div>
                                    </div>
                                </div>
                            <?php endforeach;
                        else: ?>
                            <div class="u-item" style="text-align:center;color:rgba(255,255,255,.75);">
                                Chưa có giao dịch nào.
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <?php
                $tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `bank_auto`");
                if ($tong > $sotin1trang) {
                    echo '<div class="u-pagination">' . pagination_account('index.php?action=history_bank&', $from, $tong, $sotin1trang) . '</div>';
                }
                ?>

            </div>
        </div>
    </div>

</div>