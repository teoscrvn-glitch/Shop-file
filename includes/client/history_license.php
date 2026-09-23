<?php
CheckLogin();
$sotin1trang = 10;
if (isset($_GET['page'])) {
    $page = xss(intval($_GET['page']));
} else {
    $page = 1;
}
$page = max(1, (int)$page);
$from = ($page - 1) * $sotin1trang;
?>

<style>
:root{
    --bg:#000;
    --bg2:#050505;
    --card: rgba(255,255,255,.06);
    --card2: rgba(255,255,255,.04);
    --border: rgba(255,255,255,.12);
    --border2: rgba(255,255,255,.18);
    --text: rgba(255,255,255,.92);
    --muted: rgba(255,255,255,.65);
    --shadow: 0 22px 80px rgba(0,0,0,.75);
    --radius: 20px;
    --radius2: 14px;
    --primary:#3b82f6;
    --primary2:#2563eb;
    --good:#22c55e;
    --warn:#f59e0b;
    --danger:#ef4444;
    --focus: 0 0 0 4px rgba(59,130,246,.22);
}

/* ===== FIX: HEADER/TOPBAR NỀN ĐEN - CHỮ TRẮNG ===== */
header, .header, .topbar, .navbar, .nav-bar, .menu, .menu_top, .main-header,
.navbar-header, .navbar-nav, .header-area, .header-wrap,
.sidebar, .sidebar-nav, .left-sidebar, .navbar-collapse{
    background: #070707 !important;
    color: var(--text) !important;
    border-color: rgba(255,255,255,.10) !important;
}
header a, .header a, .topbar a, .navbar a, .menu a, .menu_top a, .main-header a,
.navbar-nav a, .navbar-brand, .nav-link, .dropdown-toggle{
    color: rgba(255,255,255,.92) !important;
}
header a:hover, .navbar a:hover, .menu a:hover, .menu_top a:hover,
.nav-link:hover, .dropdown-toggle:hover{
    color: #fff !important;
    filter: brightness(1.06);
}
.dropdown-menu{
    background: #0b0b0b !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    box-shadow: 0 22px 70px rgba(0,0,0,.55) !important;
}
.dropdown-menu .dropdown-item{ color: rgba(255,255,255,.88) !important; }
.dropdown-menu .dropdown-item:hover{
    background: rgba(255,255,255,.06) !important;
    color:#fff !important;
}

/* ===== wrapper ===== */
.history-wrap{
    margin-top: 80px;
    padding-bottom: 10px;
}

/* ===== hero ===== */
.history-hero{
    border-radius: 22px;
    border: 1px solid rgba(255,255,255,.08);
    background:
        radial-gradient(1200px 420px at 15% -10%, rgba(59,130,246,.18), transparent 55%),
        radial-gradient(900px 380px at 90% 0%, rgba(34,197,94,.10), transparent 55%),
        linear-gradient(180deg, var(--bg), var(--bg2));
    box-shadow: var(--shadow);
    overflow: hidden;
    position: relative;
    margin-bottom: 14px;
}
.history-hero::before{
    content:"";
    position:absolute; inset:0;
    background: radial-gradient(circle at 1px 1px, rgba(255,255,255,.07) 1px, transparent 0);
    background-size: 14px 14px;
    opacity: .35;
    pointer-events:none;
}
.history-hero__inner{
    position: relative;
    padding: 16px 16px 14px;
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap: 12px;
    flex-wrap: wrap;
}
.history-title{
    margin: 0;
    font-size: 20px;
    font-weight: 900;
    letter-spacing: .2px;
    color: var(--text);
    display:flex;
    align-items:center;
    gap: 10px;
    flex-wrap: wrap;
}
.history-title small{
    font-size: 12px;
    font-weight: 900;
    color: rgba(255,255,255,.78);
    padding: 6px 10px;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,.12);
    background: rgba(0,0,0,.25);
}
.history-sub{
    margin: 6px 0 0;
    font-size: 13px;
    line-height: 1.5;
    color: var(--muted);
}
.history-link a{
    display:inline-flex;
    align-items:center;
    gap: 8px;
    padding: 9px 12px;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,.12);
    background: rgba(0,0,0,.25);
    color: rgba(255,255,255,.9);
    font-weight: 900;
    font-size: 12px;
    text-decoration:none;
}
.history-link a:hover{
    border-color: rgba(59,130,246,.45);
    transform: translateY(-1px);
}

/* ===== card table ===== */
.history-card{
    border-radius: 22px;
    border: 1px solid var(--border);
    background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    box-shadow: var(--shadow);
    overflow: hidden;
}
.history-card__body{ padding: 14px; }
@media (max-width: 575px){
    .history-hero__inner{ padding: 14px; }
    .history-card__body{ padding: 12px; }
}

/* ===== table responsive ===== */
.table-wrap{
    width: 100%;
    overflow: auto;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,.10);
    background: rgba(0,0,0,.25);
}

/* ===== table base ===== */
.history-table{
    margin: 0 !important;
    min-width: 980px;
    color: var(--text) !important;
    background: transparent !important;
}
.history-table thead th{
    position: sticky;
    top: 0;
    z-index: 2;
    background: rgba(0,0,0,.85) !important;
    color: rgba(255,255,255,.92) !important;
    border-color: rgba(255,255,255,.10) !important;
    font-weight: 900;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .4px;
    white-space: nowrap;
}

