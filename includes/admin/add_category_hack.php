<?php
CheckLogin();
CheckAdmin();

/* BẬT HIỆN LỖI ĐỂ BIẾT NGUYÊN NHÂN (tắt khi chạy thật) */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['addProduct'])) {

    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }

    // Debug xem có nhận POST không
    if (empty($_POST['name']) || empty($_POST['stt'])) {
        die('<script type="text/javascript">if(!alert("Thiếu dữ liệu: name hoặc stt")){window.history.back().location.reload();}</script>');
    }

    // FIX: images để rỗng vẫn insert được (tránh NOT NULL fail)
    $url_img = '';

    // ===== UPLOAD ẢNH (nếu có) =====
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'])) {

        // Debug lỗi upload của PHP
        if (!isset($_FILES['images']['error']) || $_FILES['images']['error'] !== UPLOAD_ERR_OK) {
            $err = isset($_FILES['images']['error']) ? $_FILES['images']['error'] : 'unknown';
            die('<script type="text/javascript">if(!alert("Upload lỗi (code): '.$err.'")){window.history.back().location.reload();}</script>');
        }

        // Nếu bạn vẫn muốn dùng check_img() thì giữ, không thì bỏ
        if (function_exists('check_img') && check_img('images') != true) {
            die('<script type="text/javascript">if(!alert("Ảnh không hợp lệ (check_img)")){window.history.back().location.reload();}</script>');
        }

        $ext = strtolower(pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['png','jpg','jpeg','webp'])) {
            die('<script type="text/javascript">if(!alert("Chỉ hỗ trợ PNG/JPG/JPEG/WEBP")){window.history.back().location.reload();}</script>');
        }

        $rand = function_exists('random')
            ? random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 6)
            : substr(str_shuffle("QWERTYUIOPASDFGHJKLZXCVBNM0123456789"), 0, 6);

        // ĐƯỜNG DẪN THƯ MỤC UPLOAD (chuẩn, dễ hiểu)
        $uploadDir = __DIR__ . '/upload/product/';
        if (!is_dir($uploadDir)) {
            if (!@mkdir($uploadDir, 0755, true)) {
                die('<script type="text/javascript">if(!alert("Không tạo được thư mục upload/product (thiếu quyền)")){window.history.back().location.reload();}</script>');
            }
        }

        // Kiểm tra quyền ghi
        if (!is_writable($uploadDir)) {
            die('<script type="text/javascript">if(!alert("Thư mục upload/product không có quyền ghi (chmod/owner)")){window.history.back().location.reload();}</script>');
        }

        $filename   = 'product' . $rand . '.' . $ext;
        $savePath   = $uploadDir . $filename;         // path vật lý
        $url_img    = 'upload/product/' . $filename;  // lưu DB

        if (!move_uploaded_file($_FILES['images']['tmp_name'], $savePath)) {
            die('<script type="text/javascript">if(!alert("move_uploaded_file thất bại!")){window.history.back().location.reload();}</script>');
        }
    }

    // ===== INSERT DB =====
    $data = array(
        'stt'         => xss($_POST['stt']),
        'name'        => xss($_POST['name']),
        'slug'        => xss(create_slug($_POST['name'])),
        'images'      => $url_img, // '' nếu không upload
        'content'     => trim($_POST['content'] ?? ''),
        'create_date' => gettime(),
        'update_date' => gettime(),
        'status'      => xss($_POST['status'] ?? 1),
    );

    $isInsert = $LOCNGUYEN_SIEUTHICODE->insert("tbl_category_hack", $data);

    if ($isInsert) {
        die('<script type="text/javascript">if(!alert("Thêm thành công !")){location.href = "main.php?action=list_category_hack";}</script>');
    } else {
        // Debug: in ra dữ liệu để biết insert fail do gì (tạm thời)
        die('<pre style="background:#111;color:#0f0;padding:12px;border-radius:10px;max-width:900px;overflow:auto;">
INSERT FAIL.
Dữ liệu gửi lên:
'.htmlspecialchars(print_r($data, true)).'

FILES:
'.htmlspecialchars(print_r($_FILES, true)).'
</pre>');
    }
}
?>

<style>
:root{
    --border: rgba(255,255,255,.10);
    --muted: rgba(255,255,255,.70);
    --text: rgba(255,255,255,.92);
    --focus: rgba(59,130,246,.40);
    --primary: #3b82f6;
    --primary2:#2563eb;
    --shadow: 0 18px 60px rgba(0,0,0,.35);
    --radius: 16px;
}
.addcat-wrap{ padding: 14px 10px; }
.addcat-card{
    background: linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}
.addcat-head{
    padding: 16px 18px;
    border-bottom: 1px solid var(--border);
    background:
        radial-gradient(900px 220px at 10% 0%, rgba(59,130,246,.30), transparent 60%),
        radial-gradient(900px 240px at 90% 0%, rgba(34,197,94,.16), transparent 55%);
}
.addcat-title{
    margin:0;
    font-weight:900;
    font-size: 18px;
    color: var(--text);
}
.addcat-sub{
    margin:6px 0 0 0;
    font-size: 13px;
    color: var(--muted);
}
.addcat-body{ padding: 18px; }

