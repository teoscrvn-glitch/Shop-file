<?php 
CheckLogin(); 
?>

<style>
:root{
    --bg:#000;
    --bg2:#050505;
    --card: rgba(255,255,255,.06);
    --card2: rgba(255,255,255,.04);
    --border: rgba(255,255,255,.12);
    --text: rgba(255,255,255,.92);
    --muted: rgba(255,255,255,.65);
    --shadow: 0 22px 80px rgba(0,0,0,.75);
    --radius: 20px;
    --radius2: 14px;
    --primary:#3b82f6;
    --primary2:#2563eb;
    --good:#22c55e;
    --warn:#f59e0b;
    --focus: 0 0 0 4px rgba(59,130,246,.22);
}

.account-wrap{
    margin-top: 80px;
    padding-bottom: 22px;
}

.account-hero{
    border-radius: 22px;
    border: 1px solid rgba(255,255,255,.08);
    background:
        radial-gradient(1200px 420px at 15% -10%, rgba(59,130,246,.18), transparent 55%),
        radial-gradient(900px 380px at 90% 0%, rgba(34,197,94,.10), transparent 55%),
        linear-gradient(180deg, var(--bg), var(--bg2));
    box-shadow: var(--shadow);
    overflow: hidden;
    position: relative;
}

.account-hero::before{
    content:"";
    position:absolute; inset:0;
    background: radial-gradient(circle at 1px 1px, rgba(255,255,255,.07) 1px, transparent 0);
    background-size: 14px 14px;
    opacity: .35;
    pointer-events:none;
}

.account-hero__inner{
    position: relative;
    padding: 18px 18px 16px;
    display:flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    flex-wrap: wrap;
}

.account-title{
    margin: 0;
    font-size: 20px;
    font-weight: 900;
    letter-spacing: .2px;
    color: var(--text);
}

.account-sub{
    margin: 6px 0 0;
    font-size: 13px;
    line-height: 1.5;
    color: var(--muted);
    max-width: 720px;
}

.account-badge{
    display:inline-flex;
    align-items:center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 999px;
    border: 1px solid var(--border);
    background: rgba(0,0,0,.25);
    color: rgba(255,255,255,.88);
    font-weight: 900;
    font-size: 12px;
    white-space: nowrap;
}
.account-dot{
    width: 8px; height: 8px; border-radius: 50%;
    background: var(--good);
    box-shadow: 0 0 0 5px rgba(34,197,94,.16);
}

.account-card{
    margin-top: 16px;
    border-radius: 22px;
    border: 1px solid var(--border);
    background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    box-shadow: var(--shadow);
    overflow: hidden;
}

.account-card .card-body{
    padding: 16px;
}

@media (max-width: 575px){
    .account-hero__inner{ padding: 14px; }
    .account-card .card-body{ padding: 12px; }
}

/* Grid */
.account-grid{
    display:grid;
    grid-template-columns: 1fr;
    gap: 12px;
}
@media (min-width: 768px){
    .account-grid{ grid-template-columns: 1fr 1fr; }
}
@media (min-width: 1200px){
    .account-grid{ grid-template-columns: 1fr 1fr 1fr; }
}

/* Field */
.account-field{
    border: 1px solid rgba(255,255,255,.10);
    background: rgba(0,0,0,.32);
    border-radius: var(--radius2);
    padding: 12px;
    transition: .15s ease;
}
.account-field:hover{
    border-color: rgba(255,255,255,.16);
    transform: translateY(-1px);
}
.account-label{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 10px;
    margin: 0 0 8px;
    font-size: 13px;
    font-weight: 900;
    color: rgba(255,255,255,.88);
}
.account-chip{
    font-size: 12px;
    font-weight: 900;
    padding: 4px 10px;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,.12);
    color: rgba(255,255,255,.78);
    background: rgba(255,255,255,.04);
}
.account-chip.readonly{
    border-color: rgba(245,158,11,.32);
    color: rgba(245,158,11,.95);
    background: rgba(245,158,11,.08);
}
.account-chip.edit{
    border-color: rgba(59,130,246,.32);
    color: rgba(59,130,246,.95);
    background: rgba(59,130,246,.08);
}

/* Inputs */
.account-field .form-control{
    width:100%;
    border-radius: 12px !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    background: #060606 !important;
    color: var(--text) !important;
    padding: 11px 12px !important;
    height: auto !important;
    box-shadow: none !important;
    outline: none !important;
}
.account-field .form-control::placeholder{ color: rgba(255,255,255,.40); }
.account-field .form-control:focus{
    border-color: rgba(59,130,246,.65) !important;
    box-shadow: var(--focus) !important;
}
.account-field .form-control[readonly]{
    opacity: .92;
    background: #050505 !important;
}

