<?php
// ====== Lấy dịch vụ theo slug (GIỮ LOGIC CŨ) ======
if (isset($_GET['slug'])) {
    $slug = xss($_GET['slug']); // dùng hàm xss() sẵn của bạn
    $row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_menu` WHERE `slug` = '{$slug}' ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
}

// Nội dung HTML lưu base64 trong DB
$content_html = base64_decode($row['noidung'] ?? '');
$title = $row['title'] ?? ($row['name'] ?? ($row['ten'] ?? 'Dịch vụ'));
$desc  = $row['mota']  ?? ($row['description'] ?? '');
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
  --glow:rgba(59,130,246,.28);
}

.page-service{
  position:relative;
  min-height: 60vh;
  margin-top: 80px;
  color: var(--text);
}

.page-service .bg{
  position:absolute; inset:-40px 0 auto 0;
  height: 420px;
  background:
    radial-gradient(800px 280px at 20% 10%, rgba(59,130,246,.22), transparent 55%),
    radial-gradient(700px 260px at 75% 0%, rgba(34,197,94,.14), transparent 55%),
    linear-gradient(180deg, var(--bg1), transparent 70%);
  filter:saturate(1.15);
  pointer-events:none;
}

.page-service .noise{
  position:absolute; inset:-40px 0 auto 0;
  height: 420px;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='140' height='140' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E");
  opacity:.22;
  mix-blend-mode: overlay;
  pointer-events:none;
}

.service-hero{
  position:relative;
  padding: 18px 0 10px;
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

.h-title{
  margin: 14px 0 6px;
  font-weight: 800;
  letter-spacing:.2px;
  line-height:1.12;
  font-size: clamp(22px, 2.2vw, 34px);
}
.h-desc{
  margin: 0;
  color: var(--muted);
  line-height:1.6;
  max-width: 920px;
}

.breadcrumbx{
  display:flex; flex-wrap:wrap; gap:8px;
  margin-top: 10px;
  color: rgba(255,255,255,.78);
  font-size: 14px;
}
.breadcrumbx a{
  color: rgba(255,255,255,.88);
  text-decoration:none;
}
.breadcrumbx a:hover{ color:#fff; text-decoration: underline; }

.glass-card{
  position:relative;
  border-radius: var(--radius);
  border:1px solid var(--border);
  background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.05));
  box-shadow: var(--shadow);
  backdrop-filter: blur(12px);
  overflow:hidden;
}

.glass-card .topline{
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--primary), rgba(34,197,94,.75), transparent);
  opacity:.95;
}

.card-bodyx{
  padding: 18px;
}
@media (min-width: 992px){
  .card-bodyx{ padding: 22px; }
}

.content-html{
  color: var(--text);
}

/* ====== Reset đẹp cho HTML trong noidung (CKEditor/HTML bất kỳ) ====== */
.content-html :where(h1,h2,h3,h4,h5){
  color: #fff;
  margin: 14px 0 10px;
  font-weight: 800;
  letter-spacing:.2px;
}
.content-html p{ color: rgba(255,255,255,.88); line-height:1.8; }
.content-html a{ color: #93c5fd; text-decoration: none; }
.content-html a:hover{ text-decoration: underline; color:#bfdbfe; }
.content-html :where(ul,ol){ padding-left: 20px; color: rgba(255,255,255,.88); line-height:1.8; }
.content-html li{ margin: 6px 0; }
.content-html hr{
  border:0; height:1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,.14), transparent);
  margin: 18px 0;
}
.content-html blockquote{
  margin: 14px 0;
  padding: 14px 14px 14px 16px;
  border-left: 3px solid rgba(59,130,246,.8);
  background: rgba(255,255,255,.05);
  border-radius: 12px;
  color: rgba(255,255,255,.86);
}
.content-html table{
  width:100%;
  border-collapse: collapse;
  overflow:hidden;
  border-radius: 14px;
  border:1px solid rgba(255,255,255,.12);
  background: rgba(0,0,0,.22);
}
.content-html th, .content-html td{
  padding: 10px 12px;
  border-bottom: 1px solid rgba(255,255,255,.10);
  color: rgba(255,255,255,.9);
}
.content-html th{
  background: rgba(255,255,255,.06);
  font-weight: 800;
}
.content-html img{
  max-width:100%;
  height:auto;
  border-radius: 14px;
  border:1px solid rgba(255,255,255,.12);
}
.content-html pre{
  padding: 14px;
  border-radius: 14px;
  border:1px solid rgba(255,255,255,.12);
  background: rgba(0,0,0,.35);
  color: rgba(255,255,255,.9);
  overflow:auto;
}
</style>

<div class="page-service">
  <div class="bg"></div>
  <div class="noise"></div>

  <div class="container mb20">
    <!-- HERO -->
    <div class="service-hero">
      <div class="badge-live">
        <span class="dot"></span>
        <span style="font-weight:800;">DỊCH VỤ</span>
        <span style="opacity:.7;">•</span>
        <span style="color:var(--muted);">Tối ưu mobile • tablet • PC</span>
      </div>

      <div class="h-title"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></div>

      <?php if (!empty($desc)): ?>
        <p class="h-desc"><?= htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?></p>
      <?php else: ?>
        <p class="h-desc">Xem chi tiết nội dung dịch vụ bên dưới.</p>
      <?php endif; ?>

      <div class="breadcrumbx">
        <a href="/">Trang chủ</a>
        <span style="opacity:.7;">/</span>
        <span><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></span>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="glass-card">
      <div class="topline"></div>
      <div class="card-bodyx">
        <div class="row">
          <div class="col-12">
            <div class="content-html">
              <?= $content_html /* giữ nguyên HTML decode từ DB */ ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>