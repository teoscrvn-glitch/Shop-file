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

    // tránh undefined variable nếu không upload ảnh
    $url_img = '';

    if (check_img('images') == true) {
        $tmp_name = $_FILES['images']['tmp_name'];
        $url_img_up = './upload/product/product' . $rand . '.png';
        $url_img = 'upload/product/product' . $rand . '.png';
        move_uploaded_file($tmp_name, $url_img_up);
    }

    $isInsert = $LOCNGUYEN_SIEUTHICODE->insert("tbl_groups_hack", array(
        'stt'          => xss($_POST['stt']),
        'name'         => xss($_POST['name']),
        'slug'         => xss(create_slug($_POST['name'])),
        'cate_id'      => xss($_POST['category']),
        'images'       => $url_img,
        'content'      => trim($_POST['content']),
        'create_date'  => gettime(),
        'update_date'  => gettime(),
        'status'       => xss($_POST['status']),
    ));

    if ($isInsert) {
        die('<script type="text/javascript">if(!alert("Thêm thành công !")){location.href = "main.php?action=list_groups_hack";}</script>');
    } else {
        die('<script type="text/javascript">if(!alert("Thêm thất bại !")){window.history.back().location.reload();}</script>');
    }
}
?>

<style>
    /* ====== UI UPGRADE (không đổi logic) ====== */
    .page-wrap{
        max-width: 1200px;
        margin: 0 auto;
        padding: 16px 12px;
    }
    .hero-head{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        margin-bottom:14px;
    }
    .hero-title{
        margin:0;
        font-weight:800;
        letter-spacing:.2px;
        font-size: clamp(18px, 2.2vw, 24px);
    }
    .hero-sub{
        margin:2px 0 0 0;
        opacity:.75;
        font-size: 13px;
    }
    .card-modern{
        border: 1px solid rgba(0,0,0,.06);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,.05);
    }
    .card-modern .card-header{
        background: linear-gradient(135deg, rgba(13,110,253,.10), rgba(102,16,242,.08));
        border-bottom: 1px solid rgba(0,0,0,.06);
        padding: 16px 18px;
    }
    .card-modern .card-body{
        padding: 18px;
    }
    .form-label{
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 6px;
    }
    .form-control, .custom-select, select.form-control{
        border-radius: 12px !important;
        border: 1px solid rgba(0,0,0,.12);
        padding: 10px 12px;
        min-height: 42px;
    }
    .form-control:focus, select.form-control:focus{
        box-shadow: 0 0 0 .2rem rgba(13,110,253,.15);
        border-color: rgba(13,110,253,.35);
    }
    .btn-modern{
        border-radius: 12px;
        padding: 10px 16px;
        font-weight: 800;
        letter-spacing: .2px;
    }
    .btn-soft{
        background: rgba(13,110,253,.10);
        border: 1px solid rgba(13,110,253,.18);
        color: #0d6efd;
    }
    .btn-soft:hover{ background: rgba(13,110,253,.14); }
    .btn-primary.btn-modern{
        box-shadow: 0 10px 22px rgba(13,110,253,.18);
    }
    .help-text{
        font-size: 12px;
        opacity: .70;
        margin-top: 6px;
    }
    .grid{
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 14px;
    }
    .col-12{ grid-column: span 12; }
    .col-6{ grid-column: span 6; }
    .col-4{ grid-column: span 4; }
    .col-8{ grid-column: span 8; }

    @media (max-width: 992px){
        .col-6,.col-4,.col-8{ grid-column: span 12; }
        .card-modern .card-body{ padding: 14px; }
        .card-modern .card-header{ padding: 14px; }
    }
    /* CKEditor area */
    textarea.form-control{
        min-height: 120px;
        resize: vertical;
    }
</style>

<div class="container-fluid">
    <div class="page-wrap">

        <div class="hero-head">
            <div>
                <h3 class="hero-title">THÊM GÓI HACK GAME</h3>
                <p class="hero-sub">Giao diện tối ưu mobile / tablet / PC — giữ nguyên logic xử lý.</p>
            </div>
            <div class="d-flex" style="gap:10px; flex-wrap:wrap; justify-content:flex-end;">
                <a class="btn btn-modern btn-soft" href="main.php?action=list_groups_hack">
                    <i class="fa fa-list"></i> Danh sách
                </a>
            </div>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card card-modern">
                <div class="card-header">
                    <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                        <div style="width:42px;height:42px;border-radius:12px;background:rgba(13,110,253,.12);display:flex;align-items:center;justify-content:center;">
                            <i class="fa fa-plus" style="color:#0d6efd;"></i>
                        </div>
                        <div>
                            <div style="font-weight:900; font-size:16px;">Thông tin gói</div>
                            <div style="opacity:.75; font-size:12px;">Nhập đầy đủ thông tin trước khi đăng.</div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="grid">

                        <div class="col-6">
                            <label class="form-label">Số Thứ Tự</label>
                            <input name="stt" type="text" class="form-control" placeholder="VD: 1, 2, 3..." required>
                            <div class="help-text">Dùng để sắp xếp hiển thị theo thứ tự.</div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Tên Gói Hack</label>
                            <input name="name" type="text" class="form-control" placeholder="Nhập tên gói hack..." required>
                            <div class="help-text">Slug sẽ tự tạo theo tên gói.</div>
                        </div>

                        <div class="col-8">
                            <label class="form-label">Danh Mục Hack</label>
                            <select name="category" class="form-control" data-toggle="select2" required>
                                <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_category_hack` WHERE `status`=1 ORDER BY `stt` ASC") as $cate) : ?>
                                    <option value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="help-text">Chọn đúng danh mục để hiển thị chuẩn.</div>
                        </div>

                        <div class="col-4">
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-control show-tick" tabindex="-98">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                            <div class="help-text">Ẩn nếu bạn chưa muốn public.</div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Ảnh Mô Tả</label>
                            <input class="form-control" type="file" name="images" accept="image/*">
                            <div class="help-text">Khuyến nghị ảnh ngang 1200×630 hoặc 800×450 để hiển thị đẹp.</div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Nội dung</label>
                            <!-- dùng textarea để CKEditor chạy chuẩn -->
                            <textarea name="content" id="content" class="form-control" placeholder="Nhập nội dung..."></textarea>
                            <div class="help-text">Bạn có thể dùng định dạng, xuống dòng, chèn link, v.v.</div>
                        </div>

                        <div class="col-12" style="display:flex; gap:10px; flex-wrap:wrap; justify-content:center; margin-top:6px;">
                            <button type="submit" name="addProduct" class="btn btn-primary btn-modern">
                                <i class="fa fa-cloud-upload"></i> Đăng gói
                            </button>
                            <button type="reset" class="btn btn-modern btn-soft">
                                <i class="fa fa-undo"></i> Nhập lại
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
    // giữ nguyên việc dùng CKEditor như bạn yêu cầu
    CKEDITOR.replace("content");
</script>