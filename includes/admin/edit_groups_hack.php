<?php
CheckLogin();
CheckAdmin();
if (isset($_GET['id']) && $getUser['role'] == '1') {
    $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_groups_hack` WHERE `id` = '" . xss($_GET['id']) . "'  ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
}
?>

<?php
if (isset($_POST['editGroups']) && $getUser['role'] == '1') {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }

    $rand = random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 6);

    if (check_img('images') == true) {
        $tmp_name = $_FILES['images']['tmp_name'];
        $url_img_up = './upload/product/product' . $rand . '.png';
        $url_img = 'upload/product/product' . $rand . '.png';
        move_uploaded_file($tmp_name, $url_img_up);

        $LOCNGUYEN_SIEUTHICODE->update("tbl_groups_hack", array(
            'images' => $url_img
        ), " `id` = '" . $row['id'] . "' ");
    }

    $isUpdate = $LOCNGUYEN_SIEUTHICODE->update("tbl_groups_hack", array(
        'stt'         => xss($_POST['stt']),
        'name'        => xss($_POST['name']),
        'slug'        => xss(create_slug($_POST['name'])),
        'cate_id'     => xss($_POST['category']),
        'content'     => trim($_POST['content']),
        'tutorial'    => trim($_POST['tutorial']),
        'link_down'   => trim($_POST['link_down']),
        'status'      => xss($_POST['status']),
        'update_date' => gettime()
    ), " `id` = '" . $row['id'] . "' ");

    if ($isUpdate) {
        die('<script type="text/javascript">if(!alert("Lưu thành công !")){location.href = "";}</script>');
    } else {
        die('<script type="text/javascript">if(!alert("Lưu thất bại!")){window.history.back().location.reload();}</script>');
    }
}
?>

<style>
    :root{
        --card:#0f172a;
        --card2:#0b142c;
        --border: rgba(255,255,255,.10);
        --muted: rgba(255,255,255,.70);
        --text: rgba(255,255,255,.92);
        --focus: rgba(59,130,246,.40);
        --primary:#3b82f6;
        --primary2:#2563eb;
        --shadow: 0 18px 60px rgba(0,0,0,.35);
        --radius: 16px;
    }

    .editg-wrap{ padding: 14px 10px; }

    .editg-card{
        background: linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .editg-head{
        padding: 16px 18px;
        border-bottom: 1px solid var(--border);
        background:
            radial-gradient(900px 220px at 10% 0%, rgba(59,130,246,.30), transparent 60%),
            radial-gradient(900px 240px at 90% 0%, rgba(34,197,94,.14), transparent 55%);
        display:flex;
        align-items:flex-start;
        justify-content:space-between;
        gap:12px;
        flex-wrap:wrap;
    }
    .editg-title{
        margin:0;
        font-weight: 900;
        letter-spacing:.2px;
        font-size: 18px;
        color: var(--text);
        line-height: 1.2;
        text-transform: uppercase;
    }
    .editg-sub{
        margin:6px 0 0 0;
        font-size: 13px;
        color: var(--muted);
        line-height: 1.35;
    }

    .editg-body{ padding: 18px; }

    .form-section{
        border: 1px solid var(--border);
        border-radius: 14px;
        background: rgba(2,6,23,.25);
        padding: 14px;
        margin-bottom: 14px;
    }
    .section-title{
        margin: 0 0 10px 0;
        font-size: 13px;
        font-weight: 900;
        color: rgba(255,255,255,.92);
        display:flex;
        align-items:center;
        gap:10px;
        letter-spacing:.2px;
    }
    .dot{
        width:10px;height:10px;border-radius:50%;
        background: linear-gradient(135deg, #22c55e, #3b82f6);
        box-shadow: 0 0 0 4px rgba(34,197,94,.12);
    }

    .f-label{
        font-weight: 800;
        font-size: 12.5px;
        color: rgba(255,255,255,.85);
        margin-bottom: 6px;
        display:block;
    }
    .f-help{
        margin-top: 6px;
        font-size: 12px;
        color: rgba(255,255,255,.65);
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
    .f-textarea{
        min-height: 160px;
        resize: vertical;
    }
    .f-input:focus, .f-select:focus, .f-textarea:focus{
        box-shadow: 0 0 0 4px var(--focus) !important;
        border-color: rgba(59,130,246,.55) !important;
    }

    .img-preview{
        display:flex;
        gap: 12px;
        align-items:center;
        flex-wrap:wrap;
    }
    .img-box{
        width: 120px;
        height: 120px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
        display:flex;
        align-items:center;
        justify-content:center;
        overflow:hidden;
    }
    .img-box img{
        width:100%;
        height:100%;
        object-fit: cover;
        display:block;
    }

    .btn-save{
        border-radius: 12px;
        padding: 11px 16px;
        font-weight: 900;
        letter-spacing: .2px;
        background: linear-gradient(135deg, var(--primary), var(--primary2));
        border: 0;
        color: #fff;
        box-shadow: 0 12px 34px rgba(59,130,246,.22);
        min-width: 190px;
        cursor:pointer;
    }
    .btn-save:hover{ filter: brightness(1.05); transform: translateY(-1px); }

    .btn-back{
        border-radius: 12px;
        padding: 11px 16px;
        font-weight: 900;
        letter-spacing: .2px;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.14);
        color: rgba(255,255,255,.90);
        min-width: 190px;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:8px;
    }
    .btn-back:hover{ background: rgba(255,255,255,.10); color:#fff; text-decoration:none; }

    @media (max-width: 576px){
        .editg-body{ padding: 14px; }
        .btn-save, .btn-back{ width:100%; min-width: unset; }
    }
</style>

<div class="container-fluid editg-wrap">
    <form action="" method="POST" enctype="multipart/form-data" id="editGroupsForm">
        <div class="row">
            <div class="col-12">

                <div class="editg-card">

                    <div class="editg-head">
                        <div>
                            <h3 class="editg-title">CHỈNH SỬA GÓI HACK GAME</h3>
                            <p class="editg-sub">Cập nhật thông tin gói hack, hướng dẫn và link tải — giao diện rõ ràng, đẹp trên mọi thiết bị.</p>
                        </div>
                    </div>

                    <div class="editg-body">

                        <div class="form-section">
                            <div class="section-title"><span class="dot"></span>Thông tin gói</div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label class="f-label">Số Thứ Tự</label>
                                    <input name="stt" type="text" value="<?= $row['stt'] ?>" class="f-input" placeholder="Nhập số thứ tự ..." required>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label class="f-label">Tên Gói Hack</label>
                                    <input name="name" type="text" value="<?= $row['name'] ?>" class="f-input" placeholder="Nhập tên gói hack ..." required>
                                    <div class="f-help">Slug tự tạo theo tên khi cập nhật.</div>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label class="f-label">Danh Mục Hack</label>
                                    <select name="category" class="f-select" data-toggle="select2" required>
                                        <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_category_hack` WHERE `status` = '1' AND `id`='" . $row['cate_id'] . "'") as $cate) { ?>
                                            <option value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
                                        <?php } ?>
                                        <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_category_hack` WHERE `status`=1 ORDER BY `stt` ASC") as $cate) : ?>
                                            <option value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label class="f-label">Trạng thái</label>
                                    <select name="status" class="f-select" tabindex="-98">
                                        <option value="1" <?= $row['status'] == '1' ? 'selected' : '' ?>>Hiển thị</option>
                                        <option value="0" <?= $row['status'] == '0' ? 'selected' : '' ?>>Ẩn</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="section-title"><span class="dot"></span>Ảnh mô tả</div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="f-label">Ảnh Mô Tả</label>
                                    <div class="img-preview">
                                        <div class="img-box">
                                            <img id="imgPreview" src="<?= $row['images'] ?>" alt="preview">
                                        </div>
                                        <div style="flex:1; min-width: 220px;">
                                            <input class="f-input" type="file" name="images" id="imagesInput" accept="image/*">
                                            <div class="f-help">Không chọn ảnh mới sẽ giữ ảnh cũ.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="section-title"><span class="dot"></span>Nội dung & hướng dẫn</div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="f-label">Chức Năng</label>
                                    <textarea name="content" class="f-textarea" placeholder="Nội dung ..."><?= $row['content'] ?></textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="f-label">Hướng Dẫn Cài Đặt</label>
                                    <textarea name="tutorial" class="f-textarea" placeholder="Hướng dẫn cài đặt ..."><?= $row['tutorial'] ?></textarea>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label class="f-label">Link Tải Hack</label>
                                    <input name="link_down" type="text" value="<?= $row['link_down'] ?>" class="f-input" placeholder="Link tải hack ...">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap justify-content-center" style="gap:10px;">
                            <!-- FIX: value=1 + submit cứng -->
                            <button type="submit" name="editGroups" value="1" class="btn-save" id="btnSubmit">
                                <i class="fa fa-save"></i> Cập Nhật
                            </button>

                            <a href="main.php?action=list_groups_hack" class="btn-back">
                                <i class="fa fa-arrow-left"></i> Quay lại
                            </a>
                        </div>

                    </div><!-- /editg-body -->

                </div><!-- /editg-card -->

            </div>
        </div>
    </form>
</div>

<script>
    // Preview ảnh (UI only)
    (function(){
        const input = document.getElementById('imagesInput');
        const img = document.getElementById('imgPreview');
        if (!input || !img) return;

        input.addEventListener('change', function(){
            const f = this.files && this.files[0];
            if (!f) return;
            img.src = URL.createObjectURL(f);
        });
    })();

    // CKEditor (giữ như cũ)
    if (typeof CKEDITOR !== "undefined") {
        CKEDITOR.replace("content");
        CKEDITOR.replace("tutorial");
    }

    // FIX: Submit "cứng" để tránh JS khác chặn
    (function(){
        const form = document.getElementById('editGroupsForm');
        const btn = document.getElementById('btnSubmit');
        if (!form || !btn) return;

        btn.addEventListener('click', function(){
            if (form.reportValidity && !form.reportValidity()) return;
            form.submit();
        });
    })();
</script>