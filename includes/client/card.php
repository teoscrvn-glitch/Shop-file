<?php
CheckLogin();

$PENDING_STATUS = 0; // ✅ status "đang chờ xử lý" (nếu bạn dùng khác, đổi ở đây)

$sotin1trang = 10;
$page = isset($_GET['page']) ? xss((int)$_GET['page']) : 1;
$page = max(1, $page);
$from = ($page - 1) * $sotin1trang;

$user_id = (int)$getUser['id'];

/**
 * ==========================
 * ✅ AJAX: trả JSON danh sách pending theo user
 * URL: index.php?action=card&ajax=pending
 * ==========================
 */
if (isset($_GET['ajax']) && $_GET['ajax'] === 'pending') {
    header('Content-Type: application/json; charset=utf-8');

    $pending = $LOCNGUYEN_SIEUTHICODE->get_list("SELECT `id`,`telco`,`serial`,`pin`,`amount`,`price`,`create_date`,`status`
        FROM `cards`
        WHERE `user_id`='{$user_id}' AND `status`='{$PENDING_STATUS}'
        ORDER BY `id` DESC
        LIMIT 50");

    echo json_encode([
        'ok' => true,
        'pending' => $pending,
        'pending_status' => $PENDING_STATUS
    ]);
    exit;
}

/**
 * ==========================
 * ✅ DATA:
 * - Pending: status = pending
 * - History: status != pending
 * ==========================
 */
$pending_list = $LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `cards`
    WHERE `user_id`='{$user_id}' AND `status`='{$PENDING_STATUS}'
    ORDER BY `id` DESC
    LIMIT 50");

$history_list = $LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `cards`
    WHERE `user_id`='{$user_id}' AND `status`<>'{$PENDING_STATUS}'
    ORDER BY `id` DESC
    LIMIT $from,$sotin1trang");

$tong_history = $LOCNGUYEN_SIEUTHICODE->num_rows("SELECT * FROM `cards`
    WHERE `user_id`='{$user_id}' AND `status`<>'{$PENDING_STATUS}'");
?>

<style>
:root{
  --header-h: 85px;
  --bg1:#050a16;
  --bg2:#0b1220;
  --card: rgba(15,23,42,.88);
  --bd: rgba(255,255,255,.10);
  --tx: rgba(255,255,255,.95);
  --muted: rgba(255,255,255,.70);
  --pri:#6366f1;
  --pri2:#4f46e5;
  --ok:#22c55e;
  --radius:20px;
}
section.baner{ padding-top: var(--header-h) !important; margin:0 !important; }

html,body{ height:auto !important; overflow:auto !important; overflow-x:hidden !important; }
.modal-backdrop,.overlay,.loading-overlay,.preloader{ display:none !important; }

.card-page{
  padding:25px 0 40px;
  background:
    radial-gradient(900px 420px at 10% 5%, rgba(99,102,241,.18), transparent 55%),
    radial-gradient(800px 400px at 90% 10%, rgba(34,197,94,.12), transparent 55%),
    linear-gradient(180deg,var(--bg1),var(--bg2));
}

.card-hero{
  border:1px solid var(--bd);
  border-radius:var(--radius);
  background:rgba(15,23,42,.95);
  padding:25px;
  box-shadow:0 20px 60px rgba(0,0,0,.35);
}
.card-hero h5{ margin:0; font-size:22px; font-weight:1000; color:var(--tx); }
.card-hero p{ margin-top:10px; font-size:13px; color:var(--muted); line-height:1.6; }
.hero-badge{
  margin-top:15px; display:inline-flex; align-items:center; gap:8px;
  padding:6px 14px; border-radius:999px; border:1px solid var(--bd);
  background:rgba(2,6,23,.4); font-size:12px; font-weight:900; color: rgba(255,255,255,.88);
}
.hero-badge span{ width:10px;height:10px; background:linear-gradient(135deg,var(--ok),#3b82f6); border-radius:50%; }

.card-grid{ margin-top:20px; display:grid; grid-template-columns:1fr 1fr; gap:15px; }
@media(max-width:992px){ .card-grid{grid-template-columns:1fr;} }

.panel{
  border:1px solid var(--bd);
  border-radius:var(--radius);
  background:var(--card);
  box-shadow:0 15px 40px rgba(0,0,0,.3);
  overflow:hidden;
}
.panel-head{
  padding:15px; border-bottom:1px solid var(--bd);
  font-weight:1000; font-size:14px; color: rgba(255,255,255,.92);
  background: rgba(2,6,23,.25);
  display:flex; align-items:center; justify-content:space-between; gap:10px;
}
.panel-body{padding:18px;}

.f-label{ font-size:12px; font-weight:900; margin-bottom:6px; display:block; color: rgba(255,255,255,.90); }
.f-control{
  width:100%; padding:12px; border-radius:14px !important;
  border:1px solid rgba(255,255,255,.15) !important;
  background:rgba(2,6,23,.5) !important; color:#fff !important;
}
.f-control::placeholder{ color: rgba(255,255,255,.55); }
.f-control:focus{ box-shadow:0 0 0 4px rgba(99,102,241,.35); border-color:rgba(99,102,241,.6) !important; }
.btn-pay{
  margin-top:12px; width:100%; padding:13px; border-radius:16px;
  font-weight:1000; border:0; background:linear-gradient(135deg,var(--pri),var(--pri2));
  color:#fff; cursor:pointer;
}
.btn-pay.is-loading{ opacity:.85; pointer-events:none; position:relative; }
.btn-pay.is-loading:after{
  content:""; width:16px;height:16px; border:2px solid rgba(255,255,255,.55);
  border-top-color:#fff; border-radius:50%; display:inline-block; margin-left:10px;
  vertical-align:-3px; animation: spin .7s linear infinite;
}
@keyframes spin{ to{ transform: rotate(360deg); } }

.table{ color:#fff; font-size:12.5px; }
.table thead th{ background:rgba(15,23,42,.8) !important; border-color:rgba(255,255,255,.1) !important; color:#fff !important; }
.table td{ border-color:rgba(255,255,255,.08) !important; color: rgba(255,255,255,.90) !important; }

/* Pending box */
.pending-wrap{
  border:1px solid var(--bd);
  border-radius: var(--radius);
  background: rgba(2,6,23,.38);
  box-shadow:0 12px 30px rgba(0,0,0,.25);
  overflow:hidden;
}
.pending-head{
  padding:12px 14px;
  border-bottom:1px solid var(--bd);
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:10px;
  background: rgba(2,6,23,.35);
}
.pending-title{
  font-weight:1000;
  color: rgba(255,255,255,.92);
  display:flex;
  align-items:center;
  gap:10px;
}
.pending-dot{
  width:10px;height:10px;border-radius:50%;
  background: linear-gradient(135deg,#f59e0b,#60a5fa);
  box-shadow:0 0 0 4px rgba(245,158,11,.14);
  animation: pulse 1.2s infinite ease-in-out;
}
@keyframes pulse{
  0%{ transform:scale(1); opacity:1; }
  50%{ transform:scale(1.25); opacity:.75; }
  100%{ transform:scale(1); opacity:1; }
}
.pending-mini{ color: rgba(255,255,255,.65); font-weight:900; font-size:12px; }
.pending-list{ padding: 12px; display:grid; gap:10px; }

.pending-item{
  border:1px solid rgba(255,255,255,.10);
  background: rgba(15,23,42,.55);
  border-radius: 14px;
  padding: 10px 12px;
}
.pending-item .row1{
  display:flex; justify-content:space-between; align-items:center; gap:10px;
  font-weight:1000; color: rgba(255,255,255,.92); font-size:12.5px;
}
.pending-item .row2{
  margin-top:6px;
  display:grid;
  grid-template-columns: 1fr 1fr;
  gap:8px 12px;
  font-size:12px;
}
.pending-k{ color: rgba(255,255,255,.55); font-weight:900; }
.pending-v{ color: rgba(255,255,255,.90); font-weight:900; text-align:right; }

@media(max-width:768px){
  :root{ --header-h: 95px; }
  .pending-item .row2{ grid-template-columns: 1fr; }
  .pending-v{ text-align:left; }
}
</style>

<section class="baner">
  <div class="container card-page">

    <div class="card-hero">
      <h5>NẠP THẺ CÀO</h5>
      <p>
        BANHACK - WEB THUÊ HACK PUBG MOBILE, TOOL LOL(LMHT),
        GENSHIN IMPACT, CALL OF DUTY, LIÊN QUÂN, VALORANT...
      </p>
      <div class="hero-badge"><span></span> Nạp tự động • Xử lý nhanh</div>

      <div style="margin-top:15px;">
        <?= $LOCNGUYEN_SIEUTHICODE->site('notice_napthe') ?>
      </div>
    </div>

    <!-- ✅ PENDING: chỉ lấy status = pending -->
    <div id="topup_pending_box" style="margin-top:15px; <?= (count($pending_list) ? '' : 'display:none;') ?>">
      <div class="pending-wrap">
        <div class="pending-head">
          <div class="pending-title">
            <span class="pending-dot"></span>
            TOPUP • Thẻ đang chờ xử lý
          </div>
          <div class="pending-mini" id="pending_count"><?= (int)count($pending_list) ?> yêu cầu</div>
        </div>

        <div id="pending_list" class="pending-list">
          <?php foreach($pending_list as $p){ ?>
            <div class="pending-item" data-id="<?= (int)$p['id'] ?>">
              <div class="row1">
                <div><?= $p['telco'] ?> • <?= format_cash($p['amount']) ?>đ</div>
                <div style="color:rgba(255,255,255,.65);font-weight:900;font-size:12px;"><?= $p['create_date'] ?></div>
              </div>
              <div class="row2">
                <div><span class="pending-k">Serial:</span> <span class="pending-v"><?= $p['serial'] ?></span></div>
                <div><span class="pending-k">Mã thẻ:</span> <span class="pending-v"><?= $p['pin'] ?></span></div>
                <div><span class="pending-k">Trạng thái:</span> <span class="pending-v">Đang chờ xử lý...</span></div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="card-grid">

      <!-- FORM -->
      <div class="panel">
        <div class="panel-head">
          <span>Nạp thẻ</span>
          <span style="font-size:12px;color:rgba(255,255,255,.65);font-weight:900;">Tự động</span>
        </div>
        <div class="panel-body">

          <!-- ✅ GIỮ NGUYÊN ID form để sieuthicode.js bắt -->
          <form id="card_sieuthicode">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">

            <label class="f-label">Nhà mạng</label>
            <select id="card_type_id" name="card_type_id" class="f-control" onchange="renderAmount()">
              <option value="">Chọn nhà mạng</option>
              <option value="VIETTEL">VIETTEL</option>
              <option value="VINAPHONE">VINAPHONE</option>
              <option value="MOBIFONE">MOBIFONE</option>
              <option value="VNMB">Vietnammobile</option>
              <option value="ZING">Zing</option>
              <option value="GARENA2">Garena</option>
              <option value="GATE">GATE</option>
              <option value="VCOIN">Vcoin</option>
            </select>

            <label class="f-label" style="margin-top:12px;">Mệnh giá</label>
            <select id="price_guest" name="price_guest" class="f-control">
              <option value="">Chọn mệnh giá</option>
              <option value="10000">10.000đ</option>
              <option value="20000">20.000đ</option>
              <option value="50000">50.000đ</option>
              <option value="100000">100.000đ</option>
              <option value="200000">200.000đ</option>
              <option value="500000">500.000đ</option>
              <option value="1000000">1.000.000đ</option>
            </select>

            <label class="f-label" style="margin-top:12px;">Serial</label>
            <input type="text" id="seri" name="seri" class="f-control" placeholder="Nhập Serial">

            <label class="f-label" style="margin-top:12px;">Mã thẻ</label>
            <input type="text" id="pin" name="pin" class="f-control" placeholder="Nhập Mã thẻ">

            <button id="btn_card_submit" type="submit" class="btn-pay">NẠP THẺ</button>
          </form>

        </div>
      </div>

      <!-- HISTORY: chỉ lấy status != pending -->
      <div class="panel">
        <div class="panel-head">
          <span>Lịch sử nạp thẻ</span>
          <span style="font-size:12px;color:rgba(255,255,255,.65);font-weight:900;">Trang <?= (int)$page ?></span>
        </div>
        <div class="panel-body">

          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Loại</th>
                  <th>Serial</th>
                  <th>Mã</th>
                  <th>Mệnh giá</th>
                  <th>Thực nhận</th>
                  <th>Thời gian</th>
                  <th>Trạng thái</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; foreach($history_list as $row){ ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $row['telco'] ?></td>
                  <td><?= $row['serial'] ?></td>
                  <td><?= $row['pin'] ?></td>
                  <td><?= format_cash($row['amount']) ?>đ</td>
                  <td><?= format_cash($row['price']) ?>đ</td>
                  <td><?= $row['create_date'] ?></td>
                  <td><?= status_card($row['status']) ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

          <?php
          if ($tong_history > $sotin1trang) {
              echo '<div style="margin-top:12px;text-align:center;">'
                . pagination_account('index.php?action=card&', $from, $tong_history, $sotin1trang)
                . '</div>';
          }
          ?>

        </div>
      </div>

    </div>
  </div>
</section>

<!-- ✅ Load sieuthicode.js (giữ nguyên hệ thống nạp hiện tại của bạn) -->
<script>
(function(){
  function loadScript(src, cb){
    var s=document.createElement("script");
    s.src=src;
    s.onload=function(){ cb && cb(); };
    document.head.appendChild(s);
  }
  function loadSieuthicode(){
    if (document.querySelector('script[data-stc="1"]')) return;
    var stc=document.createElement("script");
    stc.src="dist/js/sieuthicode.js?v=<?=time()?>";
    stc.setAttribute("data-stc","1");
    document.body.appendChild(stc);
  }
  if (typeof window.jQuery === "undefined") {
    loadScript("https://code.jquery.com/jquery-3.6.0.min.js", function(){ loadSieuthicode(); });
  } else {
    loadSieuthicode();
  }
})();
</script>

<!-- ✅ UI: bấm NẠP -> hiện pending ngay (nhưng LỊCH SỬ chỉ hiện khi status != pending) -->
<script>
(function(){
  const form = document.getElementById('card_sieuthicode');
  if(!form) return;

  const btn = document.getElementById('btn_card_submit');
  const box = document.getElementById('topup_pending_box');
  const list = document.getElementById('pending_list');
  const countEl = document.getElementById('pending_count');

  function nowText(){
    const d = new Date();
    const pad = (n)=> String(n).padStart(2,'0');
    return `${pad(d.getHours())}:${pad(d.getMinutes())}:${pad(d.getSeconds())} ${pad(d.getDate())}/${pad(d.getMonth()+1)}/${d.getFullYear()}`;
  }
  function maskMid(str){
    str = (str||"").toString().trim();
    if(str.length <= 6) return str;
    return str.slice(0,3) + "****" + str.slice(-3);
  }
  function addPendingUI({telco, amount, serial, pin}){
    box.style.display = 'block';
    const item = document.createElement('div');
    item.className = 'pending-item';
    item.innerHTML = `
      <div class="row1">
        <div>${telco || "Chưa chọn nhà mạng"} • ${amount || "Chưa chọn mệnh giá"}</div>
        <div style="color:rgba(255,255,255,.65);font-weight:900;font-size:12px;">${nowText()}</div>
      </div>
      <div class="row2">
        <div><span class="pending-k">Serial:</span> <span class="pending-v">${maskMid(serial)}</span></div>
        <div><span class="pending-k">Mã thẻ:</span> <span class="pending-v">${maskMid(pin)}</span></div>
        <div><span class="pending-k">Trạng thái:</span> <span class="pending-v">Đang chờ xử lý...</span></div>
      </div>
    `;
    if(list.firstChild) list.insertBefore(item, list.firstChild);
    else list.appendChild(item);
    countEl.textContent = `${list.querySelectorAll('.pending-item').length} yêu cầu`;
  }

  // chạy ngay khi submit (không chặn sieuthicode.js)
  form.addEventListener('submit', function(){
    const telco = (document.getElementById('card_type_id')||{}).value || '';
    const amount = (document.getElementById('price_guest')||{}).value || '';
    const serial = (document.getElementById('seri')||{}).value || '';
    const pin = (document.getElementById('pin')||{}).value || '';
    if(!telco || !amount || !serial || !pin) return;

    addPendingUI({
      telco,
      amount: (Number(amount).toLocaleString('vi-VN') + 'đ'),
      serial,
      pin
    });

    if(btn){
      btn.classList.add('is-loading');
      setTimeout(()=>btn.classList.remove('is-loading'), 5000);
    }
  }, true);
})();
</script>

<!-- ✅ AUTO UPDATE: Poll pending, nếu pending giảm / đổi trạng thái => reload để đẩy vào lịch sử -->
<script>
(function(){
  const url = "/ajaxs/card_pending.php";
  let lastIds = null;

  function getIds(arr){
    return (arr||[]).map(x => String(x.id)).sort().join(",");
  }

  async function poll(){
    try{
      const res = await fetch(url, {cache:"no-store"});
      const data = await res.json();
      if(!data || !data.ok) return;

      const ids = getIds(data.pending);
      // lần đầu
      if(lastIds === null){
        lastIds = ids;
        return;
      }

      // Nếu pending thay đổi => có thẻ đã xong (thành công hoặc fail/đã dùng) => reload để nó vào lịch sử
      if(ids !== lastIds){
        location.reload();
      }
    } catch(e){}
  }

  // chỉ poll nếu trang đang có pending box hoặc có pending trong DB
  setInterval(poll, 3500);
})();
</script>

<!-- ✅ FIX scroll nếu theme có modal-open -->
<script>
(function(){
  function forceEnableScroll(){
    try{
      document.body.classList.remove('modal-open');
      document.documentElement.style.overflow='auto';
      document.body.style.overflow='auto';
      document.body.style.position='static';
    }catch(e){}
  }
  window.addEventListener('load', forceEnableScroll);
  document.addEventListener('DOMContentLoaded', forceEnableScroll);
})();
</script>