<?php
if (isset($_GET['type'])) {
    $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_groups_hack` WHERE `slug` = '" . xss($_GET['type']) . "'  ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
}

$title = $row['name'] ?? $row['title'] ?? 'Dịch vụ Tool';
$link_down = $row['link_down'] ?? '#';
?>

<style>
:root{
  --bg0:#050914;
  --bg1:#070d1c;
  --card:rgba(255,255,255,.06);
  --card2:rgba(255,255,255,.08);
  --border:rgba(255,255,255,.12);
  --text:rgba(255,255,255,.92);
  --muted:rgba(255,255,255,.70);
  --shadow:0 18px 70px rgba(0,0,0,.55);
  --radius:18px;
  --primary:#3b82f6;
  --primary2:#2563eb;
  --warn:#f59e0b;
}

/* wrapper */
.tool-page{
  position:relative;
  margin-top: 80px;
  color: var(--text);
}
.tool-page .bg{
  position:absolute; inset:-40px 0 auto 0;
  height: 420px;
  background:
    radial-gradient(900px 320px at 18% 10%, rgba(59,130,246,.22), transparent 55%),
    radial-gradient(700px 260px at 82% 0%, rgba(34,197,94,.14), transparent 55%),
    linear-gradient(180deg, var(--bg1), transparent 70%);
  pointer-events:none;
}
.tool-page .noise{
  position:absolute; inset:-40px 0 auto 0;
  height: 420px;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='140' height='140' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E");
  opacity:.22;
  mix-blend-mode: overlay;
  pointer-events:none;
}

/* hero */
.tool-hero{
  position:relative;
  padding: 16px 0 12px;
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
.tool-title{
  margin: 12px 0 6px;
  font-weight: 900;
  letter-spacing:.2px;
  line-height:1.12;
  font-size: clamp(22px, 2.2vw, 34px);
  text-transform: uppercase;
}
.tool-sub{
  margin:0;
  color: var(--muted);
  line-height:1.7;
}

/* download box */
.dl-box{
  margin-top: 14px;
  border-radius: var(--radius);
  border: 1px solid rgba(245,158,11,.28);
  background: linear-gradient(180deg, rgba(245,158,11,.16), rgba(0,0,0,.18));
  box-shadow: var(--shadow);
  backdrop-filter: blur(10px);
  overflow:hidden;
}
.dl-top{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:12px;
  padding: 14px 14px;
}
.dl-left{
  display:flex; align-items:flex-start; gap:12px;
}
.dl-ic{
  width:40px; height:40px;
  border-radius: 14px;
  display:flex; align-items:center; justify-content:center;
  background: rgba(245,158,11,.18);
  border:1px solid rgba(245,158,11,.25);
}
.dl-text b{ display:block; font-weight: 900; }
.dl-text span{
  display:block;
  color: rgba(255,255,255,.85);
  font-size: 13px;
  margin-top: 2px;
  word-break: break-all;
}
.btn-dl{
  white-space:nowrap;
  display:inline-flex; align-items:center; justify-content:center; gap:10px;
  padding: 10px 14px;
  border-radius: 14px;
  border:1px solid rgba(255,255,255,.14);
  text-decoration:none !important;
  font-weight: 900;
  color: #111827 !important;
  background: linear-gradient(135deg, #fbbf24, #f59e0b);
  box-shadow: 0 14px 40px rgba(245,158,11,.18);
  transition: transform .15s ease, filter .15s ease;
}
.btn-dl:hover{ filter: brightness(1.05); transform: translateY(-1px); }
.btn-dl:active{ transform: translateY(0); }

/* grid cards */
.tool-grid{
  position:relative;
  display:grid;
  gap: 16px;
  grid-template-columns: 1fr;
  margin-top: 16px;
}
@media (min-width: 992px){
  .tool-grid{ grid-template-columns: 1fr 1fr; }
}
.tcard{
  border-radius: var(--radius);
  border:1px solid var(--border);
  background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.05));
  box-shadow: var(--shadow);
  backdrop-filter: blur(12px);
  overflow:hidden;
}
.tcard .topline{
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--primary), rgba(34,197,94,.75), transparent);
  opacity:.95;
}
.tcard .body{
  padding: 16px;
}
@media (min-width: 992px){
  .tcard .body{ padding: 18px; }
}
.tcard h4{
  margin: 0 0 12px;
  font-weight: 900;
  text-transform: uppercase;
  letter-spacing:.2px;
  font-size: 16px;
  color: #fff;
  text-align:center;
}

/* content reset for HTML in DB */
.rich :where(p,li){ color: rgba(255,255,255,.88); line-height: 1.85; }
.rich :where(ul,ol){ padding-left: 20px; }
.rich a{ color:#93c5fd; text-decoration:none; }
.rich a:hover{ color:#bfdbfe; text-decoration: underline; }
.rich hr{
  border:0; height:1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,.14), transparent);
  margin: 14px 0;
}
.rich blockquote{
  margin: 12px 0;
  padding: 12px 12px 12px 14px;
  border-left: 3px solid rgba(59,130,246,.8);
  background: rgba(255,255,255,.05);
  border-radius: 12px;
  color: rgba(255,255,255,.86);
}
.rich pre{
  padding: 14px;
  border-radius: 14px;
  border:1px solid rgba(255,255,255,.12);
  background: rgba(0,0,0,.35);
  color: rgba(255,255,255,.9);
  overflow:auto;
}
.rich img{
  max-width:100%;
  height:auto;
  border-radius: 14px;
  border:1px solid rgba(255,255,255,.12);
}
</style>

<div class="tool-page">
  <div class="bg"></div>
  <div class="noise"></div>

  <div class="container mb20">

    <div class="tool-hero">
      <div class="badge-live">
        <span class="dot"></span>
        <span style="font-weight:900;">TOOL</span>
        <span style="opacity:.7;">•</span>
        <span style="color:var(--muted);">Hướng dẫn & chức năng</span>
      </div>

      <div class="tool-title"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></div>
      <p class="tool-sub">Xem thông tin chi tiết, tải tool và làm theo hướng dẫn cài đặt.</p>
    </div>

    <!-- DOWNLOAD BOX (thay alert cũ) -->
    <div class="dl-box">
      <div class="dl-top">
        <div class="dl-left">
          <div class="dl-ic"><i class="fa fa-download"></i></div>
          <div class="dl-text">
            <b>Link Tải Tool</b>
            <span><?= htmlspecialchars($link_down, ENT_QUOTES, 'UTF-8'); ?></span>
          </div>
        </div>
        <a class="btn-dl" href="<?= htmlspecialchars($link_down, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="nofollow noopener">
          <i class="fa fa-external-link"></i> MỞ LINK
        </a>
      </div>
    </div>

    <div class="tool-grid">
      <div class="tcard">
        <div class="topline"></div>
        <div class="body">
          <h4>CHỨC NĂNG</h4>
          <div class="rich">
            <?= $row['content'] ?>
          </div>
        </div>
      </div>

      <div class="tcard">
        <div class="topline"></div>
        <div class="body">
          <h4>HƯỚNG DẪN CÀI ĐẶT</h4>
          <div class="rich">
            <?= $row['tutorial'] ?>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>