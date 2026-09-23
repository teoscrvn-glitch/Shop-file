<?php
CheckLogin();

// =====================
// LOAD CATEGORY THEO SLUG
// =====================
if (isset($_GET['type'])) {
    $cate = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_category_hack` WHERE `slug` = '" . xss($_GET['type']) . "' ");
    if (!$cate) {
        die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
}

// =====================
// PAGINATION
// =====================
$sotin1trang = 10;
$page = isset($_GET['page']) ? xss((int)$_GET['page']) : 1;
$page = max(1, $page);
$from = ($page - 1) * $sotin1trang;

// (UI) đếm tổng số group để show badge + sau này làm pagination đẹp
$total_groups_row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(*) AS total FROM `tbl_groups_hack` WHERE `cate_id`='" . $cate['id'] . "' AND `status`=1 ");
$total_groups = isset($total_groups_row['total']) ? (int)$total_groups_row['total'] : 0;
?>

<style>
/* ===== GLOBAL DARK OVERRIDE (chống chỗ trắng/chỗ đen) ===== */
:root{
    --bg1:#070b16;
    --bg2:#0b1530;
    --card: rgba(255,255,255,.06);
    --card2: rgba(255,255,255,.08);
    --border: rgba(255,255,255,.12);
    --text: rgba(255,255,255,.92);
    --muted: rgba(255,255,255,.72);
    --shadow: 0 18px 60px rgba(0,0,0,.45);
    --radius: 18px;
    --primary: #3b82f6;
    --primary2:#2563eb;
    --good:#22c55e;
    --warn:#f59e0b;
    --danger:#ef4444;
}

html, body{
    background:
        radial-gradient(900px 380px at 10% -10%, rgba(59,130,246,.26), transparent 55%),
        radial-gradient(820px 360px at 95% 0%, rgba(34,197,94,.18), transparent 60%),
        linear-gradient(180deg, #060a13, #0b1220 55%, #070a12) !important;
    color: var(--text) !important;
}

.container, .box-home, .box-cate, .table-popcart, .content, .content-wrapper,
.block-content, .tabbed-container, .homepage, .menu_top, .middle, .all{
    background: transparent !important;
    color: var(--text) !important;
}

a{ color: inherit; }

/* ===== HERO ===== */
.hack-hero{
    position: relative;
    border-radius: 22px;
    border: 1px solid var(--border);
    overflow:hidden;
    box-shadow: var(--shadow);
    background:
        radial-gradient(900px 320px at 15% 5%, rgba(59,130,246,.35), transparent 60%),
        radial-gradient(900px 320px at 85% 10%, rgba(34,197,94,.18), transparent 55%),
        linear-gradient(180deg, rgba(7,11,22,.85), rgba(11,21,48,.88));
    padding: 18px 18px;
}
.hack-hero .hero-top{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:12px;
    flex-wrap:wrap;
}
.hack-hero h2{
    margin:0;
    font-weight: 1000;
    letter-spacing:.3px;
    color: var(--text);
    font-size: clamp(18px, 2.2vw, 26px);
    line-height:1.15;
    text-transform: uppercase;
}
.hack-hero p{
    margin:8px 0 0 0;
    color: var(--muted);
    font-size: 13.5px;
    line-height:1.4;
    max-width: 820px;
}

.hero-badges{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    justify-content:flex-end;
}
.badge-pill{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding: 8px 12px;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,.14);
    background: rgba(255,255,255,.06);
    color: rgba(255,255,255,.90);
    font-weight: 900;
    font-size: 12px;
    white-space: nowrap;
}
.dot{
    width:9px;height:9px;border-radius:50%;
    background: rgba(255,255,255,.45);
    box-shadow: 0 0 0 4px rgba(255,255,255,.10);
}
.dot.blue{ background: var(--primary); box-shadow:0 0 0 4px rgba(59,130,246,.18); }
.dot.green{ background: var(--good); box-shadow:0 0 0 4px rgba(34,197,94,.16); }

.notice-box{
    margin-top: 14px;
    border-radius: 18px;
    border: 1px solid rgba(255,255,255,.12);
    background: rgba(0,0,0,.18);
    padding: 14px 16px;
    color: rgba(255,255,255,.86);
}

/* ===== GRID LIST ===== */
.list-ac{ display:flex; flex-wrap:wrap; margin:0; padding:0; list-style:none; }
.list-ac>li{ list-style:none; }

.product-card{
    height: 100%;
    border-radius: var(--radius);
    border: 1px solid rgba(255,255,255,.12);
    background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.04));
    overflow:hidden;
    box-shadow: 0 18px 50px rgba(0,0,0,.22);
    transition: .18s ease;
    display:flex;
    flex-direction:column;
}
.product-card:hover{
    transform: translateY(-3px);
    border-color: rgba(59,130,246,.40);
    box-shadow: 0 26px 70px rgba(0,0,0,.32);
}

.thumb{
    position:relative;
    width:100%;
    padding-top: 62%;
    overflow:hidden;
    background: rgba(255,255,255,.03);
}
.thumb img{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit: cover;
    display:block;
    filter: saturate(1.05);
}
.thumb:after{
    content:"";
    position:absolute;
    inset:0;
    background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,.35));
    pointer-events:none;
}

.card-bodyx{
    padding: 12px 12px 10px 12px;
    display:flex;
    flex-direction:column;
    gap:10px;
    flex: 1 1 auto;
}
.title{
    margin:0;
    font-size: 14px;
    font-weight: 1000;
    letter-spacing: .25px;
    text-transform: uppercase;
    color: rgba(255,255,255,.94);
    line-height:1.25;
}
.subline{
    font-size: 12px;
    color: rgba(255,255,255,.70);
    margin-top:-4px;
}

/* select */
.box-price{
    border-radius: 14px !important;
    border: 1px solid rgba(255,255,255,.16) !important;
    background: rgba(0,0,0,.20) !important;
    color: rgba(255,255,255,.92) !important;
    height: 44px !important;
    padding: 10px 12px !important;
    outline: none !important;
    box-shadow: none !important;
}
.box-price:focus{
    border-color: rgba(59,130,246,.55) !important;
    box-shadow: 0 0 0 4px rgba(59,130,246,.14) !important;
}
.box-price option{ color:#111; } /* dropdown của trình duyệt thường nền trắng */

.btn-buy{
    width:100%;
    border: 0;
    border-radius: 14px;
    padding: 11px 12px;
    font-weight: 1000;
    letter-spacing: .25px;
    background: linear-gradient(135deg, var(--good), #16a34a);
    color:#fff;
    transition: .18s ease;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
}
.btn-buy:hover{ transform: translateY(-1px); filter: brightness(1.06); }

.btn-guide{
    margin-top: 2px;
    border-radius: 14px;
    padding: 11px 12px;
    font-weight: 1000;
    letter-spacing: .2px;
    border: 1px solid rgba(255,255,255,.14);
    background: rgba(255,255,255,.06);
    color: rgba(255,255,255,.92) !important;
    text-decoration:none !important;
    display:block;
    text-align:center;
    transition: .18s ease;
}
.btn-guide:hover{ background: rgba(255,255,255,.10); color:#fff !important; transform: translateY(-1px); }

.empty-state{
    border-radius: 18px;
    border: 1px solid rgba(255,255,255,.12);
    background: rgba(0,0,0,.18);
    padding: 16px;
    color: rgba(255,255,255,.86);
    text-align:center;
}

/* ===== MOBILE ===== */
@media (max-width: 576px){
    .hack-hero{ border-radius: 18px; padding: 14px; }
    .notice-box{ border-radius: 16px; padding: 12px; }
}

/* ===== Pagination (nếu có dùng pagination_account ở trang khác thì vẫn đẹp) ===== */
.pagination, .page-item, .page-link{ background: transparent !important; }
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
.page-link:hover{ filter: brightness(1.06); }
</style>

<section class="baner">
    <div class="container">
        <div class="row" style="margin-top: 80px; margin-bottom: 35px;">
            <div class="col-sm-12">
                <div class="hack-hero">
                    <div class="hero-top">
                        <div>
                            <h2>MUA HACK - <?=$cate['name']?></h2>
                            <p><?=$LOCNGUYEN_SIEUTHICODE->site('noti_home')?></p>
                        </div>

                        <div class="hero-badges">
                            <span class="badge-pill"><span class="dot blue"></span>Đang hiển thị: <b><?=$total_groups?></b></span>
                            <span class="badge-pill"><span class="dot green"></span>Thanh toán nhanh</span>
                        </div>
                    </div>

                    <div class="notice-box">
                        <?=$cate['content']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="box-home all">
        <div class="content homepage">
            <div class="menu_top">
                <div class="middle home-product-tabbed">
                    <div class="tabbed-container all">
                        <div class="">
                            <div class="box-home mt20 all">

                                <ul class="list-ac all" id="listAccAjax">
                                    <?php
                                    // ✅ GIỮ NGUYÊN LOGIC: lọc status=1
                                    $sql_groups = "SELECT * FROM `tbl_groups_hack`
                                                  WHERE `cate_id`='" . $cate['id'] . "' AND `status`=1
                                                  ORDER BY `stt` ASC LIMIT $from,$sotin1trang";
                                    $groups = $LOCNGUYEN_SIEUTHICODE->get_list($sql_groups);

                                    if (!$groups || count($groups) == 0):
                                    ?>
                                        <li class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0 10px;">
                                            <div class="empty-state">Hiện chưa có sản phẩm nào trong danh mục này.</div>
                                        </li>
                                    <?php else:
                                        foreach ($groups as $group):
                                    ?>
                                        <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;margin-bottom:18px;">
                                            <div class="product-card">
                                                <div class="thumb">
                                                    <img src="<?= $group['images'] ?>" alt=""
                                                         onerror="this.src='https://via.placeholder.com/600x400?text=No+Image'">
                                                </div>

                                                <div class="card-bodyx">
                                                    <div class="text-center">
                                                        <div class="title text-truncate"><?= $group['name'] ?></div>
                                                        <div class="subline">Chọn gói phù hợp và bấm Thuê</div>
                                                    </div>

                                                    <div class="rentControl">
                                                        <select name="package"
                                                                class="form-control box-price package<?= $group['id'] ?>"
                                                                id="RentTime_<?= $group['id'] ?>" title="Chọn mức giá">
                                                            <option value="">- Chọn mức giá -</option>
                                                            <?php
                                                            // GIỮ NGUYÊN LOGIC: lấy package theo groups_id
                                                            $sql_pack = "SELECT * FROM `tbl_package_hack` WHERE `groups_id`='" . $group['id'] . "'";
                                                            foreach ($LOCNGUYEN_SIEUTHICODE->get_list($sql_pack) as $package) :
                                                            ?>
                                                                <option value="<?= $package['id'] ?>">
                                                                    <?= format_cash($package['price']) ?>đ /
                                                                    <?= convertHoursToDays($package['thoigian'])['days'] ?>day (<?= convertHoursToDays($package['thoigian'])['hours'] ?>h)
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <button type="button" class="btn-buy"
                                                            onclick="modalPayment(<?= $group['id'] ?>,`<?= $group['name'] ?>`)">
                                                        <i class="fa fa-shopping-cart"></i> Thuê ngay
                                                    </button>

                                                    <a href="index.php?action=view_hack&type=<?= $group['slug'] ?>" class="btn-guide">
                                                        Tải Tool & Xem Hướng Dẫn
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; endif; ?>
                                </ul>

                                <?php
                                // ✅ Pagination giữ nguyên logic nếu bạn đang dùng ở trang này
                                // Nếu site bạn có hàm pagination_account thì mở dòng dưới:
                                // $tong = $LOCNGUYEN_SIEUTHICODE->num_rows("SELECT * FROM `tbl_groups_hack` WHERE `cate_id`='".$cate['id']."' AND `status`=1");
                                // if ($tong > $sotin1trang) echo '<div style="display:flex;justify-content:center;margin:12px 0 0;">'.pagination_account('index.php?action=hack&type='.xss($_GET['type']).'&', $from, $tong, $sotin1trang).'</div>';
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== Modal base CSS của bạn (GIỮ NGUYÊN) ===== -->
<style>
.modal-open { overflow: hidden }
.modal-open .modal { overflow-x: hidden; overflow-y: auto }
.modal { position: fixed; top: 0; left: 0; z-index: 1050; display: none; width: 100%; height: 100%; overflow: hidden; outline: 0 }
.modal-dialog { position: relative; width: auto; margin: .5rem; pointer-events: none }
.modal.fade .modal-dialog { transition: transform .3s ease-out; }
@media (prefers-reduced-motion:reduce){ .modal.fade .modal-dialog{ transition:none } }
.modal.show .modal-dialog { transform: none }
.modal.modal-static .modal-dialog { transform: scale(1.02) }
.modal-dialog-scrollable { display:flex; max-height: calc(100% - 1rem) }
.modal-dialog-scrollable .modal-content { max-height: calc(100vh - 1rem); overflow:hidden }
.modal-dialog-scrollable .modal-footer, .modal-dialog-scrollable .modal-header { flex-shrink:0 }
.modal-dialog-scrollable .modal-body { overflow-y:auto }
.modal-dialog-centered { display:flex; align-items:center; min-height: calc(100% - 1rem) }
.modal-dialog-centered:before { display:block; height: calc(100vh - 1rem); height: min-content; content:"" }
.modal-dialog-centered.modal-dialog-scrollable { flex-direction:column; justify-content:center; height:100% }
.modal-dialog-centered.modal-dialog-scrollable .modal-content { max-height:none }
.modal-dialog-centered.modal-dialog-scrollable:before { content:none }
.modal-content { position:relative; display:flex; flex-direction:column; width:100%; pointer-events:auto; background-color:#fff; background-clip:padding-box; border:1px solid rgba(0,0,0,.2); border-radius:5px; box-shadow: 0 .25rem .5rem rgba(0,0,0,.5); outline:0 }
.modal-backdrop { position:fixed; top:0; left:0; z-index:1040; width:100vw; height:100vh; background-color:#000 }
.modal-backdrop.fade { opacity:0 }
.modal-backdrop.show { opacity:.5 }
.modal-header { display:flex; align-items:flex-start; justify-content:space-between; padding:1rem; border-bottom:1px solid #f1f1f1; }
.modal-title { margin-bottom:0; line-height:1.5 }
.modal-body { position:relative; flex:1 1 auto; padding:1rem }
.modal-footer { display:flex; flex-wrap:wrap; align-items:center; justify-content:flex-end; padding:.75rem; border-top:1px solid #f1f1f1; border-bottom-right-radius:4px; border-bottom-left-radius:4px; background-color:#f5f5f5; }
.modal-footer>*{ margin:.25rem }
.modal-scrollbar-measure { position:absolute; top:-9999px; width:50px; height:50px; overflow:scroll }
@media (min-width:576px){
    .modal-dialog { max-width:500px; margin:1.75rem auto }
    .modal-dialog-scrollable { max-height: calc(100% - 3.5rem) }
    .modal-dialog-scrollable .modal-content { max-height: calc(100vh - 3.5rem) }
    .modal-dialog-centered { min-height: calc(100% - 3.5rem) }
    .modal-dialog-centered:before { height: calc(100vh - 3.5rem); height: min-content }
    .modal-content { box-shadow: 0 .5rem 1rem rgba(0,0,0,.5) }
    .modal-sm { max-width:300px }
}
@media (min-width:992px){
    .modal-lg, .modal-xl { max-width:800px }
}
@media (min-width:1200px){
    .modal-xl { max-width:1140px }
}
</style>

<!-- ===== VIP DARK MODAL OVERRIDE (đè trắng -> dark) ===== -->
<style>
#payment .modal-dialog{ max-width: 520px; margin: 12px auto; }

#payment .modal-content{
    border: 1px solid rgba(255,255,255,.14) !important;
    border-radius: 18px !important;
    overflow: hidden;
    background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.04)) !important;
    box-shadow: 0 22px 70px rgba(0,0,0,.55) !important;
    backdrop-filter: blur(10px);
}

#payment .modal-header{
    border-bottom: 1px solid rgba(255,255,255,.10) !important;
    background: rgba(0,0,0,.18) !important;
    padding: 14px 16px !important;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

#payment .modal-title{
    color: rgba(255,255,255,.92) !important;
    font-weight: 1000 !important;
    letter-spacing: .2px;
    margin: 0;
    display:flex;
    align-items:center;
    gap:10px;
    font-size: 16px;
}

#payment .close{
    width: 38px;
    height: 38px;
    border-radius: 999px !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    background: rgba(255,255,255,.06) !important;
    color: rgba(255,255,255,.85) !important;
    opacity: 1 !important;
    display:flex;
    align-items:center;
    justify-content:center;
    transition: transform .12s ease, filter .12s ease;
    outline: none;
}
#payment .close:hover{ filter: brightness(1.06); }
#payment .close:active{ transform: translateY(1px); }
#payment .close i{ font-size: 16px; }

#payment .modal-body{
    padding: 16px !important;
    color: rgba(255,255,255,.9) !important;
    background: transparent !important;
}

/* label + input */
#payment label{
    color: rgba(255,255,255,.82) !important;
    font-weight: 900 !important;
    margin-bottom: 8px !important;
    float: none !important;
    display:block !important;
}
#payment .form-group{ margin-bottom: 12px !important; }
#payment .form-control{
    width: 100% !important;
    height: auto !important;
    padding: 12px 12px !important;
    border-radius: 14px !important;
    background: rgba(0,0,0,.28) !important;
    border: 1px solid rgba(255,255,255,.14) !important;
    color: rgba(255,255,255,.92) !important;
    box-shadow: none !important;
    outline: none !important;
}
#payment .form-control:focus{
    border-color: rgba(59,130,246,.55) !important;
    box-shadow: 0 0 0 4px rgba(59,130,246,.14) !important;
}
#payment .form-control[readonly]{
    opacity: .95 !important;
    cursor: not-allowed !important;
}

/* Tổng tiền */
#payment .pay-summary{
    margin: 12px 0 14px;
    padding: 12px 12px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,.12);
    background: rgba(255,255,255,.05);
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 10px;
}
#payment .pay-summary .left{
    display:flex;
    align-items:center;
    gap:10px;
    color: rgba(255,255,255,.82);
    font-weight: 900;
}
#payment .pay-summary .left .ico{
    width: 36px;
    height: 36px;
    border-radius: 14px;
    display:flex;
    align-items:center;
    justify-content:center;
    background: rgba(59,130,246,.16);
    border: 1px solid rgba(59,130,246,.22);
    color: rgba(255,255,255,.9);
}
#payment #total{
    color: #f87171 !important;
    font-weight: 1000 !important;
    letter-spacing: .2px;
    font-size: 18px !important;
    white-space: nowrap;
}

/* Button */
#payment .btn.btn-search{
    width: 100% !important;
    border: 0 !important;
    border-radius: 14px !important;
    padding: 12px 14px !important;
    font-weight: 1000 !important;
    letter-spacing: .2px;
    color: #fff !important;
    background: linear-gradient(180deg, #22c55e, #16a34a) !important;
    box-shadow: 0 14px 35px rgba(34,197,94,.22);
    transition: transform .12s ease, filter .12s ease, opacity .12s ease;
}
#payment .btn.btn-search:hover{ filter: brightness(1.05); }
#payment .btn.btn-search:active{ transform: translateY(1px); }

/* backdrop đẹp hơn */
.modal-backdrop.show{ opacity: .65 !important; }

@media (max-width:576px){
    #payment .modal-dialog{ margin: 12px; }
    #payment .modal-body{ padding: 14px !important; }
    #payment #total{ font-size: 17px !important; }
}
</style>

<!-- ===== Modal (GIỮ NGUYÊN LOGIC: id/name/qty/totalPayment/buyHack) ===== -->
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fa fa-credit-card"></i> Thanh toán đơn hàng
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" name="card_form" id="card_chare">
                    <div class="Loadcard">

                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="hidden" class="form-control" id="id" readonly>
                            <input type="text" class="form-control" id="name" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nhập số lượng cần mua</label>
                            <input type="number" class="form-control" id="qty" min="1"
                                   onchange="totalPayment()" onkeyup="totalPayment()" placeholder="Ví dụ: 1">
                        </div>

                        <div class="pay-summary">
                            <div class="left">
                                <div class="ico"><i class="fa fa-calculator"></i></div>
                                <span>Tổng tiền cần thanh toán</span>
                            </div>
                            <b id="total">0đ</b>
                        </div>

                        <button type="button" onclick="buyHack()" class="btn btn-search" id="cardCharge">
                            <i class="fa fa-shopping-cart"></i> Thanh Toán
                        </button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="dist/js/sieuthicode.js?v=<?=time()?>"></script>