<?php
CheckLogin();
CheckAdmin();

if (isset($_GET['id']) && $getUser['role'] == '1') {
    $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_package_hack` WHERE `id` = '" . xss($_GET['id']) . "'  ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
}

if (isset($_POST['editPacket']) && $getUser['role'] == '1') {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }

    $isUpdate = $LOCNGUYEN_SIEUTHICODE->update("tbl_package_hack", array(
        'price'    => xss($_POST['price']),
        'thoigian' => xss($_POST['thoigian'])
    ), " `id` = '" . $row['id'] . "' ");

    if ($isUpdate) {
        die('<script type="text/javascript">if(!alert("Lưu thành công !")){location.href = "";}</script>');
    } else {
        die('<script type="text/javascript">if(!alert("Lưu thất bại!")){window.history.back().location.reload();}</script>');
    }
}
?>

<style>
/* =========================
   DARK UI: NỀN ĐEN - CHỮ TRẮNG RÕ
   Responsive all thiết bị
   Không đổi logic
   ========================= */

:root{
  --bg:#070a12;
  --bg2:#0b1220;
  --card:#0e162a;
  --card2:#0b1428;
  --border:rgba(255,255,255,.14);
  --border2:rgba(255,255,255,.10);
  --text:rgba(255,255,255,.96);
  --muted:rgba(255,255,255,.72);
  --muted2:rgba(255,255,255,.55);
  --shadow: 0 18px 70px rgba(0,0,0,.60);
  --radius: 18px;
  --primary:#3b82f6;
  --primary2:#2563eb;
  --danger:#ef4444;
  --focus: 0 0 0 4px rgba(59,130,246,.22);
}

/* Ép card template thành dark + chữ trắng */
.container-fluid .card{
  background: linear-gradient(180deg, rgba(255,255,255,.05), rgba(255,255,255,.02)) !important;
  border: 1px solid var(--border) !important;
  border-radius: calc(var(--radius) + 10px) !important;
  box-shadow: var(--shadow) !important;
  overflow: hidden !important;
}
.container-fluid .card-body{
  background: transparent !important;
  color: var(--text) !important;
}

/* Nếu title/label của theme bị mờ */
.container-fluid label,
.container-fluid .card-title,
.container-fluid h1, .container-fluid h2, .container-fluid h3, .container-fluid h4, .container-fluid h5{
  color: #fff !important;
}

/* HERO */
.pkg-hero{
  position: relative;
  border-radius: calc(var(--radius) + 10px);
  padding: 18px 18px;
  overflow: hidden;
  background:
    radial-gradient(900px 320px at 10% -10%, rgba(59,130,246,.26), transparent 60%),
    radial-gradient(900px 320px at 90% -10%, rgba(34,197,94,.18), transparent 60%),
    linear-gradient(180deg, rgba(0,0,0,.38), rgba(0,0,0,.20));
  border: 1px solid var(--border2);
  box-shadow: 0 16px 50px rgba(0,0,0,.35);
  margin-bottom: 14px;
}
.pkg-hero:before{
  content:"";
  position:absolute; inset:0;
  background-image: radial-gradient(rgba(255,255,255,.10) 1px, transparent 1px);
  background-size: 22px 22px;
  opacity:.08;
  pointer-events:none;
}
.pkg-hero__top{
  position:relative;
  display:flex;
  gap: 12px;
  flex-wrap: wrap;
  align-items:center;
  justify-content: space-between;
  z-index:1;
}
.pkg-badge{
  display:inline-flex;
  align-items:center;
  gap: 10px;
  padding: 9px 12px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.16);
  background: rgba(0,0,0,.55);
  color: #fff;
  font-weight: 900;
  letter-spacing: .3px;
  text-transform: uppercase;
}
.pkg-dot{
  width: 10px; height: 10px; border-radius: 999px;
  background: var(--primary);
  box-shadow: 0 0 0 4px rgba(59,130,246,.18);
}
.pkg-sub{
  margin: 10px 0 0;
  color: var(--muted);
  font-size: 13px;
  line-height: 1.55;
}
.pkg-meta{
  display:flex;
  gap: 10px;
  flex-wrap: wrap;
  align-items:center;
  justify-content:flex-end;
}
.pkg-chip{
  padding: 7px 10px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.14);
  background: rgba(0,0,0,.55);
  color: #fff;
  font-size: 12px;
  white-space: nowrap;
}

/* HEAD của card */
.pkg-head{
  padding: 14px 18px;
  border-bottom: 1px solid rgba(255,255,255,.10);
  background: rgba(0,0,0,.45);
}
.pkg-title{
  margin: 0;
  color: #fff;
  font-size: 16px;
  font-weight: 1000;
}
.pkg-desc{
  margin: 6px 0 0;
  color: var(--muted);
  font-size: 12.5px;
}

/* FORM */
.pkg-body{
  padding: 16px 18px 18px;
}
.pkg-grid{
  display:grid;
  grid-template-columns: 1fr;
  gap: 14px;
}
.pkg-field label{
  display:block;
  margin: 0 0 8px;
  color: rgba(255,255,255,.92) !important;
  font-weight: 900;
  font-size: 13px;
  letter-spacing: .2px;
}

/* Input đen chữ trắng */
.pkg-input{
  width: 100%;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.16);
  background: rgba(0,0,0,.72) !important;
  color: #fff !important;
  padding: 12px 12px;
  outline: none;
  transition: all .15s ease;
  font-size: 14px;
}
.pkg-input::placeholder{ color: rgba(255,255,255,.45); }
.pkg-input:focus{
  border-color: rgba(59,130,246,.62);
  box-shadow: var(--focus);
  background: rgba(0,0,0,.82) !important;
}

/* bỏ spinner cho number cho đẹp */
.pkg-input[type=number]::-webkit-outer-spin-button,
.pkg-input[type=number]::-webkit-inner-spin-button{
  -webkit-appearance: none;
  margin: 0;
}
.pkg-input[type=number]{ -moz-appearance: textfield; }

.pkg-help{
  margin-top: 8px;
  color: var(--muted2);
  font-size: 12px;
  line-height: 1.45;
}

/* ACTIONS */
.pkg-actions{
  display:flex;
  gap: 10px;
  justify-content:flex-end;
  flex-wrap: wrap;
  margin-top: 14px;
  padding-top: 14px;
  border-top: 1px dashed rgba(255,255,255,.14);
}
.pkg-btn{
  appearance:none;
  border: 0;
  border-radius: 14px;
  padding: 11px 14px;
  font-weight: 1000;
  letter-spacing: .3px;
  cursor:pointer;
  transition: transform .12s ease, filter .12s ease, box-shadow .12s ease;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  text-decoration:none !important;
  min-width: 140px;
  user-select:none;
}
.pkg-btn:active{ transform: translateY(1px); }

.pkg-btn--back{
  background: rgba(239,68,68,.16);
  color: #fff !important;
  border: 1px solid rgba(239,68,68,.42);
}
.pkg-btn--save{
  background: linear-gradient(180deg, var(--primary), var(--primary2));
  color: #fff !important;
  border: 1px solid rgba(255,255,255,.12);
  box-shadow: 0 16px 34px rgba(37,99,235,.25);
}
.pkg-btn:hover{ filter: brightness(1.06); }

@media (min-width: 768px){
  .pkg-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); gap: 16px; }
  .pkg-btn{ min-width: 160px; }
}
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">

      <!-- Giữ card của template, nhưng ép dark + chữ trắng -->
      <div class="card">
        <div class="card-body">

          <div class="pkg-hero">
            <div class="pkg-hero__top">
              <div>
                <div class="pkg-badge">
                  <span class="pkg-dot"></span>
                  <span>CHỈNH SỬA GÓI</span>
                </div>
                <p class="pkg-sub">
                  Cập nhật <b style="color:#fff">giá tiền</b> và <b style="color:#fff">thời gian</b> của gói. Hiển thị rõ trên mọi thiết bị.
                </p>
              </div>

              <div class="pkg-meta">
                <span class="pkg-chip">ID gói: <b>#<?= (int)$row['id']; ?></b></span>
                <span class="pkg-chip">Quyền: <b>ADMIN</b></span>
              </div>
            </div>
          </div>

          <div class="pkg-head">
            <h3 class="pkg-title">Thông tin gói</h3>
            <p class="pkg-desc">Nhập dữ liệu và bấm <b style="color:#fff">CẬP NHẬT</b> để lưu.</p>
          </div>

          <div class="pkg-body">
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">

              <div class="pkg-grid">
                <div class="pkg-field">
                  <label for="price">Giá tiền</label>
                  <input
                    id="price"
                    name="price"
                    type="number"
                    min="1"
                    class="pkg-input"
                    value="<?= htmlspecialchars($row['price']); ?>"
                    placeholder="Nhập giá tiền"
                    required
                  >
                  <div class="pkg-help">Ví dụ: 50000</div>
                </div>

                <div class="pkg-field">
                  <label for="thoigian">Thời gian (giờ)</label>
                  <input
                    id="thoigian"
                    name="thoigian"
                    type="number"
                    min="1"
                    class="pkg-input"
                    value="<?= htmlspecialchars($row['thoigian']); ?>"
                    placeholder="Nhập số giờ"
                    required
                  >
                  <div class="pkg-help">Ví dụ: 24</div>
                </div>
              </div>

              <div class="pkg-actions">
                <a href="javascript:history.back()" class="pkg-btn pkg-btn--back">QUAY LẠI</a>
                <button type="submit" name="editPacket" class="pkg-btn pkg-btn--save">CẬP NHẬT</button>
              </div>

            </form>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>