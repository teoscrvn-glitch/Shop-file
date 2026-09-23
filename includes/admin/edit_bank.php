<?php
CheckLogin();
CheckAdmin();
?>
<?php
if (isset($_GET['id_bank'])) {
    $id = xss($_GET['id_bank']);
    $row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `bank` WHERE `id` = '$id' ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
}
?>
<?php
if (isset($_POST['CapNhat'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }

    $url_image = null;
    if (check_img('images') == true) {
        $rand = random('0123456789QWERTYUIOPASDGHJKLZXCVBNM', 4);
        $uploads_dir_image = 'upload/bank/bank' . $rand . '.png';
        $uploads_dir_image2 = './upload/bank/bank' . $rand . '.png';
        $tmp_name = $_FILES['images']['tmp_name'];
        $addlogo = move_uploaded_file($tmp_name, $uploads_dir_image2);
        if ($addlogo) {
            $url_image = $uploads_dir_image;
            $LOCNGUYEN_SIEUTHICODE->update("bank", [
                'logo' => $url_image
            ], " `id` = '" . $row['id'] . "' ");
        }
    }

    $isInsert = $LOCNGUYEN_SIEUTHICODE->update("bank", [
        'ghichu'    => $_POST['ghichu'],
        'name'      => xss($_POST['name']),
        'stk'       => xss($_POST['stk']),
        'bank_name' => xss($_POST['bank_name'])
    ], " `id` = '" . $row['id'] . "' ");

    if ($isInsert) {
        die('<script type="text/javascript">if(!alert("Cập nhật thành công !")){location.href = "main.php?action=list_bank";}</script>');
    } else {
        die('<script type="text/javascript">if(!alert("Thêm thất bại !")){window.history.back().location.reload();}</script>');
    }
}
?>

<style>
:root{
    --bg:#000;
    --bg2:#050505;
    --card:#0b0b0b;
    --card2:#101010;
    --border: rgba(255,255,255,.12);
    --border2: rgba(255,255,255,.18);
    --text: rgba(255,255,255,.92);
    --muted: rgba(255,255,255,.68);
    --shadow: 0 22px 80px rgba(0,0,0,.75);
    --radius: 20px;
    --radius2: 14px;
    --primary:#3b82f6;
    --primary2:#2563eb;
    --danger:#ef4444;
    --focus: 0 0 0 4px rgba(59,130,246,.22);
}

.bank-page{
    padding: 18px 0;
}

.bank-dark-wrap{
    background: radial-gradient(1200px 420px at 15% -10%, rgba(59,130,246,.18), transparent 55%),
                radial-gradient(900px 380px at 90% 0%, rgba(34,197,94,.10), transparent 55%),
                linear-gradient(180deg, var(--bg), var(--bg2));
    border-radius: 22px;
    padding: 14px;
    border: 1px solid rgba(255,255,255,.06);
}

.bank-card{
    border-radius: 22px;
    overflow: hidden;
    border: 1px solid var(--border);
    background: linear-gradient(180deg, rgba(255,255,255,.05), rgba(255,255,255,.02));
    box-shadow: var(--shadow);
}

.bank-head{
    padding: 16px 16px 12px;
    border-bottom: 1px solid rgba(255,255,255,.08);
    background: linear-gradient(180deg, rgba(255,255,255,.04), rgba(255,255,255,.01));
}

.bank-title{
    margin: 0;
    color: var(--text);
    font-weight: 900;
    letter-spacing: .2px;
    font-size: 18px;
}

.bank-sub{
    margin: 6px 0 0;
    color: var(--muted);
    font-size: 13px;
    line-height: 1.5;
}

.bank-body{
    padding: 16px;
}

.bank-grid{
    display:grid;
    grid-template-columns: 1fr;
    gap: 12px;
}
@media (min-width: 992px){
    .bank-grid.two{ grid-template-columns: 1fr 1fr; }
}

.bank-field{
    border-radius: var(--radius2);
    border: 1px solid rgba(255,255,255,.10);
    background: rgba(0,0,0,.35);
    padding: 12px;
    transition: .15s ease;
}
.bank-field:hover{
    border-color: rgba(255,255,255,.16);
    transform: translateY(-1px);
}

.bank-label{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 8px;
    margin-bottom: 8px;
    font-weight: 900;
    font-size: 13px;
    color: rgba(255,255,255,.88);
}
.bank-hint{
    font-size: 12px;
    color: rgba(255,255,255,.60);
    font-weight: 700;
}

.bank-field .form-control{
    border-radius: 12px !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    background: #060606 !important;
    color: var(--text) !important;
    padding: 11px 12px !important;
    height: auto !important;
    box-shadow: none !important;
    outline: none !important;
}
.bank-field .form-control::placeholder{ color: rgba(255,255,255,.40); }
.bank-field .form-control:focus{
    border-color: rgba(59,130,246,.65) !important;
    box-shadow: var(--focus) !important;
}

.bank-field textarea.form-control{
    min-height: 120px;
    resize: vertical;
}

.bank-file-row{
    display:flex;
    align-items:center;
    gap: 12px;
    flex-wrap: wrap;
}
.bank-preview{
    display:flex;
    align-items:center;
    gap: 10px;
    padding: 8px 10px;
    border-radius: 14px;
    border: 1px dashed rgba(255,255,255,.18);
    background: rgba(0,0,0,.25);
    max-width: 100%;
}
.bank-preview img{
    width: 46px;
    height: 46px;
    border-radius: 12px;
    object-fit: cover;
    border: 1px solid rgba(255,255,255,.10);
    background: rgba(255,255,255,.04);
}
.bank-preview b{
    display:block;
    font-size: 13px;
    color: rgba(255,255,255,.90);
}
.bank-preview span{
    display:block;
    font-size: 12px;
    color: rgba(255,255,255,.60);
    margin-top: 2px;
    word-break: break-word;
}

.bank-actions{
    display:flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: flex-end;
    margin-top: 10px;
}
.bank-actions .btn{
    border-radius: 14px !important;
    padding: 10px 14px !important;
    font-weight: 900 !important;
    letter-spacing: .2px;
    border: 1px solid rgba(255,255,255,.12) !important;
}
.bank-actions .btn-primary{
    background: linear-gradient(180deg, var(--primary), var(--primary2)) !important;
    border-color: rgba(59,130,246,.55) !important;
    box-shadow: 0 14px 40px rgba(37,99,235,.22);
}
.bank-actions .btn-primary:hover{ filter: brightness(1.08); transform: translateY(-1px); }

.bank-actions .btn-danger{
    background: rgba(239,68,68,.14) !important;
    color: rgba(255,255,255,.92) !important;
    border-color: rgba(239,68,68,.45) !important;
}
.bank-actions .btn-danger:hover{ background: rgba(239,68,68,.18) !important; transform: translateY(-1px); }

@media (max-width: 575px){
    .bank-dark-wrap{ padding: 10px; }
    .bank-body{ padding: 12px; }
    .bank-actions{ justify-content: stretch; }
    .bank-actions .btn{ width: 100%; }
}

/* select2 đẹp trên nền đen (nếu có dùng select2) */
.select2-container--default .select2-selection--single{
    height: 44px !important;
    border-radius: 12px !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    background: #060606 !important;
    display:flex !important;
    align-items:center !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    color: var(--text) !important;
    padding-left: 12px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow{
    height: 44px !important;
    right: 10px !important;
}
</style>

<div class="container-fluid bank-page">
    <div class="bank-dark-wrap">
        <div class="bank-card">
            <div class="bank-head">
                <h3 class="bank-title">CẬP NHẬT NGÂN HÀNG</h3>
                <p class="bank-sub">Nền đen full • chữ rõ • tối ưu Mobile / Tablet / PC • không thay đổi logic</p>
            </div>

            <div class="bank-body">
                <form action="" method="POST" enctype="multipart/form-data" id="bankForm">
                    <div class="bank-grid two">
                        <div class="bank-field">
                            <div class="bank-label">
                                <span>Ngân hàng</span>
                                <span class="bank-hint">Bắt buộc</span>
                            </div>
                            <select name="name" class="form-control" data-toggle="select2" required>
                                <option value="">Chọn ngân hàng</option>
                                <?php foreach ($config_listbank as $list) { ?>
                                    <option <?= $row['name'] == $list ? 'selected' : ''; ?> value="<?= $list; ?>">
                                        <?= $list; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="bank-field">
                            <div class="bank-label">
                                <span>Số tài khoản</span>
                                <span class="bank-hint">Bắt buộc</span>
                            </div>
                            <input name="stk" type="text" class="form-control" placeholder="Nhập số tài khoản"
                                   value="<?= $row['stk'] ?>" required>
                        </div>
                    </div>

                    <div class="bank-grid two" style="margin-top:12px;">
                        <div class="bank-field">
                            <div class="bank-label">
                                <span>Chủ tài khoản</span>
                                <span class="bank-hint">Bắt buộc</span>
                            </div>
                            <input name="bank_name" type="text" class="form-control" placeholder="Nhập tên chủ tài khoản"
                                   value="<?= $row['bank_name'] ?>" required>
                        </div>

                        <div class="bank-field">
                            <div class="bank-label">
                                <span>Hình ảnh</span>
                                <span class="bank-hint">Không bắt buộc</span>
                            </div>

                            <div class="bank-file-row">
                                <input class="form-control" name="images" id="imagesInput" type="file" accept="image/*" />

                                <div class="bank-preview">
                                    <img id="previewImg" src="<?= BASE_URL('/'), $row['logo'] ?>" alt="" width="46" height="46">
                                    <div>
                                        <b>Preview logo</b>
                                        <span id="previewText"><?= $row['logo'] ? $row['logo'] : 'Chưa có logo'; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bank-field" style="margin-top:12px;">
                        <div class="bank-label">
                            <span>Ghi chú</span>
                            <span class="bank-hint">Tùy chọn</span>
                        </div>
                        <textarea name="ghichu" class="form-control" placeholder="Nhập ghi chú..."><?= $row['ghichu'] ?></textarea>
                    </div>

                    <div class="bank-actions">
                        <a href="javascript:history.back()" class="btn btn-danger waves-effect">QUAY LẠI</a>

                        <!-- ✅ giữ name="CapNhat" để PHP isset($_POST['CapNhat']) chạy -->
                        <button type="submit" name="CapNhat" class="btn btn-primary" id="saveBtn">LƯU NGAY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    // Preview ảnh (KHÔNG chặn submit, KHÔNG disable nút)
    const input = document.getElementById('imagesInput');
    const img   = document.getElementById('previewImg');
    const text  = document.getElementById('previewText');

    if (input) {
        input.addEventListener('change', function(){
            const file = this.files && this.files[0];
            if (!file) return;

            text.textContent = file.name + ' • ' + Math.round(file.size/1024) + 'KB';

            if (file.type && file.type.startsWith('image/')) {
                const url = URL.createObjectURL(file);
                img.src = url;
                img.onload = () => URL.revokeObjectURL(url);
            }
        });
    }
})();
</script>