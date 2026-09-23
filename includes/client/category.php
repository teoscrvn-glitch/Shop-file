<?php
// =========================
// GIỮ NGUYÊN LOGIC CŨ
// - lấy category theo slug view
// - phân trang
// - list sản phẩm theo category
// =========================
if (isset($_GET['view'])) {
    $cate = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_categories` WHERE `slug` = '" . xss($_GET['view']) . "'  ");
    if (!$cate) {
        die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
}

$sotin1trang = 10;
if (isset($_GET['page'])) {
    $page = xss(intval($_GET['page']));
} else {
    $page = 1;
}
$page = max(1, (int)$page);
$from = ($page - 1) * $sotin1trang;

// list sản phẩm
$products = $LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_products` WHERE `category`='" . $cate['id'] . "' ORDER BY `id` DESC LIMIT $from,$sotin1trang ");
$tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `tbl_products` WHERE `category`='" . $cate['id'] . "'");
?>

<style>
:root{
  --bg0:#050914;
  --bg1:#070d1c;
  --card:rgba(255,255,255,.06);
  --card2:rgba(255,255,255,.08);
  --border:rgba(255,255,255,.12);
  --text:rgba(255,255,255,.92);
  --muted:rgba(255,255,255,.72);
  --shadow:0 18px 70px rgba(0,0,0,.55);
  --radius:18px;
  --primary:#3b82f6;
  --primary2:#2563eb;
  --danger:#ef4444;
}

/* Wrapper */
.cat-page{
  position:relative;
  margin-top:80px;
  color:var(--text);
}
.cat-page .bg{
  position:absolute; inset:-40px 0 auto 0;
  height: 420px;
  background:
    radial-gradient(900px 320px at 15% 10%, rgba(59,130,246,.22), transparent 55%),
    radial-gradient(700px 260px at 80% 0%, rgba(34,197,94,.14), transparent 55%),
    linear-gradient(180deg, var(--bg1), transparent 70%);
  pointer-events:none;
}
.cat-page .noise{
  position:absolute; inset:-40px 0 auto 0;
  height: 420px;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='140' height='140' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E");
  opacity:.22;
  mix-blend-mode: overlay;
  pointer-events:none;
}

/* Hero */
.cat-hero{
  position:relative;
  padding: 18px 0 12px;
}
.badge-live{
  display:inline-flex; align-items:center; gap:10px;
  padding: 8px 12px;
  border-radius: 999px;
  border:1px solid var(--border);
  background: rgba(255,255,255,.06);
  box-shadow: 0 10px 35px rgba(0,0,0,.35);
  backdrop-filter: blur(10px);
}
.badge-live .dot{
  width:10px; height:10px; border-radius:50%;
  background: var(--primary);
  box-shadow: 0 0 0 6px rgba(59,130,246,.14);
  animation: pulse 1.6s infinite;
}
@keyframes pulse{
  0%{ box-shadow: 0 0 0 0 rgba(59,130,246,.25); }
  70%{ box-shadow: 0 0 0 10px rgba(59,130,246,0); }
  100%{ box-shadow: 0 0 0 0 rgba(59,130,246,0); }
}
.cat-title{
  margin: 14px 0 6px;
  font-weight: 900;
  letter-spacing:.2px;
  line-height:1.12;
  font-size: clamp(22px, 2.2vw, 34px);
  text-transform: uppercase;
}
.cat-sub{
  margin:0;
  color:var(--muted);
  line-height:1.6;
}
.breadcrumbx{
  display:flex; flex-wrap:wrap; gap:8px;
  margin-top: 10px;
  color: rgba(255,255,255,.78);
  font-size: 14px;
}
.breadcrumbx a{ color: rgba(255,255,255,.88); text-decoration:none; }
.breadcrumbx a:hover{ color:#fff; text-decoration: underline; }

/* Grid cards */
.grid{
  position:relative;
  display:grid;
  gap:16px;
  grid-template-columns: repeat(1, minmax(0, 1fr));
}
@media (min-width: 768px){
  .grid{ grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (min-width: 1200px){
  .grid{ grid-template-columns: repeat(3, minmax(0, 1fr)); }
}

.pcard{
  border-radius: var(--radius);
  border:1px solid var(--border);
  background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.05));
  box-shadow: var(--shadow);
  overflow:hidden;
  transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
  backdrop-filter: blur(12px);
}
.pcard:hover{
  transform: translateY(-3px);
  border-color: rgba(59,130,246,.30);
  box-shadow: 0 22px 80px rgba(0,0,0,.62);
}
.pthumb{
  position:relative;
  width:100%;
  aspect-ratio: 16/9;
  background: rgba(0,0,0,.25);
  overflow:hidden;
}
.pthumb img{
  width:100%;
  height:100%;
  object-fit:cover;
  display:block;
  transform: scale(1.02);
}
.pthumb:after{
  content:"";
  position:absolute; inset:auto 0 0 0;
  height: 60%;
  background: linear-gradient(180deg, transparent, rgba(0,0,0,.55));
  pointer-events:none;
}
.pbody{ padding: 14px 14px 16px; }
@media (min-width: 992px){ .pbody{ padding: 16px 16px 18px; } }

.ptitle{
  margin:0 0 8px;
  font-weight: 900;
  text-transform: uppercase;
  font-size: 15px;
  letter-spacing:.2px;
  line-height: 1.25;
  display:-webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow:hidden;
  min-height: 38px;
}
.price{
  margin:0 0 10px;
  font-weight: 900;
  color: #ff5a5f;
  font-size: 18px;
}
.meta{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
  margin: 0 0 12px;
  color: rgba(255,255,255,.78);
  font-size: 13px;
}
.chip{
  display:inline-flex; align-items:center; gap:8px;
  padding: 6px 10px;
  border-radius: 999px;
  border:1px solid rgba(255,255,255,.12);
  background: rgba(0,0,0,.18);
}
.chip i{ opacity:.9; }

.btnx{
  display:flex;
  align-items:center;
  justify-content:center;
  gap:10px;
  width:100%;
  border:0;
  border-radius: 14px;
  padding: 11px 14px;
  font-weight: 900;
  text-decoration:none !important;
  color: #fff !important;
  background: linear-gradient(135deg, var(--primary), var(--primary2));
  box-shadow: 0 14px 40px rgba(37,99,235,.25);
  transition: transform .15s ease, filter .15s ease;
}
.btnx:hover{ filter: brightness(1.06); transform: translateY(-1px); }
.btnx:active{ transform: translateY(0); }

/* Pagination wrapper (giữ hàm pagination_account của bạn) */
.pag-wrap{
  margin-top: 18px;
  padding: 14px;
  border-radius: var(--radius);
  border:1px solid var(--border);
  background: rgba(255,255,255,.05);
  backdrop-filter: blur(10px);
}
.pag-wrap a, .pag-wrap span{
  color: rgba(255,255,255,.9) !important;
}
</style>

<div class="cat-page">
  <div class="bg"></div>
  <div class="noise"></div>

  <div class="container-fluid">

    <div class="cat-hero">
      <div class="badge-live">
        <span class="dot"></span>
        <span style="font-weight:900;">DANH MỤC</span>
        <span style="opacity:.7;">•</span>
        <span style="color:var(--muted);">Hiển thị <?= (int)$tong ?> sản phẩm</span>
      </div>

      <div class="cat-title"><?= htmlspecialchars($cate['name'] ?? $cate['title'] ?? 'Dịch vụ', ENT_QUOTES, 'UTF-8'); ?></div>
      <p class="cat-sub">Chọn sản phẩm bạn cần và bấm <b>Xem ngay</b> để xem chi tiết.</p>

      <div class="breadcrumbx">
        <a href="/">Trang chủ</a>
        <span style="opacity:.7;">/</span>
        <span><?= htmlspecialchars($cate['name'] ?? $cate['title'] ?? 'Danh mục', ENT_QUOTES, 'UTF-8'); ?></span>
      </div>
    </div>

    <div class="grid">
      <?php if (!empty($products)) : ?>
        <?php foreach ($products as $row) : ?>
          <div class="pcard">
            <div class="pthumb">
              <img src="<?= htmlspecialchars($row['images'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="pbody">
              <div class="ptitle"><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></div>

              <div class="price"><?= format_cash($row['price']); ?>đ</div>

              <div class="meta">
                <span class="chip"><i class="fa fa-eye"></i> Lượt xem: <?= format_cash($row['view']); ?></span>
                <span class="chip"><i class="fa fa-shopping-cart"></i> Đã bán: <?= format_cash($row['sold']); ?></span>
              </div>

              <a href="index.php?action=view_product&product=<?= urlencode($row['slug']); ?>" class="btnx">
                <i class="fa fa-eye"></i> Xem Ngay
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="pcard" style="grid-column:1/-1;">
          <div class="pbody">
            <div style="font-weight:900; font-size:18px; margin-bottom:6px;">Chưa có sản phẩm</div>
            <div style="color:var(--muted);">Danh mục này hiện chưa có sản phẩm nào.</div>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div class="row">
      <div class="col-lg-12 col-md-12 ml-auto">
        <?php if ($tong > $sotin1trang) : ?>
          <div class="pag-wrap">
            <center>
              <?= pagination_account('index.php?action=category&view=' . xss($_GET['view']) . '&', $from, $tong, $sotin1trang); ?>
            </center>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>