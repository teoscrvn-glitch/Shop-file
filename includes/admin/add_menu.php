<?php
CheckLogin();
CheckAdmin();
?>
<?php
if (isset($_POST['addProduct']) && $getUser['role'] == '1') {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }
    $rand = random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 6);
    $isInsert = $LOCNGUYEN_SIEUTHICODE->insert("tbl_menu", array(
        'stt'          => xss($_POST['stt']),
        'name'         => xss($_POST['name']),
        'slug'         => xss(create_slug($_POST['name'])),
        'noidung'      => base64_encode($_POST['noidung']),
        'status'       => xss($_POST['status']),
    ));
    if ($isInsert) {
        die('<script type="text/javascript">if(!alert("Thêm thành công !")){location.href = "main.php?action=list_menu";}</script>');
    } else {
        die('<script type="text/javascript">if(!alert("Thêm thất bại !")){window.history.back().location.reload();}</script>');
    }
}
?>

<style>
/* =========================
   WHITE UI ONLY - Không đổi logic
   ========================= */
:root{
    --bg:#ffffff;
    --card:#ffffff;
    --border:#e5e7eb;     /* xám nhạt */
    --border2:#d1d5db;
    --text:#111827;       /* gần đen */
    --muted:#4b5563;      /* xám đậm */
    --muted2:#6b7280;
    --primary:#2563eb;    /* xanh */
    --primary2:#06b6d4;   /* cyan */
    --shadow: 0 10px 28px rgba(0,0,0,.08);
    --radius: 16px;
}

/* wrapper */
.menu-add-wrap{
    padding: 18px 12px 28px;
    background: var(--bg);
}

/* hero */
.menu-hero{
    border-radius: 18px;
    border: 1px solid var(--border);
    background: #fff;
    box-shadow: var(--shadow);
    padding: 16px 16px;
    margin-bottom: 14px;
}
.menu-hero h2{
    margin:0;
    font-weight: 900;
    letter-spacing: .2px;
    color: var(--text);
    font-size: 22px;
    line-height: 1.2;
}
.menu-hero p{
    margin: 6px 0 0;
    color: var(--muted);
    font-size: 14px;
}

/* main card */
.menu-card{
    border-radius: var(--radius);
    border: 1px solid var(--border);
    background: var(--card);
    box-shadow: var(--shadow);
    overflow: hidden;
}

/* header of card */
.menu-section-title{
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    display:flex;
    align-items:center;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:10px;
}
.menu-section-title h3{
    margin:0;
    color: var(--text);
    font-weight: 900;
    font-size: 18px;
}
.menu-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding: 6px 10px;
    border-radius: 999px;
    border: 1px solid var(--border);
    background: #f9fafb;
    color: var(--text);
    font-weight: 800;
    font-size: 12px;
}
.menu-dot{
    width:10px;height:10px;border-radius:999px;
    background: linear-gradient(135deg, var(--primary2), var(--primary));
}

/* body */
.menu-card .card-body{
    padding: 16px;
}

/* labels to rõ */
.menu-card label{
    display:block;
    color: var(--text);
    font-weight: 800;
    font-size: 15px;
    margin-bottom: 8px;
}

/* controls to rõ */
.menu-card .form-control{
    height: 50px;
    border-radius: 12px;
    border: 1px solid var(--border2);
    background: #fff;
    color: var(--text);
    font-size: 16px;
    padding: 12px 14px;
    outline: none;
    box-shadow: none;
    transition: .15s ease;
}
.menu-card .form-control::placeholder{
    color: var(--muted2);
}
.menu-card .form-control:focus{
    border-color: rgba(37,99,235,.75);
    box-shadow: 0 0 0 4px rgba(37,99,235,.14);
}

/* textarea */
.menu-card textarea.form-control{
    height: auto;
    min-height: 180px;
    line-height: 1.6;
    padding: 14px;
    resize: vertical;
}

/* help text */
.menu-help{
    margin-top: 8px;
    color: var(--muted);
    font-size: 13px;
}

