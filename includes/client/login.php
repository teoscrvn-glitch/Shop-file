<div class="container mb20" style="margin-top: 80px;">
    <div class="box-home all">
        <section class="login-page">
            <div class="login-bg"></div>
            <div class="login-noise"></div>

            <div class="container">
                <div class="login-wrap">

                    <div class="login-card">
                        <div class="login-topline"></div>

                        <div class="login-header">
                            <div class="login-badge">
                                <span class="dot"></span>
                                <span>ĐĂNG NHẬP</span>
                            </div>
                            <h3 class="login-title">Chào mừng quay lại</h3>
                            <p class="login-sub">Đăng nhập để tiếp tục sử dụng dịch vụ.</p>
                        </div>

                        <div class="login-body">
                            <form class="login-form" id="login_sieuthicode">
                                <label class="f-label">Tài khoản đăng nhập</label>
                                <div class="f-input">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name="user" placeholder="Nhập tài khoản" required>
                                </div>

                                <label class="f-label">Mật khẩu</label>
                                <div class="f-input">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="pass" placeholder="Nhập mật khẩu" required>
                                </div>

                                <?php if ($LOCNGUYEN_SIEUTHICODE->site('status_captcha') == 1) : ?>
                                    <div class="captcha-box">
                                        <center>
                                            <div class="g-recaptcha" data-sitekey="<?= $LOCNGUYEN_SIEUTHICODE->site('site_key') ?>"></div>
                                        </center>
                                    </div>
                                <?php endif ?>

                                <button class="btn-login-main" type="submit">
                                    <i class="fa fa-sign-in"></i> ĐĂNG NHẬP
                                </button>

                                <div class="login-actions">
                                    <a class="btn-create-acc" href="index.php?action=register" title="Đăng ký" rel="nofollow">
                                        <i class="fa fa-user-plus"></i> TẠO TÀI KHOẢN
                                    </a>
                                    <a class="btn-forgot" id="hd-lnk-forget" href="index.php?action=forgot">
                                        <i class="fa fa-key"></i> LẤY LẠI MẬT KHẨU?
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="login-side">
                        <div class="side-card">
                            <div class="side-title">Gợi ý bảo mật</div>
                            <ul class="side-list">
                                <li>Không chia sẻ mật khẩu cho bất kỳ ai.</li>
                                <li>Hãy dùng mật khẩu mạnh và đổi định kỳ.</li>
                                <li>Nếu đăng nhập lỗi, thử tải lại trang và làm lại captcha.</li>
                            </ul>
                        </div>

                        <div class="side-card mini">
                            <div class="side-mini">
                                <i class="fa fa-shield"></i>
                                <div>
                                    <div class="side-mini-title">An toàn</div>
                                    <div class="side-mini-sub">UI tối ưu rõ chữ, không đổi logic xử lý.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>

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
}

/* page background */
.login-page{
  position:relative;
  padding: 10px 0 30px;
  color: var(--text);
}
.login-bg{
  position:absolute; inset:-40px 0 auto 0;
  height: 520px;
  background:
    radial-gradient(900px 320px at 18% 10%, rgba(59,130,246,.22), transparent 55%),
    radial-gradient(700px 260px at 82% 0%, rgba(34,197,94,.14), transparent 55%),
    linear-gradient(180deg, var(--bg1), transparent 70%);
  pointer-events:none;
}
.login-noise{
  position:absolute; inset:-40px 0 auto 0;
  height: 520px;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='140' height='140' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E");
  opacity:.22;
  mix-blend-mode: overlay;
  pointer-events:none;
}

/* layout */
.login-wrap{
  position:relative;
  display:grid;
  grid-template-columns: 1fr;
  gap: 16px;
  align-items:start;
  max-width: 1040px;
  margin: 0 auto;
}
@media (min-width: 992px){
  .login-wrap{ grid-template-columns: 1.15fr .85fr; gap: 18px; }
}

/* main card */
.login-card{
  border-radius: var(--radius);
  border:1px solid var(--border);
  background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.05));
  box-shadow: var(--shadow);
  backdrop-filter: blur(12px);
  overflow:hidden;
}
.login-topline{
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--primary), rgba(34,197,94,.75), transparent);
  opacity:.95;
}

.login-header{ padding: 18px 18px 10px; }
@media (min-width: 992px){ .login-header{ padding: 22px 22px 10px; } }

