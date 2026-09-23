<div class="container mb20" style="margin-top: 80px;">
    <div class="box-home all">
        <section class="forgot-page">
            <div class="forgot-bg"></div>
            <div class="forgot-noise"></div>

            <div class="container">
                <div class="forgot-wrap">
                    <div class="forgot-card">
                        <div class="forgot-topline"></div>

                        <div class="forgot-header">
                            <div class="forgot-badge">
                                <span class="dot"></span>
                                <span>LẤY LẠI MẬT KHẨU</span>
                            </div>
                            <h3 class="forgot-title">Khôi phục tài khoản</h3>
                            <p class="forgot-sub">Nhập email đăng ký để nhận hướng dẫn đặt lại mật khẩu.</p>
                        </div>

                        <div class="forgot-body">
                            <form class="forgot-form" id="forgot_sieuthicode">
                                <label class="f-label">Email khôi phục</label>
                                <div class="f-input">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" name="email" placeholder="VD: abc@gmail.com" required>
                                </div>

                                <?php if ($LOCNGUYEN_SIEUTHICODE->site('status_captcha') == 1) : ?>
                                    <div class="captcha-box">
                                        <center>
                                            <div class="g-recaptcha" data-sitekey="<?= $LOCNGUYEN_SIEUTHICODE->site('site_key') ?>"></div>
                                        </center>
                                    </div>
                                <?php endif ?>

                                <button class="btn-forgot" type="submit">
                                    <i class="fa fa-paper-plane"></i> XÁC NHẬN
                                </button>

                                <div class="sep">
                                    <span></span>
                                    <b>hoặc</b>
                                    <span></span>
                                </div>

                                <a class="btn-login" href="index.php?action=login" title="Đăng Nhập" rel="nofollow">
                                    <i class="fa fa-sign-in"></i> ĐĂNG NHẬP
                                </a>
                            </form>
                        </div>
                    </div>

                    <div class="forgot-side">
                        <div class="side-card">
                            <div class="side-title">Mẹo nhanh</div>
                            <ul class="side-list">
                                <li>Kiểm tra <b>Spam / Quảng cáo</b> nếu chưa thấy email.</li>
                                <li>Email khôi phục phải đúng email đăng ký tài khoản.</li>
                                <li>Nếu gặp lỗi, hãy thử tải lại trang và làm lại captcha.</li>
                            </ul>
                        </div>

                        <div class="side-card mini">
                            <div class="side-mini">
                                <i class="fa fa-shield"></i>
                                <div>
                                    <div class="side-mini-title">Bảo mật</div>
                                    <div class="side-mini-sub">Form được tối ưu UI, không đổi logic xử lý.</div>
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

.forgot-page{
  position:relative;
  padding: 10px 0 30px;
  color: var(--text);
}
.forgot-bg{
  position:absolute; inset:-40px 0 auto 0;
  height: 520px;
  background:
    radial-gradient(900px 320px at 18% 10%, rgba(59,130,246,.22), transparent 55%),
    radial-gradient(700px 260px at 82% 0%, rgba(34,197,94,.14), transparent 55%),
    linear-gradient(180deg, var(--bg1), transparent 70%);
  pointer-events:none;
}
.forgot-noise{
  position:absolute; inset:-40px 0 auto 0;
  height: 520px;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='140' height='140' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E");
  opacity:.22;
  mix-blend-mode: overlay;
  pointer-events:none;
}

.forgot-wrap{
  position:relative;
  display:grid;
  grid-template-columns: 1fr;
  gap: 16px;
  align-items:start;
  max-width: 1040px;
  margin: 0 auto;
}
@media (min-width: 992px){
  .forgot-wrap{ grid-template-columns: 1.15fr .85fr; gap: 18px; }
}

.forgot-card{
  border-radius: var(--radius);
  border:1px solid var(--border);
  background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.05));
  box-shadow: var(--shadow);
  backdrop-filter: blur(12px);
  overflow:hidden;
}
.forgot-topline{
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--primary), rgba(34,197,94,.75), transparent);
  opacity:.95;
}

.forgot-header{ padding: 18px 18px 10px; }
@media (min-width: 992px){ .forgot-header{ padding: 22px 22px 10px; } }

.forgot-badge{
  display:inline-flex; align-items:center; gap:10px;
  padding: 8px 12px;
  border-radius: 999px;
  border:1px solid var(--border);
  background: rgba(255,255,255,.06);
}
.forgot-badge .dot{
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

.forgot-title{
  margin: 12px 0 6px;
  font-weight: 900;
  letter-spacing:.2px;
  line-height:1.12;
  font-size: clamp(20px, 2.1vw, 30px);
}
.forgot-sub{
  margin:0;
  color: var(--muted);
  line-height:1.7;
}

.forgot-body{ padding: 10px 18px 18px; }
@media (min-width: 992px){ .forgot-body{ padding: 10px 22px 22px; } }

.forgot-form{ width:100%; }

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
  font-weight: 700;
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

.btn-forgot{
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
.btn-forgot:hover{ filter: brightness(1.06); transform: translateY(-1px); }
.btn-forgot:active{ transform: translateY(0); }

.sep{
  display:flex; align-items:center; gap:10px;
  margin: 14px 0 12px;
  color: rgba(255,255,255,.75);
  font-weight: 800;
  font-size: 12px;
  text-transform: uppercase;
}
.sep span{
  height:1px;
  flex:1;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,.16), transparent);
}
.sep b{ opacity:.85; }

.btn-login{
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
.btn-login:hover{
  transform: translateY(-1px);
  border-color: rgba(59,130,246,.28);
  background: rgba(255,255,255,.08);
}

.forgot-side .side-card{
  border-radius: var(--radius);
  border:1px solid var(--border);
  background: rgba(255,255,255,.05);
  box-shadow: var(--shadow);
  backdrop-filter: blur(10px);
  padding: 16px;
}
.forgot-side .side-card.mini{ padding: 14px 16px; }
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