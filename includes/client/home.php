<?php
$sotin1trang = 10;
$page = isset($_GET['page']) ? xss((int)$_GET['page']) : 1;
$from = ($page - 1) * $sotin1trang;
?>

<section class="hero-vip">
  <div class="hero-vip__bg"></div>
  <div class="hero-vip__noise"></div>

  <div class="container">
    <div class="row hero-vip__row align-items-center">
      <div class="col-12 col-lg-8">
        <div class="glass hero-vip__card">
          <div class="hero-vip__top">
            <div class="hero-vip__badge">
              <span class="pulse-dot"></span>
              <span>VIP PRO UI</span>
              <span class="sep"></span>
              <span class="muted">Tối ưu mobile • tablet • PC</span>
            </div>

            <div class="hero-vip__chips">
              <span class="chip"><i class="fa fa-lock"></i> Bảo mật</span>
              <span class="chip"><i class="fa fa-bolt"></i> Nhanh</span>
              <span class="chip"><i class="fa fa-diamond"></i> Premium</span>
            </div>
          </div>

          <h1 class="hero-vip__title">
            <?= $LOCNGUYEN_SIEUTHICODE->site('noti_home') ?>
          </h1>

          <p class="hero-vip__desc">
            Trải nghiệm hiện đại — “premium”, Chóng Band Lên Rank Siêu Nhanh.
          </p>

          <div class="hero-vip__cta">
            <a href="#danh-sach" class="btnx btnx--primary">
              <i class="fa fa-th-large"></i> Xem danh sách
              <span class="btnx__shine"></span>
            </a>
            <a href="#thong-bao" class="btnx btnx--ghost">
              <i class="fa fa-bell"></i> Thông báo
            </a>
          </div>

          <div class="hero-vip__stats">
            <div class="stat">
              <div class="stat__num"><i class="fa fa-star"></i> PRO</div>
              <div class="stat__txt">Giao diện</div>
            </div>
            <div class="stat">
              <div class="stat__num"><i class="fa fa-mobile"></i> 100%</div>
              <div class="stat__txt">Responsive</div>
            </div>
            <div class="stat">
              <div class="stat__num"><i class="fa fa-feather"></i> Mượt</div>
              <div class="stat__txt">Animation</div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4 mt-4 mt-lg-0" id="thong-bao">
        <div class="glass notice-vip">
          <div class="notice-vip__head">
            <div class="notice-vip__icon"><i class="fa fa-bullhorn"></i></div>
            <div>
              <div class="notice-vip__title">Thông báo</div>
              <div class="notice-vip__sub">Cập nhật mới nhất</div>
            </div>
          </div>
          <div class="notice-vip__body">
            <?= $LOCNGUYEN_SIEUTHICODE->site('thongbao'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container mt-4" id="danh-sach">
  <div class="section-vip">
    <div>
      <h3 class="section-vip__title">DANH SÁCH</h3>
      <p class="section-vip__desc">Hack Prenium Pro , Uy tín số 1 VIỆT NAM.</p>
    </div>

    <div class="section-vip__right">
      <div class="search-vip">
        <i class="fa fa-search"></i>
        <input id="vipSearch" type="text" placeholder="Tìm nhanh theo tên..." autocomplete="off">
      </div>
      <span class="pill"><i class="fa fa-shield"></i> Verified UI</span>
    </div>
  </div>
</div>

<div class="container pb-4">
  <div class="grid-vip" id="vipGrid">
    <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_category_hack` WHERE `status` = 1 ORDER BY `stt` ASC LIMIT $from,$sotin1trang ") as $row) : ?>
      <div class="grid-vip__item" data-name="<?= strtolower($row['name']) ?>">
        <div class="card-vip">
          <a class="card-vip__thumb" href="index.php?action=groups_hack&type=<?= $row['slug'] ?>">
            <img loading="lazy" src="<?= $row['images'] ?>" alt="<?= $row['name'] ?>">
            <div class="thumb__grad"></div>

            <div class="thumb__top">
              <span class="tag-vip"><i class="fa fa-fire"></i> HOT</span>
              <span class="tag-vip tag-vip--alt"><i class="fa fa-crown"></i> VIP</span>
            </div>

            <div class="thumb__bottom">
              <span class="mini"><i class="fa fa-bolt"></i> Nhanh</span>
              <span class="mini"><i class="fa fa-lock"></i> An toàn</span>
            </div>
          </a>

          <div class="card-vip__body">
            <h4 class="card-vip__title" title="<?= $row['name'] ?>"><?= $row['name'] ?></h4>
            <p class="card-vip__desc" title="<?= $row['content'] ?>"><?= $row['content'] ?></p>

            <div class="card-vip__footer">
              <a href="index.php?action=groups_hack&type=<?= $row['slug'] ?>" class="btnx btnx--primary w-100">
                <i class="fa fa-rocket"></i> Thuê
                <span class="btnx__shine"></span>
              </a>
            </div>
          </div>

          <div class="card-vip__glow"></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- ✅ ĐÃ XÓA HẲN TOÀN BỘ MODAL POPUP 2 GIỜ -->

<style>
/* ======================
   VIP PRO ULTRA UI
   ====================== */
:root{
  --bg0:#050816;
  --bg1:#070A1C;
  --bg2:#0B1636;
  --t:#EAF1FF;
  --m:rgba(234,241,255,.74);
  --line:rgba(255,255,255,.13);
  --glass:rgba(255,255,255,.08);
  --glass2:rgba(255,255,255,.06);
  --shadow: 0 24px 70px rgba(0,0,0,.45);
  --r:22px;

  --b1:#3B82F6;
  --b2:#22C55E;
  --p1:#A855F7;
  --p2:#06B6D4;
  --danger:#EF4444;
}

/* glass */
.glass{
  border: 1px solid var(--line);
  background: linear-gradient(180deg, var(--glass), var(--glass2));
  border-radius: calc(var(--r) + 6px);
  box-shadow: var(--shadow);
  backdrop-filter: blur(14px);
}

/* HERO */
.hero-vip{
  position:relative;
  padding: 86px 0 40px;
  background:
    radial-gradient(1100px 540px at 10% 0%, rgba(59,130,246,.42), transparent 60%),
    radial-gradient(900px 500px at 90% 18%, rgba(34,197,94,.30), transparent 60%),
    radial-gradient(900px 520px at 65% 95%, rgba(168,85,247,.24), transparent 60%),
    linear-gradient(180deg, var(--bg0), var(--bg2));
  overflow:hidden;
}
.hero-vip__bg{
  position:absolute; inset:-2px;
  background:
    radial-gradient(circle at 22% 20%, rgba(255,255,255,.14), transparent 35%),
    radial-gradient(circle at 74% 48%, rgba(255,255,255,.10), transparent 42%);
  opacity:.7;
  pointer-events:none;
}
.hero-vip__noise{
  position:absolute; inset:0;
  pointer-events:none;
  opacity:.08;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='180'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='180' height='180' filter='url(%23n)' opacity='.35'/%3E%3C/svg%3E");
}
.hero-vip__row{ position:relative; z-index:2; }
.hero-vip__card{ padding: 26px 22px; }

.hero-vip__top{
  display:flex; align-items:flex-start; justify-content:space-between; gap:12px;
  flex-wrap:wrap;
}
.hero-vip__badge{
  display:inline-flex; align-items:center; gap:10px;
  padding: 8px 12px;
  border-radius: 999px;
  background: rgba(0,0,0,.18);
  border: 1px solid rgba(255,255,255,.14);
  color: var(--t);
  font-weight: 900;
  font-size: 12px;
}
.hero-vip__badge .sep{ width:1px; height:14px; background: rgba(255,255,255,.22); display:inline-block; }
.hero-vip__badge .muted{ color: rgba(234,241,255,.72); font-weight:800; }

.pulse-dot{
  width:10px; height:10px; border-radius:50%;
  background: linear-gradient(135deg, var(--b1), var(--b2));
  box-shadow: 0 0 0 0 rgba(59,130,246,.55);
  animation: pulse 1.6s infinite;
}
@keyframes pulse{
  0%{ box-shadow: 0 0 0 0 rgba(59,130,246,.55); }
  70%{ box-shadow: 0 0 0 12px rgba(59,130,246,0); }
  100%{ box-shadow: 0 0 0 0 rgba(59,130,246,0); }
}

.hero-vip__chips{ display:flex; gap:8px; flex-wrap:wrap; }
.chip{
  padding: 7px 10px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.14);
  background: rgba(255,255,255,.06);
  color: rgba(234,241,255,.88);
  font-weight: 900;
  font-size: 12px;
}

.hero-vip__title{
  margin: 16px 0 10px;
  color: var(--t);
  font-weight: 1000;
  letter-spacing: .2px;
  line-height: 1.12;
  font-size: clamp(22px, 2.4vw, 40px);
  text-shadow: 0 14px 50px rgba(0,0,0,.5);
}
.hero-vip__desc{
  margin: 0 0 16px;
  color: var(--m);
  font-size: 15px;
  line-height: 1.7;
}
.hero-vip__cta{ display:flex; gap:12px; flex-wrap:wrap; }

.hero-vip__stats{
  margin-top: 16px;
  display:grid;
  grid-template-columns: repeat(3, minmax(0,1fr));
  gap: 10px;
}
.stat{
  border-radius: 16px;
  border: 1px solid rgba(255,255,255,.12);
  background: rgba(0,0,0,.18);
  padding: 10px 12px;
}
.stat__num{
  color: var(--t);
  font-weight: 1000;
  font-size: 13px;
}
.stat__txt{
  margin-top: 2px;
  color: rgba(234,241,255,.68);
  font-weight: 800;
  font-size: 12px;
}

/* NOTICE */
.notice-vip{ padding: 16px; }
.notice-vip__head{
  display:flex; gap:12px; align-items:center;
  padding-bottom: 12px;
  border-bottom: 1px solid rgba(255,255,255,.10);
}
.notice-vip__icon{
  width:44px; height:44px; border-radius: 16px;
  display:grid; place-items:center;
  background: linear-gradient(135deg, rgba(59,130,246,.18), rgba(34,197,94,.18));
  border: 1px solid rgba(255,255,255,.14);
  color: var(--t);
}
.notice-vip__title{ color: var(--t); font-weight: 1000; }
.notice-vip__sub{ color: rgba(234,241,255,.62); font-weight: 800; font-size: 12px; }
.notice-vip__body{
  padding-top: 12px;
  color: var(--m);
  line-height: 1.75;
  font-size: 14px;
}

/* SECTION */
.section-vip{
  display:flex; align-items:flex-end; justify-content:space-between; gap:12px;
  flex-wrap:wrap;
  padding: 14px 6px 10px;
}
.section-vip__title{ margin:0; font-weight: 1000; letter-spacing: .6px; }
.section-vip__desc{ margin:6px 0 0; color:#6b7280; font-weight:700; font-size: 13px; }
.section-vip__right{ display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
.pill{
  display:inline-flex; align-items:center; gap:8px;
  padding: 8px 12px;
  border-radius: 999px;
  background: #0b1220;
  border: 1px solid #111827;
  color:#cbd5e1;
  font-weight: 900;
  font-size: 12px;
}

/* SEARCH */
.search-vip{
  display:flex; align-items:center; gap:10px;
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(15,23,42,.10);
  background:#fff;
  box-shadow: 0 10px 30px rgba(2,6,23,.08);
}
.search-vip input{
  border:none; outline:none;
  font-weight: 800;
  font-size: 14px;
  width: 240px;
}
@media (max-width: 576px){
  .search-vip input{ width: 170px; }
}

/* GRID */
.grid-vip{
  display:grid;
  grid-template-columns: repeat(1, minmax(0, 1fr));
  gap: 16px;
}
@media (min-width: 576px){
  .grid-vip{ grid-template-columns: repeat(2, minmax(0,1fr)); }
}
@media (min-width: 992px){
  .grid-vip{ grid-template-columns: repeat(4, minmax(0,1fr)); gap: 18px; }
}

.card-vip{
  position:relative;
  border-radius: var(--r);
  overflow:hidden;
  background:#fff;
  border: 1px solid rgba(15,23,42,.10);
  box-shadow: 0 18px 55px rgba(2,6,23,.12);
  transition: transform .22s ease, box-shadow .22s ease;
}
.card-vip:hover{
  transform: translateY(-6px);
  box-shadow: 0 26px 80px rgba(2,6,23,.18);
}
.card-vip__glow{
  position:absolute; inset:-2px;
  background: radial-gradient(700px 220px at 20% 0%, rgba(59,130,246,.22), transparent 55%),
              radial-gradient(700px 220px at 80% 0%, rgba(34,197,94,.18), transparent 55%);
  opacity:0;
  transition: opacity .22s ease;
  pointer-events:none;
}
.card-vip:hover .card-vip__glow{ opacity:1; }

.card-vip__thumb{
  position:relative;
  display:block;
  aspect-ratio: 16/10;
  background:#0b1220;
  overflow:hidden;
}
.card-vip__thumb img{
  width:100%; height:100%;
  object-fit:cover;
  transform: scale(1.03);
  transition: transform .38s ease;
}
.card-vip:hover .card-vip__thumb img{ transform: scale(1.10); }
.thumb__grad{
  position:absolute; inset:0;
  background: linear-gradient(180deg, rgba(2,6,23,.08), rgba(2,6,23,.65));
  pointer-events:none;
}
.thumb__top{
  position:absolute; top:12px; left:12px; right:12px;
  display:flex; gap:8px; flex-wrap:wrap;
}
.tag-vip{
  display:inline-flex; align-items:center; gap:8px;
  padding: 7px 10px;
  border-radius: 999px;
  color:#fff;
  font-weight: 1000;
  font-size: 12px;
  background: rgba(0,0,0,.28);
  border: 1px solid rgba(255,255,255,.18);
  backdrop-filter: blur(10px);
}
.tag-vip--alt{
  background: rgba(168,85,247,.22);
  border-color: rgba(255,255,255,.20);
}
.thumb__bottom{
  position:absolute; left:12px; right:12px; bottom:12px;
  display:flex; gap:8px; flex-wrap:wrap;
}
.mini{
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(255,255,255,.10);
  border: 1px solid rgba(255,255,255,.18);
  color: rgba(255,255,255,.92);
  font-weight: 900;
  font-size: 12px;
  backdrop-filter: blur(10px);
}

.card-vip__body{ padding: 14px 14px 16px; }
.card-vip__title{
  margin:0 0 6px;
  font-weight: 1000;
  text-transform: uppercase;
  font-size: 15px;
  color:#0f172a;
  overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
}
.card-vip__desc{
  margin:0 0 12px;
  color:#ef4444;
  font-weight: 1000;
  font-size: 13px;
  overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
}
.card-vip__footer .w-100{ width:100%; }

/* BUTTONS */
.btnx{
  position:relative;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:10px;
  padding: 11px 14px;
  border-radius: 14px;
  font-weight: 1000;
  font-size: 14px;
  border: 1px solid transparent;
  text-decoration:none !important;
  user-select:none;
  overflow:hidden;
  transition: transform .18s ease, box-shadow .18s ease, opacity .18s ease;
}
.btnx:active{ transform: translateY(1px) scale(.99); }
.btnx--primary{
  color:#fff !important;
  background: linear-gradient(135deg, var(--b1), var(--b2));
  box-shadow: 0 16px 40px rgba(34,197,94,.20);
}
.btnx--ghost{
  color:#0f172a !important;
  background:#fff;
  border-color: rgba(15,23,42,.10);
  box-shadow: 0 12px 28px rgba(2,6,23,.10);
}
.btnx--danger{
  color:#fff !important;
  background: linear-gradient(135deg, #fb7185, var(--danger));
  box-shadow: 0 16px 40px rgba(239,68,68,.20);
}
.btnx:hover{ opacity:.96; }

.btnx__shine{
  position:absolute;
  top:-30%;
  left:-40%;
  width: 60%;
  height: 160%;
  transform: rotate(22deg);
  background: linear-gradient(90deg, transparent, rgba(255,255,255,.35), transparent);
  filter: blur(0.2px);
  opacity:.0;
}
.btnx--primary:hover .btnx__shine{
  animation: shine 1.1s ease;
  opacity:1;
}
@keyframes shine{
  0%{ left:-60%; opacity:0; }
  30%{ opacity:1; }
  100%{ left:140%; opacity:0; }
}

/* Reduce motion */
@media (prefers-reduced-motion: reduce){
  *{ animation: none !important; transition: none !important; }
}
</style>

<script>
/* ✅ ĐÃ XÓA LOGIC MODAL 2 GIỜ - GIỮ NGUYÊN SEARCH UI */
document.addEventListener("DOMContentLoaded", function() {
  // search lọc card theo tên (UI thôi)
  var input = document.getElementById('vipSearch');
  var items = document.querySelectorAll('#vipGrid .grid-vip__item');
  if (input) {
    input.addEventListener('input', function() {
      var q = (input.value || '').toLowerCase().trim();
      items.forEach(function(el){
        var name = el.getAttribute('data-name') || '';
        el.style.display = (!q || name.includes(q)) ? '' : 'none';
      });
    });
  }
});
</script>