<?php
CheckLogin();
CheckAdmin();
?>

<?php
if (isset($_POST['SaveSettings'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }

    foreach ($_POST as $key => $value) {
        // tránh lưu rác key SaveSettings
        if ($key === 'SaveSettings') continue;

        $LOCNGUYEN_SIEUTHICODE->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }

    die('<script type="text/javascript">if(!alert("Lưu thành công !")){window.history.back().location.reload();}</script>');
}
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

    .settings-wrap{ padding: 14px 10px; }

    .settings-card{
        background: linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    .settings-card .card-body{ padding: 18px; }

    .settings-head{
        display:flex;
        gap:12px;
        align-items:center;
        justify-content:space-between;
        padding: 16px 18px;
        border-bottom: 1px solid var(--border);
        background: radial-gradient(900px 200px at 10% 0%, rgba(99,102,241,.30), transparent 60%),
                    radial-gradient(900px 240px at 90% 0%, rgba(34,197,94,.18), transparent 55%);
    }
    .settings-title{
        margin:0;
        color:var(--text);
        font-weight:800;
        letter-spacing:.2px;
        font-size: 18px;
        line-height: 1.2;
    }
    .settings-sub{
        margin:4px 0 0 0;
        color: var(--muted);
        font-size: 13px;
    }
    .settings-actions{
        display:flex;
        gap:10px;
        flex-wrap:wrap;
        align-items:center;
        justify-content:flex-end;
    }

    .settings-tabs{
        border-bottom: 1px solid var(--border);
        background: rgba(2,6,23,.35);
        padding: 10px 10px 0 10px;
        position: sticky;
        top: 0;
        z-index: 5;
        backdrop-filter: blur(10px);
    }
    .settings-tabs .nav{
        gap: 8px;
        flex-wrap: nowrap;
        overflow-x: auto;
        overflow-y: hidden;
        padding-bottom: 8px;
        scrollbar-width: thin;
    }
    .settings-tabs .nav::-webkit-scrollbar{ height: 7px; }
    .settings-tabs .nav::-webkit-scrollbar-thumb{
        background: rgba(255,255,255,.16);
        border-radius: 999px;
    }

    .settings-tabs .nav-link{
        border: 1px solid var(--border) !important;
        border-radius: 999px !important;
        padding: 9px 12px !important;
        color: rgba(255,255,255,.78) !important;
        font-weight: 700;
        font-size: 12px;
        white-space: nowrap;
        background: rgba(15,23,42,.55);
        transition: .18s ease;
    }
    .settings-tabs .nav-link:hover{
        transform: translateY(-1px);
        background: rgba(15,23,42,.78);
        color: rgba(255,255,255,.92) !important;
    }
    .settings-tabs .nav-link.active{
        background: linear-gradient(135deg, var(--primary), var(--primary2)) !important;
        border-color: rgba(99,102,241,.5) !important;
        color: #fff !important;
        box-shadow: 0 10px 30px rgba(99,102,241,.25);
    }

    .tab-pane{ animation: fadeUp .20s ease; }
    @keyframes fadeUp{
        from{ opacity:0; transform: translateY(6px); }
        to{ opacity:1; transform: translateY(0); }
    }

    .form-section{
        border: 1px solid var(--border);
        border-radius: 14px;
        background: rgba(2,6,23,.25);
        padding: 14px;
        margin-bottom: 14px;
    }
    .form-section-title{
        margin: 0 0 10px 0;
        font-size: 13px;
        font-weight: 800;
        color: rgba(255,255,255,.92);
        letter-spacing: .2px;
        display:flex;
        align-items:center;
        gap:10px;
    }
    .form-section-title .dot{
        width:10px;height:10px;border-radius:50%;
        background: linear-gradient(135deg, #22c55e, #3b82f6);
        box-shadow: 0 0 0 4px rgba(34,197,94,.12);
    }

    .settings-label{
        font-weight: 700;
        font-size: 12.5px;
        color: rgba(255,255,255,.85);
        margin-bottom: 6px;
        display:block;
    }
    .settings-help{
        margin-top: 6px;
        font-size: 12px;
        color: rgba(255,255,255,.65);
    }

    .settings-input,
    .settings-select,
    .settings-textarea{
        width:100%;
        border-radius: 12px !important;
        border: 1px solid rgba(255,255,255,.14) !important;
        background: rgba(15,23,42,.65) !important;
        color: rgba(255,255,255,.92) !important;
        padding: 11px 12px !important;
        outline: none !important;
        transition: .18s ease;
    }
    .settings-textarea{ min-height: 130px; resize: vertical; }
    .settings-input:focus,
    .settings-select:focus,
    .settings-textarea:focus{
        box-shadow: 0 0 0 4px var(--focus) !important;
        border-color: rgba(99,102,241,.55) !important;
    }

    .btn-save{
        border-radius: 12px;
        padding: 11px 14px;
        font-weight: 800;
        letter-spacing: .2px;
        background: linear-gradient(135deg, var(--primary), var(--primary2));
        border: 0;
        box-shadow: 0 12px 34px rgba(99,102,241,.25);
    }
    .btn-save:hover{ filter: brightness(1.05); transform: translateY(-1px); }

    .settings-card + .settings-card{ margin-top: 16px; }

    @media (max-width: 576px){
        .settings-head{ flex-direction: column; align-items: flex-start; }
        .settings-actions{ width:100%; justify-content:flex-start; }
        .settings-card .card-body{ padding: 14px; }
        .settings-tabs{ top: 0; }
    }
</style>

<!-- =========================
     AUTO/BANK SETTINGS (GỌN + RESPONSIVE)
========================= -->
<style>
  :root{
    --bgA: rgba(2,6,23,.35);
    --bdA: rgba(255,255,255,.12);
    --txA: rgba(255,255,255,.92);
    --txB: rgba(255,255,255,.70);
    --txC: rgba(255,255,255,.55);
    --pri: #6366f1;
    --pri2:#4f46e5;
  }

  .auto-wrap{ padding: 6px; }

  .auto-card{
    border: 1px solid var(--bdA);
    background: rgba(2,6,23,.22);
    border-radius: 16px;
    padding: 14px;
    margin-bottom: 14px;
  }

  .auto-head{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:12px;
    margin-bottom: 12px;
  }
  .auto-title{
    margin:0;
    font-size: 14px;
    font-weight: 900;
    color: var(--txA);
    letter-spacing: .2px;
    display:flex;
    align-items:center;
    gap:10px;
  }
  .auto-badge{
    font-size: 11px;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 999px;
    border: 1px solid var(--bdA);
    color: var(--txB);
    background: rgba(15,23,42,.55);
    white-space: nowrap;
  }
  .auto-desc{
    margin:6px 0 0 0;
    color: var(--txB);
    font-size: 12px;
    line-height: 1.4;
  }

  .auto-grid{
    display:grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 12px;
    margin-top: 12px;
  }

  .auto-col-6{ grid-column: span 6; }
  .auto-col-12{ grid-column: span 12; }

  .auto-label{
    display:block;
    font-weight: 800;
    font-size: 12.5px;
    color: rgba(255,255,255,.86);
    margin-bottom: 6px;
  }
  .auto-help{
    margin-top: 6px;
    font-size: 12px;
    color: var(--txC);
  }

  .auto-input, .auto-select, .auto-textarea{
    width:100%;
    border-radius: 12px !important;
    border: 1px solid rgba(255,255,255,.14) !important;
    background: rgba(15,23,42,.65) !important;
    color: rgba(255,255,255,.92) !important;
    padding: 11px 12px !important;
    outline: none !important;
    transition: .18s ease;
  }
  .auto-textarea{ min-height: 90px; resize: vertical; }

  .auto-input:focus, .auto-select:focus, .auto-textarea:focus{
    box-shadow: 0 0 0 4px rgba(99,102,241,.40) !important;
    border-color: rgba(99,102,241,.55) !important;
  }

  .auto-actions{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-top: 12px;
  }

  .btn-auto-save{
    border-radius: 12px;
    padding: 11px 14px;
    font-weight: 900;
    letter-spacing: .2px;
    background: linear-gradient(135deg, var(--pri), var(--pri2));
    border: 0;
    box-shadow: 0 12px 34px rgba(99,102,241,.20);
    color:#fff;
  }
  .btn-auto-save:hover{ filter: brightness(1.05); transform: translateY(-1px); }

  .btn-auto-ghost{
    border-radius: 12px;
    padding: 11px 14px;
    font-weight: 900;
    letter-spacing: .2px;
    border: 1px solid var(--bdA);
    background: rgba(15,23,42,.55);
    color: rgba(255,255,255,.88);
  }
  .btn-auto-ghost:hover{ background: rgba(15,23,42,.75); }

  /* nhỏ hơn 768 thì 2 cột -> 1 cột */
  @media (max-width: 768px){
    .auto-col-6{ grid-column: span 12; }
    .auto-head{ flex-direction: column; align-items:flex-start; }
  }
</style>

<div class="container-fluid settings-wrap">
  <div class="row">
    <div class="col-12">

      <div class="card settings-card">
        <div class="settings-head">
          <div>
            <h3 class="settings-title">Cài đặt hệ thống</h3>
            <p class="settings-sub">Rõ chữ, hiện đại — giữ nguyên logic lưu Options.</p>
          </div>
          <div class="settings-actions">
            <button class="btn btn-save text-white" type="button" onclick="saveActiveTab();">
              <i class="fa fa-save"></i> Lưu tab đang mở
            </button>
          </div>
        </div>

        <div class="settings-tabs">
          <ul class="nav nav-tabs card-header-tabs border-0" role="tablist">
            <li role="presentation" class="nav-item">
              <a class="nav-link active" href="#home_animation_1" data-toggle="tab">THÔNG TIN CHUNG</a>
            </li>
            <li role="presentation" class="nav-item">
              <a class="nav-link" href="#profile_animation_1" data-toggle="tab">MOMO AUTO</a>
            </li>
            <li role="presentation" class="nav-item">
              <a class="nav-link" href="#messages_animation_1" data-toggle="tab">MBBANK AUTO</a>
            </li>
            <li role="presentation" class="nav-item">
              <a class="nav-link" href="#settings_zalopay" data-toggle="tab">ZALOPAY AUTO</a>
            </li>
            <li role="presentation" class="nav-item">
              <a class="nav-link" href="#settings_thesieure" data-toggle="tab">THESIEURE AUTO</a>
            </li>
            <li role="presentation" class="nav-item">
              <a class="nav-link" href="#settings_vcb" data-toggle="tab">VIETCOMBANK AUTO</a>
            </li>
            <li role="presentation" class="nav-item">
              <a class="nav-link" href="#settings_acb" data-toggle="tab">ACB AUTO</a>
            </li>
            <li role="presentation" class="nav-item">
              <a class="nav-link" href="#settings_napthe" data-toggle="tab">NẠP THẺ AUTO</a>
            </li>
          </ul>
        </div>

        <div class="card-body">
          <div class="tab-content">

            <!-- THÔNG TIN CHUNG -->
            <div role="tabpanel" class="tab-pane active" id="home_animation_1">
              <form action="" method="POST" enctype="multipart/form-data" class="js-settings-form">
                <input type="hidden" name="SaveSettings" value="1">
                <div class="form-section">
                  <div class="form-section-title"><span class="dot"></span>Thông tin Website</div>
                  <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Title (tiêu đề khi share lên MXH)</label>
                      <input type="text" name="title" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('title') ?>">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Description</label>
                      <input name="description" type="text" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('description') ?>">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Keywords</label>
                      <input name="keywords" type="text" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('keywords') ?>">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Author</label>
                      <input name="author" type="text" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('author') ?>">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Link Facebook</label>
                      <input name="link_facebook" type="text" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('link_facebook') ?>">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Link Youtube</label>
                      <input name="link_youtube" type="text" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('link_youtube') ?>">
                    </div>
                  </div>
                </div>

                <div class="form-section">
                  <div class="form-section-title"><span class="dot"></span>Liên hệ & SMTP</div>
                  <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Hotline</label>
                      <input name="hotline" type="text" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('hotline') ?>">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Email</label>
                      <input name="email" type="text" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('email') ?>">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Email SMTP</label>
                      <input name="email_smtp" type="text" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('email_smtp') ?>">
                      <div class="settings-help">VD: user@gmail.com</div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Password Email SMTP</label>
                      <input name="pass_email_smtp" type="text" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('pass_email_smtp') ?>">
                    </div>
                  </div>
                </div>

                <div class="form-section">
                  <div class="form-section-title"><span class="dot"></span>Nạp tiền & Tùy chọn</div>
                  <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Nội dung nạp tiền</label>
                      <input name="noidung_naptien" type="text" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('noidung_naptien') ?>">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Số tiền nạp tối thiểu</label>
                      <input name="min_recharge" type="number" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('min_recharge') ?>">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">% khuyến mãi khi nạp bank</label>
                      <input name="ck_bank" type="number" class="settings-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('ck_bank') ?>">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Auto update</label>
                      <select name="status_update" class="settings-select" required>
                        <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_update') == 1 ? 'selected' : ''; ?> value="1">Bật</option>
                        <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_update') == 0 ? 'selected' : ''; ?> value="0">Tắt</option>
                      </select>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                      <label class="settings-label">Hiệu ứng con trỏ</label>
                      <select name="status_cursor" class="settings-select" required>
                        <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_cursor') == 1 ? 'selected' : ''; ?> value="1">Bật</option>
                        <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_cursor') == 0 ? 'selected' : ''; ?> value="0">Tắt</option>
                      </select>
                      <div class="settings-help">Vui lòng thêm ảnh con trỏ ở mục giao diện rồi sử dụng.</div>
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-save text-white">
                  <i class="fa fa-save"></i> LƯU NGAY
                </button>
              </form>
            </div>

            <!-- MOMO -->
            <div role="tabpanel" class="tab-pane" id="profile_animation_1">
              <div class="auto-wrap">
                <form action="" method="POST" class="js-settings-form" enctype="multipart/form-data">
                  <input type="hidden" name="SaveSettings" value="1">
                  <div class="auto-card">
                    <div class="auto-head">
                      <div>
                        <h4 class="auto-title">
                          <span style="width:10px;height:10px;border-radius:50%;background:linear-gradient(135deg,#22c55e,#3b82f6);box-shadow:0 0 0 4px rgba(34,197,94,.12);display:inline-block"></span>
                          MOMO AUTO
                        </h4>
                        <p class="auto-desc">Key: <b>status_momo</b>, <b>token_momo</b>.</p>
                      </div>
                      <span class="auto-badge">AUTO / WALLET</span>
                    </div>

                    <div class="auto-grid">
                      <div class="auto-col-6">
                        <label class="auto-label">Trạng thái</label>
                        <select name="status_momo" class="auto-select" required>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_momo') == 1 ? 'selected' : '' ?> value="1">Bật</option>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_momo') == 0 ? 'selected' : '' ?> value="0">Tắt</option>
                        </select>
                      </div>

                      <div class="auto-col-6">
                        <label class="auto-label">Token MoMo</label>
                        <input name="token_momo" type="text" class="auto-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('token_momo') ?>">
                      </div>
                    </div>

                    <div class="auto-actions">
                      <button type="submit" class="btn-auto-save">
                        <i class="fa fa-save"></i> LƯU MOMO
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- MBBANK -->
            <div role="tabpanel" class="tab-pane" id="messages_animation_1">
              <div class="auto-wrap">
                <form action="" method="POST" class="js-settings-form" enctype="multipart/form-data">
                  <input type="hidden" name="SaveSettings" value="1">
                  <div class="auto-card">
                    <div class="auto-head">
                      <div>
                        <h4 class="auto-title">
                          <span style="width:10px;height:10px;border-radius:50%;background:linear-gradient(135deg,#f59e0b,#3b82f6);box-shadow:0 0 0 4px rgba(245,158,11,.12);display:inline-block"></span>
                          MBBANK AUTO
                        </h4>
                        <p class="auto-desc">Key: <b>status_mbbank</b>, <b>token_mbbank</b>.</p>
                      </div>
                      <span class="auto-badge">API.SIEUTHICODE.NET</span>
                    </div>

                    <div class="auto-grid">
                      <div class="auto-col-6">
                        <label class="auto-label">Trạng thái</label>
                        <select name="status_mbbank" class="auto-select" required>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_mbbank') == 1 ? 'selected' : '' ?> value="1">Bật</option>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_mbbank') == 0 ? 'selected' : '' ?> value="0">Tắt</option>
                        </select>
                      </div>

                      <div class="auto-col-6">
                        <label class="auto-label">Token MBBank</label>
                        <input name="token_mbbank" type="text" class="auto-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('token_mbbank') ?>">
                      </div>
                    </div>

                    <div class="auto-actions">
                      <button type="submit" class="btn-auto-save">
                        <i class="fa fa-save"></i> LƯU MBBANK
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- ZALOPAY -->
            <div role="tabpanel" class="tab-pane" id="settings_zalopay">
              <div class="auto-wrap">
                <form action="" method="POST" class="js-settings-form" enctype="multipart/form-data">
                  <input type="hidden" name="SaveSettings" value="1">
                  <div class="auto-card">
                    <div class="auto-head">
                      <div>
                        <h4 class="auto-title">
                          <span style="width:10px;height:10px;border-radius:50%;background:linear-gradient(135deg,#22c55e,#06b6d4);box-shadow:0 0 0 4px rgba(6,182,212,.12);display:inline-block"></span>
                          ZALOPAY AUTO
                        </h4>
                        <p class="auto-desc">Key: <b>status_zalopay</b>, <b>token_zalopay</b>.</p>
                      </div>
                      <span class="auto-badge">E-WALLET</span>
                    </div>

                    <div class="auto-grid">
                      <div class="auto-col-6">
                        <label class="auto-label">Trạng thái</label>
                        <select name="status_zalopay" class="auto-select" required>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_zalopay') == 1 ? 'selected' : '' ?> value="1">Bật</option>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_zalopay') == 0 ? 'selected' : '' ?> value="0">Tắt</option>
                        </select>
                      </div>

                      <div class="auto-col-6">
                        <label class="auto-label">Token ZaloPay</label>
                        <input name="token_zalopay" type="text" class="auto-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('token_zalopay') ?>">
                      </div>
                    </div>

                    <div class="auto-actions">
                      <button type="submit" class="btn-auto-save">
                        <i class="fa fa-save"></i> LƯU ZALOPAY
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- THESIEURE -->
            <div role="tabpanel" class="tab-pane" id="settings_thesieure">
              <div class="auto-wrap">
                <form action="" method="POST" class="js-settings-form" enctype="multipart/form-data">
                  <input type="hidden" name="SaveSettings" value="1">
                  <div class="auto-card">
                    <div class="auto-head">
                      <div>
                        <h4 class="auto-title">
                          <span style="width:10px;height:10px;border-radius:50%;background:linear-gradient(135deg,#a855f7,#3b82f6);box-shadow:0 0 0 4px rgba(168,85,247,.12);display:inline-block"></span>
                          THESIEURE AUTO
                        </h4>
                        <p class="auto-desc">Key: <b>status_tsr</b>, <b>token_tsr</b>.</p>
                      </div>
                      <span class="auto-badge">CARD / WALLET</span>
                    </div>

                    <div class="auto-grid">
                      <div class="auto-col-6">
                        <label class="auto-label">Trạng thái</label>
                        <select name="status_tsr" class="auto-select" required>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_tsr') == 1 ? 'selected' : '' ?> value="1">Bật</option>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_tsr') == 0 ? 'selected' : '' ?> value="0">Tắt</option>
                        </select>
                      </div>

                      <div class="auto-col-6">
                        <label class="auto-label">Token Thesieure</label>
                        <input name="token_tsr" type="text" class="auto-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('token_tsr') ?>">
                      </div>
                    </div>

                    <div class="auto-actions">
                      <button type="submit" class="btn-auto-save">
                        <i class="fa fa-save"></i> LƯU THESIEURE
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- VCB -->
            <div role="tabpanel" class="tab-pane" id="settings_vcb">
              <div class="auto-wrap">
                <form action="" method="POST" class="js-settings-form" enctype="multipart/form-data">
                  <input type="hidden" name="SaveSettings" value="1">
                  <div class="auto-card">
                    <div class="auto-head">
                      <div>
                        <h4 class="auto-title">
                          <span style="width:10px;height:10px;border-radius:50%;background:linear-gradient(135deg,#10b981,#22c55e);box-shadow:0 0 0 4px rgba(16,185,129,.12);display:inline-block"></span>
                          VIETCOMBANK AUTO
                        </h4>
                        <p class="auto-desc">Key: <b>status_vcb</b>, <b>token_vcb</b>.</p>
                      </div>
                      <span class="auto-badge">API.SIEUTHICODE.NET</span>
                    </div>

                    <div class="auto-grid">
                      <div class="auto-col-6">
                        <label class="auto-label">Trạng thái</label>
                        <select name="status_vcb" class="auto-select" required>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_vcb') == 1 ? 'selected' : '' ?> value="1">Bật</option>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_vcb') == 0 ? 'selected' : '' ?> value="0">Tắt</option>
                        </select>
                      </div>

                      <div class="auto-col-6">
                        <label class="auto-label">Token VCB</label>
                        <input name="token_vcb" type="text" class="auto-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('token_vcb') ?>">
                      </div>
                    </div>

                    <div class="auto-actions">
                      <button type="submit" class="btn-auto-save">
                        <i class="fa fa-save"></i> LƯU VCB
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- ACB -->
            <div role="tabpanel" class="tab-pane" id="settings_acb">
              <div class="auto-wrap">
                <form action="" method="POST" class="js-settings-form" enctype="multipart/form-data">
                  <input type="hidden" name="SaveSettings" value="1">
                  <div class="auto-card">
                    <div class="auto-head">
                      <div>
                        <h4 class="auto-title">
                          <span style="width:10px;height:10px;border-radius:50%;background:linear-gradient(135deg,#60a5fa,#a78bfa);box-shadow:0 0 0 4px rgba(96,165,250,.12);display:inline-block"></span>
                          ACB AUTO
                        </h4>
                        <p class="auto-desc">Key: <b>status_acb</b>, <b>token_acb</b>.</p>
                      </div>
                      <span class="auto-badge">API.SIEUTHICODE.NET</span>
                    </div>

                    <div class="auto-grid">
                      <div class="auto-col-6">
                        <label class="auto-label">Trạng thái</label>
                        <select name="status_acb" class="auto-select" required>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_acb') == 1 ? 'selected' : '' ?> value="1">Bật</option>
                          <option <?= $LOCNGUYEN_SIEUTHICODE->site('status_acb') == 0 ? 'selected' : '' ?> value="0">Tắt</option>
                        </select>
                      </div>

                      <div class="auto-col-6">
                        <label class="auto-label">Token ACB</label>
                        <input name="token_acb" type="text" class="auto-input" value="<?= $LOCNGUYEN_SIEUTHICODE->site('token_acb') ?>">
                      </div>
                    </div>

                    <div class="auto-actions">
                      <button type="submit" class="btn-auto-save">
                        <i class="fa fa-save"></i> LƯU ACB
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