/* ===== FIX 100% NỀN TRẮNG TRONG BODY ===== */
.history-table,
.history-table tbody,
.history-table tbody tr,
.history-table tbody td{
    background: transparent !important;
}
.history-table td{
    border-color: rgba(255,255,255,.08) !important;
    vertical-align: middle !important;
    font-size: 13px;
    background: rgba(0,0,0,.32) !important;
    color: rgba(255,255,255,.92) !important;
}
/* đè stripe bootstrap */
.table-striped.history-table tbody tr:nth-of-type(odd) td,
.table-striped.history-table tbody tr:nth-of-type(even) td{
    background: rgba(0,0,0,.32) !important;
}
/* tránh theme set background-color trắng */
table.table.history-table td,
table.table.history-table th{
    background-color: transparent !important;
}
.table-striped.history-table tbody tr{
    background-color: transparent !important;
}

/* hover */
.history-table tbody tr:hover td{
    background: rgba(59,130,246,.12) !important;
}

/* license cell */
.license-cell{
    display:flex;
    align-items:center;
    gap: 10px;
    min-width: 340px;
}
.license-key{
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    font-size: 12px;
    padding: 6px 10px;
    border-radius: 12px;
    border: 1px dashed rgba(255,255,255,.18);
    background: rgba(0,0,0,.25);
    color: rgba(255,255,255,.92);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 420px;
}
@media (max-width: 575px){
    .license-key{ max-width: 240px; }
}

/* copy button */
.copy.btn{
    border-radius: 12px !important;
    padding: 8px 10px !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    background: linear-gradient(180deg, var(--primary), var(--primary2)) !important;
    color: #fff !important;
    font-weight: 900 !important;
    box-shadow: 0 14px 40px rgba(37,99,235,.18);
}
.copy.btn:hover{ filter: brightness(1.07); transform: translateY(-1px); }

/* colored values */
.text-danger{ color: rgba(239,68,68,.95) !important; font-weight: 900; }
.text-success{ color: rgba(34,197,94,.95) !important; font-weight: 900; }

/* footer note */
.history-note{
    margin-top: 14px;
    padding: 14px 12px;
    border-radius: 18px;
    border: 1px solid rgba(255,255,255,.10);
    background: rgba(0,0,0,.28);
    color: rgba(255,255,255,.92);
    text-align:center;
    font-weight: 900;
    letter-spacing: .2px;
}
.history-note span{ color: rgba(34,197,94,.95); }

/* pagination center */
.history-pagination{ margin-top: 12px; text-align: center; }
</style>

<div class="container history-wrap">
    <div class="history-hero">
        <div class="history-hero__inner">
            <div>
                <h3 class="history-title">
                    Lịch sử mua
                    <small>History License</small>
                </h3>
                <div class="history-sub">Xem lại các license đã mua, có thể copy nhanh chỉ với 1 click.</div>
            </div>
            <div class="history-link">
                <a href="<?=$LOCNGUYEN_SIEUTHICODE->site('link_facebook')?>" target="_blank" rel="noopener">
                    Báo lỗi key tại đây
                </a>
            </div>
        </div>
    </div>

    <div class="history-card">
        <div class="history-card__body">

            <div class="table-wrap">
                <table class="table table-bordered table-striped history-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>LICENSE</th>
                            <th>LOẠI HACK</th>
                            <th>GÓI</th>
                            <th>THANH TOÁN</th>
                            <th>THỜI GIAN MUA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($LOCNGUYEN_SIEUTHICODE->get_list(" SELECT * FROM `tbl_history_hack` WHERE `user_id`='" . $getUser['id'] . "' ORDER BY id DESC LIMIT $from, $sotin1trang") as $row) {
                        ?>
                            <tr>
                                <td><?= ++$i; ?></td>

                                <td>
                                    <div class="license-cell">
                                        <span class="license-key" id="copyKey<?= $row['id'] ?>"><?= $row['license']; ?></span>
                                        <button onclick="copy()" data-clipboard-target="#copyKey<?= $row['id'] ?>" class="copy btn btn-create btn-sm" type="button" title="Copy license">
                                            <i class="fa fa-copy"></i>
                                        </button>
                                    </div>
                                </td>

                                <td><?= $row['groups_name']; ?></td>
                                <td class="text-danger"><?= format_cash($row['thoigian']); ?> Giờ</td>
                                <td class="text-success"><?= format_cash($row['price']); ?>đ</td>
                                <td><?= $row['create_date']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php
            $tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `tbl_history_hack` WHERE `user_id`='" . $getUser['id'] . "'");
            if ($tong > $sotin1trang) {
                echo '<div class="history-pagination">' . pagination_account('index.php?action=history_license&', $from, $tong, $sotin1trang) . '</div>';
            }
            ?>

            <div class="history-note">
                <span>❤</span> CÓ NGƯỜI THUÊ TOOL GIỚI THIỆU ĐẾN WEB MÌNH NHÉ, CẢM ƠN BẠN ĐÃ ỦNG HỘ !
            </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script>
    new ClipboardJS(".copy");
</script>
<script src="dist/js/sieuthicode.js?v=<?=time()?>"></script>