/* Help text */
.account-help{
    margin-top: 8px;
    font-size: 12px;
    color: var(--muted);
    line-height: 1.5;
}

/* Actions */
.account-actions{
    display:flex;
    align-items:center;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 10px;
    flex-wrap: wrap;
}
.account-actions .btn{
    border-radius: 14px !important;
    padding: 10px 14px !important;
    font-weight: 900 !important;
    letter-spacing: .2px;
    border: 1px solid rgba(255,255,255,.12) !important;
}
.account-actions .btn-info{
    background: linear-gradient(180deg, var(--primary), var(--primary2)) !important;
    border-color: rgba(59,130,246,.55) !important;
    box-shadow: 0 14px 40px rgba(37,99,235,.22);
    color: #fff !important;
}
.account-actions .btn-info:hover{ filter: brightness(1.06); transform: translateY(-1px); }

@media (max-width: 575px){
    .account-actions{ justify-content: stretch; }
    .account-actions .btn{ width: 100%; }
}
</style>

<div class="container account-wrap">
    <div class="account-hero">
        <div class="account-hero__inner">
            <div>
                <h3 class="account-title">THÔNG TIN TÀI KHOẢN</h3>
                <p class="account-sub">
                    Cập nhật email / đổi mật khẩu. Thông tin hệ thống (IP, ngày tham gia, số dư...) chỉ xem.
                </p>
            </div>
            <div class="account-badge">
                <span class="account-dot"></span>
                <span>ACCOUNT</span>
            </div>
        </div>
    </div>

    <form id="update_info" class="mt-3">
        <div class="account-card card">
            <div class="card-body">
                <div class="account-grid">

                    <div class="account-field">
                        <div class="account-label">
                            <span>Tài khoản</span>
                            <span class="account-chip readonly">Readonly</span>
                        </div>
                        <input type="text" class="form-control" value="<?= $getUser['username'] ?>" readonly required>
                    </div>

                    <div class="account-field">
                        <div class="account-label">
                            <span>Email</span>
                            <span class="account-chip edit">Chỉnh sửa</span>
                        </div>
                        <input type="text" name="email" class="form-control" value="<?= $getUser['email'] ?>" required placeholder="Nhập email...">
                    </div>

                    <div class="account-field">
                        <div class="account-label">
                            <span>IP</span>
                            <span class="account-chip readonly">Readonly</span>
                        </div>
                        <input type="text" class="form-control" value="<?= $getUser['ip'] ?>" readonly required>
                    </div>

                    <div class="account-field">
                        <div class="account-label">
                            <span>Ngày tham gia</span>
                            <span class="account-chip readonly">Readonly</span>
                        </div>
                        <input type="text" class="form-control" value="<?= $getUser['create_date'] ?>" readonly required>
                    </div>

                    <div class="account-field">
                        <div class="account-label">
                            <span>Hoạt động gần đây</span>
                            <span class="account-chip readonly">Readonly</span>
                        </div>
                        <input type="text" class="form-control" value="<?= $getUser['update_date'] ?>" readonly required>
                    </div>

                    <div class="account-field">
                        <div class="account-label">
                            <span>Số dư</span>
                            <span class="account-chip readonly">Readonly</span>
                        </div>
                        <input type="text" class="form-control" value="<?= format_cash($getUser['coin']) ?>" readonly required>
                    </div>

                    <div class="account-field">
                        <div class="account-label">
                            <span>Tổng nạp</span>
                            <span class="account-chip readonly">Readonly</span>
                        </div>
                        <input type="text" class="form-control" value="<?= format_cash($getUser['total_coin']) ?>" readonly required>
                    </div>

                    <div class="account-field" style="grid-column: 1 / -1;">
                        <div class="account-label">
                            <span>Mật khẩu mới</span>
                            <span class="account-chip edit">Tùy chọn</span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới (để trống nếu không đổi)">
                        <div class="account-help">
                            Nhập mật khẩu cần thay đổi, hệ thống sẽ tự động mã hoá (để trống nếu không muốn thay đổi).
                        </div>
                    </div>

                </div>

                <div class="account-actions">
                    <button type="submit" name="updateInfo" class="btn btn-info">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="dist/js/sieuthicode.js?v=<?=time()?>"></script>