/* spacing */
.menu-card .form-group{
    margin-bottom: 16px;
}

/* actions */
.menu-actions{
    margin-top: 6px;
    padding-top: 14px;
    border-top: 1px dashed var(--border);
    display:flex;
    justify-content:center;
}
.menu-btn{
    border: 0;
    border-radius: 14px;
    padding: 12px 18px;
    font-weight: 900;
    font-size: 15px;
    min-width: 190px;
    transition: transform .08s ease, filter .15s ease, box-shadow .15s ease;
}
.menu-btn:active{ transform: translateY(1px); }

/* keep class btn-info but make it modern */
.menu-card .btn.btn-info{
    background: linear-gradient(135deg, var(--primary), #1d4ed8);
    color:#fff;
    box-shadow: 0 12px 26px rgba(37,99,235,.20);
}
.menu-card .btn.btn-info:hover{
    filter: brightness(1.03);
    box-shadow: 0 14px 30px rgba(37,99,235,.26);
}

/* CKEditor (nền trắng + viền rõ) */
.cke_chrome{
    border-radius: 12px !important;
    border: 1px solid var(--border2) !important;
    overflow: hidden;
    box-shadow: 0 10px 22px rgba(0,0,0,.06);
}
.cke_top{
    background: #f9fafb !important;
    border-bottom: 1px solid var(--border) !important;
}
.cke_bottom{
    background: #f9fafb !important;
    border-top: 1px solid var(--border) !important;
}
.cke_toolgroup{
    border-radius: 10px !important;
    border-color: var(--border) !important;
    background: #fff !important;
}

/* responsive */
@media (max-width: 575px){
    .menu-add-wrap{ padding: 14px 10px 22px; }
    .menu-hero{ padding: 14px; }
    .menu-hero h2{ font-size: 20px; }
    .menu-card .card-body{ padding: 14px; }
    .menu-section-title{ padding: 12px 14px; }
    .menu-card .form-control{ height: 48px; font-size: 15.5px; }
    .menu-btn{ width: 100%; min-width: 0; }
}
</style>

<div class="container-fluid menu-add-wrap">

    <div class="menu-hero">
        <h2>THÊM MENU</h2>
        <p>Giao diện nền trắng, chữ đậm rõ ràng, responsive mọi thiết bị (không thay đổi logic).</p>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12">

                <div class="card menu-card">
                    <div class="menu-section-title">
                        <div class="menu-badge"><span class="menu-dot"></span> FORM MENU</div>
                        <h3>Thông tin menu</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <label>Số Thứ Tự</label>
                                <div class="form-group">
                                    <input name="stt" type="number" min="1" class="form-control" placeholder="Ví dụ: 1" required>
                                    <div class="menu-help">Số nhỏ sẽ ưu tiên hiển thị trước (tuỳ cách bạn render).</div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <label>Tên Menu</label>
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control" placeholder="Ví dụ: Liên hệ / Hướng dẫn / Chính sách..." required>
                                    <div class="menu-help">Slug tự tạo từ tên menu.</div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xs-12">
                                <label>Nội Dung</label>
                                <div class="form-group">
                                    <textarea id="noidung" name="noidung" rows="6" class="form-control" placeholder="Nhập nội dung menu..."></textarea>
                                    <div class="menu-help">Soạn thảo bằng CKEditor (hỗ trợ định dạng, link, hình ảnh...).</div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <label>Trạng Thái</label>
                                <div class="form-group">
                                    <select name="status" class="form-control show-tick" tabindex="-98">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                    <div class="menu-help">Chọn “Ẩn” nếu bạn chưa muốn công khai menu.</div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="menu-actions">
                                    <button type="submit" name="addProduct" class="btn btn-info menu-btn">Đăng</button>
                                </div>
                            </div>

                        </div><!-- row -->
                    </div><!-- card-body -->
                </div><!-- card -->

            </div>
        </div>
    </form>
</div>

<script>
    CKEDITOR.replace("noidung");
</script>