<!-- =======================
     NẠP THẺ (UNIVERSAL) - FULL FIXED
======================= -->
<div role="tabpanel" class="tab-pane" id="settings_napthe">
  <div class="auto-wrap">
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="SaveSettings" value="1">

      <?php
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $defaultCallback = $scheme . '://' . $_SERVER['HTTP_HOST'] . '/api/card_callback.php';

        $callbackVal = $LOCNGUYEN_SIEUTHICODE->site('card_callback_url');
        if (!$callbackVal) $callbackVal = $defaultCallback;

        $apiType = $LOCNGUYEN_SIEUTHICODE->site('card_api_type');
        if (!$apiType) $apiType = 'chargingws';

        $map = $LOCNGUYEN_SIEUTHICODE->site('card_json_map');
        if (!$map) {
          $map = '{"request_id":"request_id","status":"status","amount":"amount","received":"received","message":"message"}';
        }
      ?>

      <div class="auto-card">
        <div class="auto-head">
          <div>
            <h4 class="auto-title">
              🔥 NẠP THẺ AUTO (UNIVERSAL)
            </h4>
            <p class="auto-desc">
              Hỗ trợ ChargingWS / JSON MD5 / HMAC256
            </p>
          </div>
          <span class="auto-badge">CARD API</span>
        </div>

        <div class="auto-grid">

          <div class="auto-col-6">
            <label>Trạng thái</label>
            <select name="status_card" class="auto-select">
              <option value="1" <?= $LOCNGUYEN_SIEUTHICODE->site('status_card') == 1 ? 'selected' : '' ?>>Bật</option>
              <option value="0" <?= $LOCNGUYEN_SIEUTHICODE->site('status_card') == 0 ? 'selected' : '' ?>>Tắt</option>
            </select>
          </div>

          <div class="auto-col-6">
            <label>Loại API</label>
            <select name="card_api_type" class="auto-select">
              <option value="chargingws" <?= $apiType=='chargingws'?'selected':''; ?>>ChargingWS / TSR</option>
              <option value="json_md5" <?= $apiType=='json_md5'?'selected':''; ?>>JSON + MD5</option>
              <option value="json_hmac256" <?= $apiType=='json_hmac256'?'selected':''; ?>>JSON + HMAC256</option>
            </select>
          </div>

          <div class="auto-col-6">
            <label>Chiết khấu (%)</label>
            <input name="ck_card" type="number" step="0.01"
                   value="<?= $LOCNGUYEN_SIEUTHICODE->site('ck_card') ?>"
                   class="auto-input">
          </div>

          <div class="auto-col-12">
            <label>Partner Link (API URL)</label>
            <input name="card_partner_link"
                   value="<?= $LOCNGUYEN_SIEUTHICODE->site('card_partner_link') ?>"
                   class="auto-input">
          </div>

          <div class="auto-col-6">
            <label>Partner ID</label>
            <input name="partner_id_card"
                   value="<?= $LOCNGUYEN_SIEUTHICODE->site('partner_id_card') ?>"
                   class="auto-input">
          </div>

          <div class="auto-col-6">
            <label>Partner Key</label>
            <input name="partner_key_card"
                   value="<?= $LOCNGUYEN_SIEUTHICODE->site('partner_key_card') ?>"
                   class="auto-input">
          </div>

          <div class="auto-col-12">
            <label>Link Callback</label>
            <input name="card_callback_url"
                   id="card_callback_url"
                   value="<?= $callbackVal ?>"
                   class="auto-input">
            <small style="color:#999">
              Callback mặc định: <b><?= $defaultCallback ?></b>
            </small>
          </div>

          <div class="auto-col-12">
            <label>JSON Map (tuỳ chọn)</label>
            <input name="card_json_map"
                   value="<?= htmlspecialchars($map, ENT_QUOTES) ?>"
                   class="auto-input">
          </div>

          <div class="auto-col-12" style="margin-top:15px;">
            <button type="button" onclick="copyCardCallback()" class="btn btn-warning">
              COPY CALLBACK
            </button>
          </div>

        </div>

        <div style="margin-top:20px;">
          <button type="submit" class="btn btn-primary">
            LƯU CẤU HÌNH
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function copyCardCallback(){
  var el = document.getElementById('card_callback_url');
  el.select();
  document.execCommand('copy');
  alert('Đã copy callback!');
}
</script>

      <!-- TEXTAREAS / NOTIFICATIONS -->
      <div class="card settings-card">
        <div class="settings-head">
          <div>
            <h3 class="settings-title">Thông báo & Nội dung</h3>
            <p class="settings-sub">Soạn nội dung hệ thống, popup, ghi chú nạp bank/thẻ…</p>
          </div>
        </div>

        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data" class="js-settings-form">
            <input type="hidden" name="SaveSettings" value="1">
            <div class="form-section">
              <div class="form-section-title"><span class="dot"></span>Nội dung hiển thị</div>

              <div class="row">
                <div class="col-12 mb-3">
                  <label class="settings-label">Thông báo nổi</label>
                  <textarea id="noti_popup" name="noti_popup" class="settings-textarea"><?= $LOCNGUYEN_SIEUTHICODE->site('noti_popup') ?></textarea>
                </div>

                <div class="col-12 mb-3">
                  <label class="settings-label">Thông báo toàn hệ thống</label>
                  <textarea id="thongbao" name="thongbao" class="settings-textarea"><?= $LOCNGUYEN_SIEUTHICODE->site('thongbao') ?></textarea>
                </div>

                <div class="col-12 mb-3">
                  <label class="settings-label">Ghi chú nạp bank</label>
                  <textarea id="notice_napbank" name="notice_napbank" class="settings-textarea"><?= $LOCNGUYEN_SIEUTHICODE->site('notice_napbank') ?></textarea>
                </div>

                <div class="col-12 mb-3">
                  <label class="settings-label">Ghi chú nạp thẻ</label>
                  <textarea id="notice_napthe" name="notice_napthe" class="settings-textarea"><?= $LOCNGUYEN_SIEUTHICODE->site('notice_napthe') ?></textarea>
                </div>

                <div class="col-12 mb-3">
                  <label class="settings-label">Nội dung (Home)</label>
                  <textarea id="noti_home" name="noti_home" class="settings-textarea"><?= $LOCNGUYEN_SIEUTHICODE->site('noti_home') ?></textarea>
                </div>
              </div>

              <button type="submit" class="btn btn-save text-white">
                <i class="fa fa-save"></i> LƯU NGAY
              </button>
            </div>
          </form>
        </div>
      </div>

    </div><!-- /col -->
  </div><!-- /row -->
