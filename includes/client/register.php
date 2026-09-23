<div class="container mt20" style="margin-top: 80px;">
    <div class="box-home all">
        <section class="register-page">
            <div class="register-bg"></div>
            <div class="register-noise"></div>

            <div class="container">
                <div class="register-wrap">

                    <div class="register-card">
                        <div class="register-topline"></div>

                        <div class="register-header">
                            <div class="register-badge">
                                <span class="dot"></span>
                                <span>ĐĂNG KÝ</span>
                            </div>
                            <h3 class="register-title">Tạo tài khoản mới</h3>
                            <p class="register-sub">Điền thông tin bên dưới để đăng ký tài khoản.</p>
                        </div>

                        <div class="register-body">
                            <form class="register-form" id="register_sieuthicode">
                                <label class="f-label">Địa chỉ email</label>
                                <div class="f-input">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" name="email" placeholder="VD: abc@gmail.com" required>
                                </div>

                                <label class="f-label">Tài khoản đăng nhập</label>
                                <div class="f-input">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name="user" placeholder="VD: tranhaodev" required>
                                </div>

                                <label class="f-label">Mật khẩu</label>
                                <div class="f-input">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="pass" placeholder="Nhập mật khẩu" required>
                                </div>

                                <button class="btn-register-main" type="submit">
                                    <i class="fa fa-user-plus"></i> TẠO TÀI KHOẢN
                                </button>

                                <div class="sep">
                                    <span></span><b>đã có tài khoản?</b><span></span>
                                </div>

                                <button class="btn-login" type="button" onclick="location.href='index.php?action=login'">
                                    <i class="fa fa-sign-in"></i> ĐĂNG NHẬP
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="register-side">
                        <div class="side-card">
                            <div class="side-title">Lưu ý</div>
                            <ul class="side-list">
                                <li>Dùng email thật để nhận thông báo và khôi phục tài khoản.</li>
                                <li>Nên đặt mật khẩu mạnh (chữ hoa, chữ thường, số).</li>
                                <li>Không chia sẻ tài khoản/mật khẩu cho người khác.</li>
                            </ul>
                        </div>

                        <div class="side-card mini">
                            <div class="side-mini">
                                <i class="fa fa-shield"></i>
                                <div>
                                    <div class="side-mini-title">Bảo mật</div>
                                    <div class="side-mini-sub">UI tối ưu rõ chữ, không thay đổi logic xử lý.</div>
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
  --border:rgba(255,255,255,.12);
  --text:rgba(255,255,255,.92);
  --muted:rgba(255,255,255,.70);
  --shadow:0 18px 70px rgba(0,0,0,.55);
  --radius:18px;
  --primary:#3b82f6;
  --primary2:#2563eb;
}

.register-page{
  position:relative;
  padding: 10px 0 30px;
  color: var(--text);
}
.register-bg{
  position:absolute; inset:-40px 0 auto 0;
  height: 520px;
  background:
    radial-gradient(900px 320px at 18% 10%, rgba(59,130,246,.22), transparent 55%),
    radial-gradient(700px 260px at 82% 0%, rgba(34,197,94,.14), transparent 55%),
    linear-gradient(180deg, var(--bg1), transparent 70%);
  pointer-events:none;
}
.register-noise{
  position:absolute; inset:-40px 0 auto 0;
  height: 520px;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='140' height='140' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E");
  opacity:.22;
  mix-blend-mode: overlay;
  pointer-events:none;
}

.register-wrap{
  position:relative;
  display:grid;
  grid-template-columns: 1fr;
  gap: 16px;
  align-items:start;
  max-width: 1040px;
  margin: 0 auto;
}
@media (min-width: 992px){
  .register-wrap{ grid-template-columns: 1.15fr .85fr; gap: 18px; }
}

.register-card{
  border-radius: var(--radius);
  border:1px solid var(--border);
  background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.05));
  box-shadow: var(--shadow);
  backdrop-filter: blur(12px);
  overflow:hidden;
}
.register-topline{
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--primary), rgba(34,197,94,.75), transparent);
  opacity:.95;
}

.register-header{ padding: 18px 18px 10px; }
@media (min-width: 992px){ .register-header{ padding: 22px 22px 10px; } }

.register-badge{
  display:inline-flex; align-items:center; gap:10px;
  padding: 8px 12px;
  border-radius: 999px;
  border:1px solid var(--border);
  background: rgba(255,255,255,.06);
}
.register-badge .dot{
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

.register-title{
  margin: 12px 0 6px;
  font-weight: 900;
  letter-spacing:.2px;
  line-height:1.12;
  font-size: clamp(20px, 2.1vw, 30px);
}
.register-sub{
  margin:0;
  color: var(--muted);
  line-height:1.7;
}

.register-body{ padding: 10px 18px 18px; }
@media (min-width: 992px){ .register-body{ padding: 10px 22px 22px; } }

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

.btn-register-main{
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
.btn-register-main:hover{ filter: brightness(1.06); transform: translateY(-1px); }
.btn-register-main:active{ transform: translateY(0); }

.sep{
  display:flex; align-items:center; gap:10px;
  margin: 14px 0 12px;
  color: rgba(255,255,255,.75);
  font-weight: 900;
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
  color: rgba(255,255,255,.92);
  background: rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.14);
  transition: transform .15s ease, border-color .15s ease, background .15s ease;
}
.btn-login:hover{
  transform: translateY(-1px);
  border-color: rgba(59,130,246,.28);
  background: rgba(255,255,255,.08);
}

.register-side .side-card{
  border-radius: var(--radius);
  border:1px solid var(--border);
  background: rgba(255,255,255,.05);
  box-shadow: var(--shadow);
  backdrop-filter: blur(10px);
  padding: 16px;
}
.register-side .side-card.mini{ padding: 14px 16px; }

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

<script src="dist/js/sieuthicode.js?v=<?=time()?>"></script>