.form-section{
    border: 1px solid var(--border);
    border-radius: 14px;
    background: rgba(2,6,23,.25);
    padding: 14px;
    margin-bottom: 14px;
}
.f-label{
    font-weight: 800;
    font-size: 12.5px;
    color: rgba(255,255,255,.85);
    margin-bottom: 6px;
    display:block;
}
.f-input, .f-select, .f-textarea{
    width:100%;
    border-radius: 12px !important;
    border: 1px solid rgba(255,255,255,.14) !important;
    background: rgba(15,23,42,.65) !important;
    color: rgba(255,255,255,.92) !important;
    padding: 11px 12px !important;
    outline: none !important;
    transition: .18s ease;
}
.f-textarea{ min-height: 140px; resize: vertical; }
.f-input:focus, .f-select:focus, .f-textarea:focus{
    box-shadow: 0 0 0 4px var(--focus) !important;
    border-color: rgba(59,130,246,.55) !important;
}
.btn-primary2{
    border-radius: 12px;
    padding: 11px 16px;
    font-weight: 900;
    background: linear-gradient(135deg, var(--primary), var(--primary2));
    border: 0;
    color: #fff;
    box-shadow: 0 12px 34px rgba(59,130,246,.22);
    min-width: 180px;
}
.btn-secondary2{
    border-radius: 12px;
    padding: 11px 16px;
    font-weight: 900;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.14);
    color: rgba(255,255,255,.90);
    min-width: 180px;
}
.img-preview{ display:flex; gap: 12px; align-items:center; flex-wrap:wrap; }
.img-box{
    width: 110px; height: 110px;
    border-radius: 14px;
    border: 1px dashed rgba(255,255,255,.18);
    background: rgba(15,23,42,.45);
    display:flex; align-items:center; justify-content:center;
    overflow:hidden;
}
.img-box img{ width:100%; height:100%; object-fit: cover; display:none; }
.img-placeholder{
    font-size: 12px; color: rgba(255,255,255,.65);
    text-align:center; padding: 0 10px;
}
@media (max-width: 576px){
    .addcat-body{ padding: 14px; }
    .btn-primary2, .btn-secondary2{ width: 100%; min-width: unset; }
}
</style>

<div class="container-fluid addcat-wrap">
    <form action="" method="POST" enctype="multipart/form-data" id="addCategoryForm">
        <div class="row">
            <div class="col-12">
                <div class="addcat-card">
                    <div class="addcat-head">
                        <div>
                            <h3 class="addcat-title">THÊM DANH MỤC HACK GAME</h3>
                            <p class="addcat-sub">Nếu vẫn lỗi, trang sẽ in ra DEBUG để bạn thấy nguyên nhân.</p>
                        </div>
                    </div>

                    <div class="addcat-body">

                        <div class="form-section">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label class="f-label">Số Thứ Tự</label>
                                    <input name="stt" type="number" min="1" class="f-input" required>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label class="f-label">Tên Danh Mục</label>
                                    <input name="name" type="text" class="f-input" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="f-label">Nội Dung</label>
                                    <textarea name="content" rows="6" class="f-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="row align-items-start">
                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label class="f-label">Ảnh Mô Tả</label>

                                    <div class="img-preview">
                                        <div class="img-box">
                                            <img id="imgPreview" alt="preview">
                                            <div class="img-placeholder" id="imgPlaceholder">
                                                Chưa chọn ảnh<br>PNG/JPG/JPEG/WEBP
                                            </div>
                                        </div>

                                        <div style="flex:1; min-width: 220px;">
                                            <input class="f-input" type="file" name="images" id="imagesInput" accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label class="f-label">Trạng Thái</label>
                                    <select name="status" class="f-select">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap justify-content-center" style="gap:10px;">
                            <button type="submit" name="addProduct" class="btn-primary2" id="btnSubmit">
                                <i class="fa fa-paper-plane"></i> Đăng danh mục
                            </button>
                            <a href="main.php?action=list_category_hack" class="btn-secondary2 text-center" style="display:inline-flex;align-items:center;justify-content:center;text-decoration:none;">
                                <i class="fa fa-list"></i>&nbsp; Danh sách danh mục
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
(function(){
  const input = document.getElementById('imagesInput');
  const img = document.getElementById('imgPreview');
  const placeholder = document.getElementById('imgPlaceholder');

  if (input) {
    input.addEventListener('change', function(){
      const file = this.files && this.files[0];
      if (!file) {
        img.style.display = 'none';
        placeholder.style.display = 'block';
        return;
      }
      const url = URL.createObjectURL(file);
      img.src = url;
      img.style.display = 'block';
      placeholder.style.display = 'none';
    });
  }
})();
</script>