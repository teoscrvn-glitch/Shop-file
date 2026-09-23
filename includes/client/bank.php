<?php
CheckLogin();

$sotin1trang = 10;
$page = isset($_GET['page']) ? xss(intval($_GET['page'])) : 1;
$page = max(1, (int)$page);
$from = ($page - 1) * $sotin1trang;
?>

<style>
    :root{
        --bg: rgba(0,0,0,.18);
        --card: rgba(255,255,255,.06);
        --card2: rgba(255,255,255,.08);
        --border: rgba(255,255,255,.12);
        --text: rgba(255,255,255,.92);
        --muted: rgba(255,255,255,.72);
        --shadow: 0 18px 60px rgba(0,0,0,.35);
        --radius: 18px;
        --primary:#3b82f6;
        --primary2:#2563eb;
        --good:#22c55e;
        --danger:#ef4444;
    }

    .bank-wrap{ margin-top:80px; }

    .bank-hero{
        border-radius: 22px;
        border: 1px solid var(--border);
        overflow:hidden;
        box-shadow: var(--shadow);
        padding: 16px 16px;
        margin-bottom: 18px;
        background:
            radial-gradient(900px 320px at 15% 0%, rgba(59,130,246,.28), transparent 60%),
            radial-gradient(900px 320px at 85% 10%, rgba(34,197,94,.14), transparent 55%),
            linear-gradient(180deg, rgba(10,16,30,.88), rgba(7,12,22,.88));
    }
    .bank-hero h3{
        margin:0;
        font-weight: 1000;
        letter-spacing:.25px;
        color: var(--text);
        font-size: clamp(18px, 2.1vw, 26px);
    }
    .bank-hero p{
        margin:8px 0 0 0;
        color: var(--muted);
        line-height:1.4;
        font-size: 13.5px;
    }

    /* cards */
    .list-ac{ display:flex; flex-wrap:wrap; margin:0; padding:0; list-style:none; }
    .list-ac>li{ list-style:none; }

    .bank-card{
        height:100%;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        background: linear-gradient(180deg, var(--card), rgba(255,255,255,.04));
        overflow:hidden;
        box-shadow: 0 18px 50px rgba(0,0,0,.22);
        transition: .18s ease;
        display:flex;
        flex-direction:column;
    }
    .bank-card:hover{
        transform: translateY(-3px);
        border-color: rgba(59,130,246,.35);
        box-shadow: 0 28px 70px rgba(0,0,0,.32);
    }

    .bank-thumb{
        position:relative;
        width:100%;
        padding-top: 58%;
        background: rgba(255,255,255,.03);
        overflow:hidden;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }
    .bank-thumb img{
        position:absolute;
        inset:0;
        width:100%;
        height:100%;
        object-fit: contain;
        padding: 14px;
        display:block;
    }
    .bank-body{
        padding: 12px 12px 12px 12px;
        flex:1 1 auto;
        display:flex;
        flex-direction:column;
        gap:10px;
        color: var(--text);
    }

    .bank-row{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:10px;
        padding: 10px 10px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,.10);
        background: rgba(0,0,0,.16);
    }
    .bank-row .lbl{
        font-size: 12.5px;
        color: rgba(255,255,255,.72);
        font-weight: 900;
        white-space: nowrap;
    }
    .bank-row .val{
        font-size: 13px;
        font-weight: 1000;
        color: rgba(255,255,255,.92);
        text-align:right;
        overflow:hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 70%;
    }
    .val.stk{ color: var(--good); }
    .val.nd{ color: #ff5d5d; }

    .btn-copy{
        border-radius: 12px !important;
        border: 1px solid rgba(255,255,255,.14) !important;
        background: rgba(59,130,246,.16) !important;
        color: rgba(255,255,255,.92) !important;
        font-weight: 1000 !important;
        padding: 8px 10px !important;
        display:inline-flex;
        align-items:center;
        gap:8px;
        white-space:nowrap;
    }
    .btn-copy:hover{ filter: brightness(1.06); transform: translateY(-1px); }

    .bank-foot{
        padding: 0 12px 12px 12px;
    }
    .btn-auto{
        width:100%;
        border-radius: 14px;
        padding: 11px 12px;
        font-weight: 1000;
        letter-spacing: .15px;
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.06);
        color: rgba(255,255,255,.92);
        cursor: default;
    }

    /* =========================
       ✅ HISTORY (FIX TRẮNG + ĐẸP)
       ========================= */
    .history-card{
        margin-top: 18px;
        border-radius: 22px;
        border: 1px solid var(--border);
        overflow:hidden;
        box-shadow: var(--shadow);
        background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));
    }
    .history-head{
        padding: 14px 16px;
        border-bottom: 1px solid rgba(255,255,255,.10);
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:10px;
        flex-wrap:wrap;
        background:
            radial-gradient(900px 260px at 15% 0%, rgba(245,158,11,.14), transparent 60%),
            radial-gradient(900px 260px at 85% 10%, rgba(59,130,246,.18), transparent 55%);
    }
    .history-head h4{
        margin:0;
        font-weight: 1000;
        color: var(--text);
        letter-spacing:.2px;
        font-size: 16px;
    }
    .history-head .small-note{
        color: var(--muted);
        font-size: 12.5px;
        font-weight: 800;
    }

    .table-modern{
        margin:0;
        color: rgba(255,255,255,.92) !important;
        background: rgba(0,0,0,.12) !important;
        border-color: rgba(255,255,255,.12) !important;
        border-radius: 18px;
        overflow:hidden;
    }

    /* ✅ FIX TRẮNG DO BOOTSTRAP: ép toàn bộ nền table về tối */
    .table-modern,
    .table-modern *{
        color: rgba(255,255,255,.92) !important;
    }
    .table-modern thead th{
        background: rgba(255,255,255,.06) !important;
        border-bottom: 1px solid rgba(255,255,255,.12) !important;
        border-color: rgba(255,255,255,.12) !important;
        white-space: nowrap;
        font-size: 12.5px;
        padding: 14px 12px !important;
        font-weight: 1000 !important;
    }
    .table-modern tbody td{
        background: transparent !important; /* ✅ quan trọng: không cho td trắng */
        border-top: 1px solid rgba(255,255,255,.06) !important;
        border-color: rgba(255,255,255,.10) !important;
        padding: 13px 12px !important;
        vertical-align: middle !important;
        font-size: 13px;
    }

    /* ✅ override table-striped */
    .table-modern.table-striped tbody tr{
        background: rgba(0,0,0,.12) !important;
    }
    .table-modern.table-striped tbody tr:nth-of-type(odd){
        background: rgba(255,255,255,.02) !important;
    }
    .table-modern.table-striped tbody tr:nth-of-type(even){
        background: rgba(0,0,0,.14) !important;
    }
    .table-modern tbody tr:hover{
        background: rgba(59,130,246,.10) !important;
    }

    /* ✅ override table-bordered lines */
    .table-modern.table-bordered,
    .table-modern.table-bordered th,
    .table-modern.table-bordered td{
        border-color: rgba(255,255,255,.12) !important;
    }

    .amount{
        font-weight: 1000;
        color: var(--good) !important;
        white-space: nowrap;
    }

    @media (max-width: 576px){
        .bank-wrap{ margin-top:60px; }
        .bank-thumb{ padding-top: 52%; }
        .bank-row{ flex-direction: column; align-items:flex-start; }
        .bank-row .val{ max-width: 100%; text-align:left; white-space: normal; }
        .btn-copy{ width:100%; justify-content:center; }

        .table-modern thead th{ font-size: 11.5px; }
        .table-modern tbody td{ font-size: 12.5px; }
    }