.login-badge{
  display:inline-flex; align-items:center; gap:10px;
  padding: 8px 12px;
  border-radius: 999px;
  border:1px solid var(--border);
  background: rgba(255,255,255,.06);
}
.login-badge .dot{
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

.login-title{
  margin: 12px 0 6px;
  font-weight: 900;
  letter-spacing:.2px;
  line-height:1.12;
  font-size: clamp(20px, 2.1vw, 30px);
}
.login-sub{
  margin:0;
  color: var(--muted);
  line-height:1.7;
}

.login-body{ padding: 10px 18px 18px; }
@media (min-width: 992px){ .login-body{ padding: 10px 22px 22px; } }

.login-form{ width:100%; }

/* inputs */
.f-label{
  display:block;
  margin: 10px 0 8px;
  font-weight: 800;
  color: rgba(255,255,255,.88);
  font-size: 13px;
}
.f-input{
  display:flex; align-items:center; gap:10px;
  padding: 12px 12px;
  border-radius: 14px;
  border:1px solid rgba(255,255,255,.12);
  background: rgba(0,0,0,.22);
}
.f-input i{ opacity:.9; }
.f-input input{
  width:100%;
  border:0 !important;
  outline:none !important;
  background: transparent !important;
  color: rgba(255,255,255,.92) !important;
  font-weight: 800;
}
.f-input input::placeholder{ color: rgba(255,255,255,.55); }

.captcha-box{
  margin-top: 14px;
  padding: 12px;
  border-radius: 14px;
  border:1px solid rgba(255,255,255,.12);
  background: rgba(255,255,255,.04);
  overflow:auto;
}

/* main button */
.btn-login-main{
  margin-top: 14px;
  width:100%;
  border:0;
  border-radius: 14px;
  padding: 12px 14px;
  font-weight: 900;
  letter-spacing:.3px;
  color:#fff;
  background: linear-gradient(135deg, var(--primary), var(--primary2));
  box-shadow: 0 14px 40px rgba(37,99,235,.25);
  transition: transform .15s ease, filter .15s ease;
}
.btn-login-main:hover{ filter: brightness(1.06); transform: translateY(-1px); }
.btn-login-main:active{ transform: translateY(0); }

/* actions */
.login-actions{
  display:grid;
  grid-template-columns: 1fr;
  gap: 10px;
  margin-top: 12px;
}
@media (min-width: 576px){
  .login-actions{ grid-template-columns: 1fr 1fr; }
}
.btn-create-acc,
.btn-forgot{
  display:flex;
  align-items:center;
  justify-content:center;
  gap:10px;
  width:100%;
  border-radius: 14px;
  padding: 11px 14px;
  font-weight: 900;
  text-decoration:none !important;
  color: rgba(255,255,255,.92) !important;
  background: rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.14);
  transition: transform .15s ease, border-color .15s ease, background .15s ease;
}
.btn-create-acc:hover,
.btn-forgot:hover{
  transform: translateY(-1px);
  border-color: rgba(59,130,246,.28);
  background: rgba(255,255,255,.08);
}

/* side cards */
.login-side .side-card{
  border-radius: var(--radius);
  border:1px solid var(--border);
  background: rgba(255,255,255,.05);
  box-shadow: var(--shadow);
  backdrop-filter: blur(10px);
  padding: 16px;
}
.login-side .side-card.mini{ padding: 14px 16px; }

.side-title{
  font-weight: 900;
  margin-bottom: 10px;
  letter-spacing:.2px;
}
.side-list{
  margin:0;
  padding-left: 18px;
  color: rgba(255,255,255,.84);
  line-height: 1.8;
}
.side-list li{ margin: 6px 0; }

.side-mini{
  display:flex; align-items:center; gap:12px;
  color: rgba(255,255,255,.9);
}
.side-mini i{
  width:38px; height:38px;
  display:flex; align-items:center; justify-content:center;
  border-radius: 12px;
  background: rgba(59,130,246,.16);
  border:1px solid rgba(59,130,246,.22);
}
.side-mini-title{ font-weight: 900; }
.side-mini-sub{ color: var(--muted); font-size: 13px; margin-top: 2px; }
</style>

<script src="dist/js/sieuthicode.js?v=<?= time() ?>"></script>