</div>

<script>
  // CKEditor giữ nguyên như bạn đang dùng
  if (typeof CKEDITOR !== "undefined") {
    CKEDITOR.replace("thongbao");
    CKEDITOR.replace("notice_napbank");
    CKEDITOR.replace("notice_napthe");
    CKEDITOR.replace("noti_popup");
    // CKEDITOR.replace("noti_home");
  }

  // UX: submit disable nút + update CKEditor
  document.querySelectorAll('.js-settings-form').forEach(form => {
    form.addEventListener('submit', function() {
      if (typeof CKEDITOR !== "undefined") {
        for (var instanceName in CKEDITOR.instances) {
          CKEDITOR.instances[instanceName].updateElement();
        }
      }
      const btn = this.querySelector('button[type="submit"]');
      if (btn) {
        btn.disabled = true;
        btn.style.opacity = "0.85";
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> ĐANG LƯU...';
      }
    });
  });

  // Lưu tab đang mở
  function saveActiveTab(){
    const activePane = document.querySelector('.tab-content .tab-pane.active');
    if (!activePane) return;
    const form = activePane.querySelector('form.js-settings-form');
    if (!form) return;

    if (typeof CKEDITOR !== "undefined") {
      for (var instanceName in CKEDITOR.instances) {
        CKEDITOR.instances[instanceName].updateElement();
      }
    }
    form.submit();
  }

  // Copy callback
  function copyCardCallback(){
    const el = document.getElementById('card_callback_url');
    if (!el) return;
    el.focus();
    el.select();
    el.setSelectionRange(0, 99999);
    try { document.execCommand('copy'); } catch(e) {}
    alert('Đã copy Link callback!');
  }
</script>