</style>

<div class="container bank-wrap">

    <div class="bank-hero">
        <h3>Nạp tiền tự động</h3>
        <p>Chọn ngân hàng bên dưới, chuyển khoản đúng <b>Nội dung nạp</b> để hệ thống tự cộng tiền nhanh.</p>
    </div>

    <div class="box-home all">
        <div class="content homepage">
            <div class="menu_top">
                <div class="middle home-product-tabbed">
                    <div class="tabbed-container all">
                        <div class="">
                            <div class="box-home mt20 all">

                                <ul class="list-ac all" id="listAccAjax">
                                    <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `bank`") as $row) : ?>
                                        <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;margin-bottom:18px;">
                                            <div class="bank-card">

                                                <div class="bank-thumb">
                                                    <img src="<?= $row['logo'] ?>" alt="<?= $row['name'] ?>"
                                                         onerror="this.src='https://via.placeholder.com/400x250?text=Bank'">
                                                </div>

                                                <div class="bank-body">

                                                    <div class="bank-row">
                                                        <div class="lbl">Số tài khoản</div>
                                                        <div class="val stk">
                                                            <span id="copySTK<?= $row['id'] ?>"><?= $row['stk'] ?></span>
                                                        </div>
                                                    </div>

                                                    <button class="copy btn btn-copy"
                                                            data-clipboard-target="#copySTK<?= $row['id'] ?>"
                                                            type="button">
                                                        <i class="fa fa-copy"></i> Copy STK
                                                    </button>

                                                    <div class="bank-row">
                                                        <div class="lbl">Chủ tài khoản</div>
                                                        <div class="val"><?= $row['bank_name'] ?></div>
                                                    </div>

                                                    <div class="bank-row">
                                                        <div class="lbl">Ngân hàng</div>
                                                        <div class="val"><?= $row['name'] ?></div>
                                                    </div>

                                                    <div class="bank-row">
                                                        <div class="lbl">Nội dung nạp</div>
                                                        <div class="val nd">
                                                            <span id="copyNoiDung<?= $row['id'] ?>"><?= $LOCNGUYEN_SIEUTHICODE->site('noidung_naptien'), $getUser['id'] ?></span>
                                                        </div>
                                                    </div>

                                                    <button class="copy btn btn-copy"
                                                            data-clipboard-target="#copyNoiDung<?= $row['id'] ?>"
                                                            type="button">
                                                        <i class="fa fa-copy"></i> Copy nội dung
                                                    </button>

                                                </div>

                                                <div class="bank-foot">
                                                    <button class="btn-auto" rel="nofollow" type="button">
                                                        <i class="fa fa-spinner fa-spin"></i> Xử lý giao dịch tự động
                                                    </button>
                                                </div>

                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== LỊCH SỬ NẠP ===== -->
        <div class="history-card">
            <div class="history-head">
                <div>
                    <h4>Lịch sử nạp tiền</h4>
                    <div class="small-note">Hiển thị các giao dịch của tài khoản bạn</div>
                </div>
                <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <span style="display:inline-flex;gap:8px;align-items:center;padding:8px 12px;border-radius:999px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.12);color:rgba(255,255,255,.9);font-weight:1000;font-size:12px;">
                        <i class="fa fa-list"></i>
                        <?php
                        $tmpCount = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `bank_auto` WHERE `user_id`='" . $getUser['id'] . "'");
                        echo (int)$tmpCount;
                        ?> giao dịch
                    </span>
                    <span style="display:inline-flex;gap:8px;align-items:center;padding:8px 12px;border-radius:999px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.12);color:rgba(255,255,255,.9);font-weight:1000;font-size:12px;">
                        <i class="fa fa-user"></i> ID: <?= (int)$getUser['id'] ?>
                    </span>
                </div>
            </div>

            <div class="table-popcart all mb20 mt10" style="padding: 12px;">
                <div class="table-responsive">
                    <!-- giữ nguyên class table-striped/table-bordered, đã override để không bị trắng -->
                    <table class="table table-modern table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>STT</th>
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
                            $hasRow = false;
                            foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `bank_auto` WHERE `user_id`='" . $getUser['id'] . "' ORDER BY `id` DESC") as $row) {
                                $hasRow = true;
                            ?>
                                <tr>
                                    <td style="font-weight:1000; text-align:center;"><?= $i++ ?></td>
                                    <td style="font-weight:1000;"><?= $row['payment_method'] ?></td>
                                    <td style="font-weight:1000;"><?= $row['tranId'] ?></td>
                                    <td><span class="amount"><?= format_cash($row['amount']) ?>đ</span></td>
                                    <td style="font-weight:900;"><?= $row['comment'] ?></td>
                                    <td style="white-space:nowrap; font-weight:900;"><i class="fa fa-clock-o"></i> <?= $row['create_date'] ?></td>
                                </tr>
                            <?php } ?>

                            <?php if (!$hasRow) : ?>
                                <tr>
                                    <td colspan="6" style="padding:18px;">
                                        <div style="padding:18px;border:1px dashed rgba(255,255,255,.16);border-radius:18px;background:rgba(0,0,0,.12);text-align:center;">
                                            <i class="fa fa-inbox" style="font-size:22px; opacity:.9;"></i>
                                            <div style="font-weight:1000; margin-top:8px;">Chưa có giao dịch nào</div>
                                            <div style="color:rgba(255,255,255,.70); font-weight:800; font-size:12.5px; margin-top:4px;">
                                                Khi bạn nạp tiền thành công, lịch sử sẽ hiển thị tại đây.
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php
                $tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `bank_auto` WHERE `user_id`='" . $getUser['id'] . "'");
                if ($tong > $sotin1trang) {
                    echo '<center style="padding-top:10px;">' . pagination_account('index.php?action=bank&', $from, $tong, $sotin1trang) . '</center>';
                }
                ?>
            </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script>
    // copy clipboard
    var clipboard = new ClipboardJS(".copy");
    clipboard.on('success', function(e) {
        if (typeof cuteToast === "function") {
            cuteToast({ type: "success", message: "Đã copy!", timer: 1200 });
        }
        e.clearSelection();
    });
</script>

<script src="dist/js/sieuthicode.js?v=<?=time()?>"></script>