<?php
CheckLogin();
CheckAdmin();

$id = isset($_GET['id']) ? (int)xss($_GET['id']) : 0;
if ($id <= 0) {
    die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
}

$row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `id` = '{$id}' ");
if (!$row) {
    die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
}

/**
 * ✅ Helper: redirect lại đúng trang hiện tại (FIX LOAD LÂU do history.back().reload)
 * Không đổi chức năng: vẫn alert + quay lại trang edit user
 */
function _redirect_self($msg, $id) {
    $id = (int)$id;
    $msg = addslashes($msg);
    die('<script type="text/javascript">
        alert("'.$msg.'");
        window.location.href = "main.php?action=edit_users&id='.$id.'";
    </script>');
}

/**
 * =========================
 * POST HANDLERS (GIỮ NGUYÊN LOGIC)
 * =========================
 */
if (isset($_POST['updateUsers'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        _redirect_self("Đây là trang web demo bạn không thể thực hiện chức năng này !", $row['id']);
    }

    if (isset($_POST['email'])) {
        $isUpdate = $LOCNGUYEN_SIEUTHICODE->update("tbl_users", [
            'email'  => xss($_POST['email']),
            'role'   => xss($_POST['role']),
            'banned' => xss($_POST['banned'])
        ], " `id` = '" . $row['id'] . "' ");

        if ($isUpdate) {
            if (!empty($_POST['password'])) {
                $LOCNGUYEN_SIEUTHICODE->update("tbl_users", [
                    'password' => sha1(md5(xss($_POST['password'])))
                ], " `id` = '" . $row['id'] . "' ");
            }

            if (xss($_POST['role']) != $row['role']) {
                $LOCNGUYEN_SIEUTHICODE->insert("logs", [
                    'user_id'     => $getUser['id'],
                    'create_date' => gettime(),
                    'device'      => $_SERVER['HTTP_USER_AGENT'],
                    'ip'          => myip(),
                    'action'      => 'Thay đổi quyền Admin cho thành viên ' . $row['username'] . '[' . $row['id'] . '].'
                ]);
                $LOCNGUYEN_SIEUTHICODE->insert("logs", [
                    'user_id'     => $row['id'],
                    'create_date' => gettime(),
                    'action'      => 'Bạn được Admin ' . $getUser['username'] . ' thay đổi quyền Admin.'
                ]);
            }

            $LOCNGUYEN_SIEUTHICODE->insert("logs", [
                'user_id'     => $getUser['id'],
                'create_date' => gettime(),
                'device'      => $_SERVER['HTTP_USER_AGENT'],
                'ip'          => myip(),
                'action'      => 'Cập nhật thông tin thành viên ' . $row['username'] . '[' . $row['id'] . '].'
            ]);
            $LOCNGUYEN_SIEUTHICODE->insert("logs", [
                'user_id'    => $row['id'],
                'createdate' => gettime(),
                'action'     => 'Bạn được Admin thay đổi thông tin.'
            ]);

            _redirect_self("Cập nhật thông tin thành công", $row['id']);
        } else {
            _redirect_self("Không thể cập nhật (vui lòng thử lại)", $row['id']);
        }
    }
}

if (isset($_POST['cong_tien'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        _redirect_self("Đây là trang web demo bạn không thể thực hiện chức năng này !", $row['id']);
    }
    if ($_POST['amount'] <= 0) {
        _redirect_self("Số tiền không hợp lệ !", $row['id']);
    }

    $amount = xss($_POST['amount']);
    $reason = xss($_POST['reason']);
    PlusCredits($id, $amount, $reason);

    _redirect_self("Cộng tiền thành công !", $row['id']);
}

if (isset($_POST['tru_tien'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        _redirect_self("Đây là trang web demo bạn không thể thực hiện chức năng này !", $row['id']);
    }
    if ($_POST['amount'] <= 0) {
        _redirect_self("Số tiền không hợp lệ !", $row['id']);
    }

    $amount = xss($_POST['amount']);
    $reason = xss($_POST['reason']);
    RemoveCredits($id, $amount, $reason);

    _redirect_self("Trừ tiền thành công !", $row['id']);
}
?>

<style>
/* =========================
   VIP DARK UI - CLEAR TEXT
   Responsive All Devices
   ========================= */
:root{
    --bg0:#050814;
    --bg1:#070b16;

    --border: rgba(255,255,255,.12);
    --border2: rgba(255,255,255,.18);

    --text: rgba(255,255,255,.95);
    --muted: rgba(255,255,255,.74);
    --muted2: rgba(255,255,255,.62);

    --shadow: 0 22px 70px rgba(0,0,0,.60);
    --shadow2: 0 12px 34px rgba(0,0,0,.40);
    --radius: 18px;

    --primary:#60a5fa;
    --primary2:#2563eb;
    --good:#22c55e;
    --danger:#ef4444;

    --focus: rgba(96,165,250,.30);
}

body, .container-fluid{
    background: radial-gradient(1200px 600px at 10% 0%, rgba(37,99,235,.18), transparent 55%),
                radial-gradient(900px 520px at 90% 10%, rgba(34,197,94,.12), transparent 58%),
                linear-gradient(180deg, var(--bg0), var(--bg1)) !important;
    color: var(--text) !important;
}

.card{
    background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03)) !important;
    border: 1px solid var(--border) !important;
    border-radius: var(--radius) !important;
    box-shadow: var(--shadow2) !important;
}

.card .card-body, .card .card-title, .card label, .card h1, .card h2, .card h3, .card h4, .card h5, .card h6{
    color: var(--text) !important;
}

.form-control, select.form-control, textarea.form-control,
.select2-container--default .select2-selection--single{
    background: rgba(0,0,0,.35) !important;
    border: 1px solid rgba(255,255,255,.16) !important;
    color: var(--text) !important;
    border-radius: 14px !important;
    min-height: 44px;
}

.form-control:focus, select.form-control:focus, textarea.form-control:focus{
    border-color: rgba(96,165,250,.65) !important;
    box-shadow: 0 0 0 4px var(--focus) !important;
}

.form-control[disabled]{
    opacity: .82;
    cursor: not-allowed;
}

textarea.form-control{
    min-height: 120px;
    resize: vertical;
}

i, .text-muted, small{
    color: var(--muted2) !important;
}

/* HERO */
.u-hero{
    position: relative;
    border-radius: 22px;
    padding: 18px 18px 14px;
    overflow: hidden;
    border: 1px solid var(--border);
    background:
        radial-gradient(1200px 480px at 0% 0%, rgba(37,99,235,.35), transparent 60%),
        radial-gradient(900px 460px at 100% 10%, rgba(34,197,94,.18), transparent 60%),
        linear-gradient(180deg, rgba(255,255,255,.07), rgba(255,255,255,.03));
    box-shadow: var(--shadow);
    margin-bottom: 14px;
}

.u-hero-top{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 12px;
    flex-wrap: wrap;
}

.u-badge{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding: 9px 12px;
    border-radius: 999px;
    border: 1px solid var(--border2);
    background: rgba(0,0,0,.25);
    color: var(--text);
    font-weight: 1000;
    letter-spacing: .35px;
    text-transform: uppercase;
    font-size: 12px;
}

.u-dot{
    width:10px;height:10px;border-radius:999px;
    background: var(--primary);
    box-shadow: 0 0 0 7px rgba(96,165,250,.18);
    animation: pulse 1.6s infinite;
}
@keyframes pulse{
    0%{ transform: scale(1); opacity: 1; }
    70%{ transform: scale(1.12); opacity: .75; }
    100%{ transform: scale(1); opacity: 1; }
}

.pill{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding: 7px 10px;
    border-radius: 999px;
    border: 1px solid var(--border);
    background: rgba(0,0,0,.22);
    color: var(--muted);
    font-size: 12px;
    white-space: nowrap;
}
.pill strong{ color: var(--text); font-weight: 1000; }

.u-hero-sub{
    margin-top: 10px;
    color: var(--muted);
    font-size: 13px;
    line-height: 1.55;
}

/* GRID (CSS grid responsive, không phụ thuộc bootstrap col) */
.u-grid{
    display:grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 14px;
}
.u-col-12{ grid-column: span 12; }
.u-col-6{ grid-column: span 6; }
.u-col-4{ grid-column: span 4; }

@media (max-width: 992px){
    .u-col-6{ grid-column: span 12; }
    .u-col-4{ grid-column: span 6; }
}
@media (max-width: 576px){
    .u-col-4{ grid-column: span 12; }
}

/* STATS */
.u-stats{
    display:grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 12px;
    margin-top: 12px;
}

.stat{
    grid-column: span 3;
    border-radius: 16px;
    border: 1px solid var(--border);
    background: rgba(0,0,0,.22);
    padding: 12px 12px;
    min-height: 74px;
}

@media (max-width: 992px){ .stat{ grid-column: span 6; } }
@media (max-width: 576px){ .stat{ grid-column: span 12; } }

.stat .k{
    font-size: 11px;
    color: var(--muted2);
    letter-spacing: .25px;
    text-transform: uppercase;
    font-weight: 900;
}
.stat .v{
    margin-top: 6px;
    font-size: 16px;
    color: var(--text);
    font-weight: 1000;
    letter-spacing: .2px;
}

/* BUTTONS */
.btn{
    border-radius: 14px !important;
    font-weight: 900 !important;
    letter-spacing: .2px;
}
.btn-success{
    background: linear-gradient(180deg, rgba(34,197,94,.96), rgba(22,163,74,.96)) !important;
    border: 1px solid rgba(255,255,255,.10) !important;
}
.btn-danger{
    background: linear-gradient(180deg, rgba(239,68,68,.96), rgba(220,38,38,.96)) !important;
    border: 1px solid rgba(255,255,255,.10) !important;
}
</style>

<div class="container-fluid" style="padding:18px 10px 44px;">

    <div class="u-hero">
        <div class="u-hero-top">
            <div class="u-badge">
                <span class="u-dot"></span>
                <span>Quản lý thành viên</span>
            </div>
            <div class="pill"><strong>Dark Mode</strong> • chữ trắng rõ</div>
        </div>

        <div style="display:flex; gap:8px; flex-wrap:wrap; margin-top:10px;">
            <span class="pill">👤 <strong><?= htmlspecialchars($row['username']) ?></strong></span>
            <span class="pill">🆔 ID: <strong><?= (int)$row['id'] ?></strong></span>
            <span class="pill">📧 <strong><?= htmlspecialchars($row['email']) ?></strong></span>
            <span class="pill">📌 Trạng thái: <strong><?= ((int)$row['banned'] === 1) ? 'Khóa' : 'Hoạt động' ?></strong></span>
        </div>

        <div class="u-hero-sub">
            ✅ Đã FIX lỗi “bấm Lưu load lâu” bằng cách bỏ <b>history.back().reload</b> (gây vòng lặp) và chuyển sang redirect về đúng URL edit user.
            Chức năng giữ nguyên.
        </div>
    </div>

    <div class="u-grid">

        <!-- THÔNG TIN USER -->
        <div class="u-col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" style="font-weight:1000; letter-spacing:.2px; margin-bottom:12px;">
                        ⚙ Thông tin tài khoản
                    </h4>

                    <!-- 1 FORM DUY NHẤT -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="u-grid">

                            <div class="u-col-4">
                                <label>Tài khoản</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($row['username']) ?>" disabled>
                            </div>

                            <div class="u-col-4">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required>
                            </div>

                            <div class="u-col-4">
                                <label>Mật khẩu</label>
                                <input name="password" type="text" class="form-control" placeholder="******">
                                <i>Nhập mật khẩu cần thay đổi, hệ thống sẽ tự động mã hoá (để trống nếu không muốn thay đổi)</i>
                            </div>

                            <div class="u-col-4">
                                <label>Admin</label>
                                <select name="role" class="form-control" data-toggle="select2" required>
                                    <option <?= $row['role'] == 1 ? 'selected' : ''; ?> value="1">Admin</option>
                                    <option <?= $row['role'] == 0 ? 'selected' : ''; ?> value="0">Thành viên</option>
                                </select>
                            </div>

                            <div class="u-col-4">
                                <label>Trạng thái</label>
                                <select name="banned" class="form-control" data-toggle="select2" required>
                                    <option <?= $row['banned'] == 1 ? 'selected' : ''; ?> value="1">Khóa</option>
                                    <option <?= $row['banned'] == 0 ? 'selected' : ''; ?> value="0">Hoạt động</option>
                                </select>
                            </div>

                            <div class="u-col-4">
                                <label>IP</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($row['ip']) ?>" disabled>
                            </div>

                            <div class="u-col-12">
                                <div class="u-stats">
                                    <div class="stat">
                                        <div class="k">Số dư</div>
                                        <div class="v"><?= htmlspecialchars($row['coin']) ?></div>
                                    </div>
                                    <div class="stat">
                                        <div class="k">Tổng nạp</div>
                                        <div class="v"><?= htmlspecialchars($row['total_coin']) ?></div>
                                    </div>
                                    <div class="stat">
                                        <div class="k">Đã tiêu</div>
                                        <div class="v"><?= htmlspecialchars($row['total_coin'] - $row['coin']) ?></div>
                                    </div>
                                    <div class="stat">
                                        <div class="k">Ngày tham gia</div>
                                        <div class="v" style="font-size:13px; font-weight:900;"><?= htmlspecialchars($row['create_date']) ?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="u-col-12" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:8px;">
                                <a href="javascript:history.back()" class="btn btn-danger waves-effect">← QUAY LẠI</a>
                                <button type="submit" name="updateUsers" class="btn btn-success">💾 LƯU NGAY</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- CỘNG TIỀN -->
        <div class="u-col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><b>➕ Cộng tiền - <?= htmlspecialchars($row['username']) ?></b></h4>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="u-grid">
                            <div class="u-col-12">
                                <label>Số tiền</label>
                                <input type="number" class="form-control" name="amount" placeholder="Nhập số tiền cần cộng" required>
                            </div>
                            <div class="u-col-12">
                                <label>Nội dung</label>
                                <textarea name="reason" class="form-control" placeholder="Nhập nội dung nếu có"></textarea>
                            </div>
                            <div class="u-col-12">
                                <button type="submit" name="cong_tien" class="btn btn-success">Thực hiện</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- TRỪ TIỀN -->
        <div class="u-col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><b>➖ Trừ tiền - <?= htmlspecialchars($row['username']) ?></b></h4>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="u-grid">
                            <div class="u-col-12">
                                <label>Số tiền</label>
                                <input type="number" class="form-control" name="amount" placeholder="Nhập số tiền cần trừ" required>
                            </div>
                            <div class="u-col-12">
                                <label>Nội dung</label>
                                <textarea name="reason" class="form-control" placeholder="Nhập nội dung nếu có"></textarea>
                            </div>
                            <div class="u-col-12">
                                <button type="submit" name="tru_tien" class="btn btn-danger">Thực hiện</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div><!-- /u-grid -->

</div>