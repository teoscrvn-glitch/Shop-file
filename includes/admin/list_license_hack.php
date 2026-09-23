<?php
CheckLogin();
CheckAdmin();
?>

<?php
if (isset($_GET['id'])) {
    $id = xss($_GET['id']);
    $row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_package_hack` WHERE `id` = '$id' ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
}
?>

<?php
// ADD LICENSE
if (isset($_POST['AddLicense']) && isset($_POST['license'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }

    $value_add = 0;
    $value_update = 0;

    $list = xss($_POST['license']);
    $list = explode(PHP_EOL, $list);

    foreach ($list as $license) {
        $license = trim($license);
        if ($license === '') continue;

        if (isset($_POST['loc_trung']) && $_POST['loc_trung'] == 1) {
            $isAdd = $LOCNGUYEN_SIEUTHICODE->insert("tbl_license", [
                'package_id'    => $row['id'],
                'license'       => $license,
                'status'        => '1',
                'create_date'   => gettime(),
                'update_date'   => gettime()
            ]);
            if ($isAdd) $value_add++;
        } else {
            if ($LOCNGUYEN_SIEUTHICODE->get_row(" SELECT COUNT(id) FROM `tbl_license` WHERE `license` = '$license' ")['COUNT(id)'] == 0) {
                $isAdd = $LOCNGUYEN_SIEUTHICODE->insert("tbl_license", [
                    'package_id'    => $row['id'],
                    'license'       => $license,
                    'status'        => '1',
                    'create_date'   => gettime()
                ]);
                if ($isAdd) $value_add++;
            } else {
                $row_taikhoan = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_license` WHERE `license` = '$license' ");
                if (isset($_POST['filter']) && $_POST['filter'] == 1) {
                    $isUpdate = $LOCNGUYEN_SIEUTHICODE->update("tbl_license", array(
                        'status'      => '1',
                        'update_date' => gettime(),
                    ), " `id` = '" . $row_taikhoan['id'] . "' ");
                    if ($isUpdate) $value_update++;
                } else {
                    $isUpdate = $LOCNGUYEN_SIEUTHICODE->update("tbl_license", array(
                        'status'      => '1',
                        'update_date' => gettime(),
                    ), " `id` = '" . $row_taikhoan['id'] . "' ");
                    if ($isUpdate) $value_add++;
                }
            }
        }
    }

    die('<script type="text/javascript">if(!alert("Thêm ' . $value_add . ' | Cập nhật ' . $value_update . ' thành công")){window.history.back().location.reload();}</script>');
}

// REMOVE LICENSE
if (isset($_POST['RemoveLicense']) && isset($_POST['license'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }

    $list = xss($_POST['license']);
    $list = explode(PHP_EOL, $list);

    $value_delete = 0;

    foreach ($list as $license) {
        $license = trim($license);
        if ($license === '') continue;

        if (isset($_POST['filter']) && $_POST['filter'] == 1) {
            $isRemove = $LOCNGUYEN_SIEUTHICODE->remove("tbl_license", " `license` = '" . $license . "'  ");
            if ($isRemove) $value_delete++;
        } else {
            $isRemove = $LOCNGUYEN_SIEUTHICODE->remove("tbl_license", " `license` = '" . $license . "' AND `status` = '1' ");
            if ($isRemove) $value_delete++;
        }
    }

    die('<script type="text/javascript">if(!alert("Xoá thành công ' . $value_delete . ' license! ")){window.history.back().location.reload();}</script>');
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
        --danger:#ef4444;
        --good:#22c55e;
        --shadow: 0 18px 60px rgba(0,0,0,.35);
        --radius: 16px;
        --chip: rgba(255,255,255,.08);
    }

    .lic-wrap{ padding: 14px 10px; }

    .lic-hero{
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        overflow:hidden;
        background:
            radial-gradient(1100px 260px at 10% 0%, rgba(59,130,246,.28), transparent 60%),
            radial-gradient(1100px 280px at 90% 0%, rgba(34,197,94,.14), transparent 55%),
            linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        padding: 16px 18px;
        color: var(--text);
        margin-bottom: 14px;
    }
    .lic-hero h3{ margin:0; font-weight:900; letter-spacing:.2px; font-size:18px; }
    .lic-hero p{ margin:6px 0 0 0; color: var(--muted); font-size:13px; line-height:1.4; }

    .chip{
        display:inline-flex; align-items:center; gap:8px;
        padding: 6px 10px; border-radius: 999px;
        background: var(--chip);
        border: 1px solid rgba(255,255,255,.10);
        font-weight: 900; font-size: 12px;
        color: rgba(255,255,255,.88);
        white-space: nowrap;
    }
    .dot{ width:9px; height:9px; border-radius:50%;
        background: rgba(255,255,255,.45);
        box-shadow: 0 0 0 4px rgba(255,255,255,.08);
    }
    .dot.good{ background: var(--good); box-shadow:0 0 0 4px rgba(34,197,94,.15); }
    .dot.bad{ background: var(--danger); box-shadow:0 0 0 4px rgba(239,68,68,.15); }

    .cardx{
        background: linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow:hidden;
        height: 100%;
    }
    .cardx .head{
        padding: 14px 16px;
        border-bottom: 1px solid var(--border);
        display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap;
    }
    .cardx .title{
        margin:0; font-size: 13px; font-weight: 900;
        color: rgba(255,255,255,.92); letter-spacing:.2px;
        display:flex; align-items:center; gap:10px;
        text-transform: uppercase;
    }
    .cardx .body{ padding: 16px; }

    .f-label{ font-weight:800; font-size:12.5px; color: rgba(255,255,255,.85); margin-bottom:6px; display:block; }
    .f-help{ margin-top: 6px; font-size: 12px; color: rgba(255,255,255,.65); line-height:1.35; }

    .f-input,.f-textarea{
        width:100%;
        border-radius: 12px !important;
        border: 1px solid rgba(255,255,255,.14) !important;
        background: rgba(15,23,42,.65) !important;
        color: rgba(255,255,255,.92) !important;
        padding: 11px 12px !important;
        outline:none !important;
        transition:.18s ease;
    }
    .f-textarea{ min-height: 210px; resize: vertical; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
    .f-input:focus,.f-textarea:focus{ box-shadow: 0 0 0 4px var(--focus) !important; border-color: rgba(59,130,246,.55) !important; }

    .btnx{
        border-radius: 12px;
        padding: 11px 16px;
        font-weight: 900;
        letter-spacing: .2px;
        border: 0;
        color:#fff;
        min-width: 170px;
        cursor:pointer;
        display:inline-flex;
        align-items:center;
        gap:10px;
        justify-content:center;
        transition:.18s ease;
    }
    .btnx:hover{ filter: brightness(1.05); transform: translateY(-1px); }
    .btn-good{ background: linear-gradient(135deg, #22c55e, #16a34a); box-shadow: 0 12px 34px rgba(34,197,94,.18); }
    .btn-bad{ background: linear-gradient(135deg, #ef4444, #dc2626); box-shadow: 0 12px 34px rgba(239,68,68,.18); }
    .btn-copy{ background: linear-gradient(135deg, var(--primary), var(--primary2)); box-shadow: 0 12px 34px rgba(59,130,246,.22); }

    .checkline{
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.06);
        border-radius: 12px;
        padding: 10px 12px;
        display:flex;
        gap:10px;
        align-items:flex-start;
        color: rgba(255,255,255,.86);
    }
    .checkline input{ margin-top: 3px; }
    .checkline label{ margin:0; font-size: 13px; line-height:1.35; font-weight: 700; cursor:pointer; }

    @media (max-width: 992px){
        .lic-hero{ padding: 14px 14px; }
    }
    @media (max-width: 576px){
        .cardx .body{ padding: 14px; }
        .btnx{ width:100%; min-width: unset; }
    }
</style>

<div class="container-fluid lic-wrap">

    <div class="lic-hero">
        <h3>Quản Lý License</h3>
        <p>
            <span class="chip"><span class="dot"></span>Package ID: <?= $row['id'] ?></span>
            <span class="chip"><span class="dot good"></span><?= format_cash($row['price']) ?>đ</span>
            <span class="chip"><span class="dot"></span><?= format_cash($row['thoigian']) ?> Giờ</span>
        </p>
    </div>

    <?php
        $count_free = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `tbl_license` WHERE `package_id` = '" . $row['id'] . "' AND `status` = '1' ")['COUNT(id)'];
        $count_rent = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT COUNT(id) FROM `tbl_license` WHERE `package_id` = '" . $row['id'] . "' AND `status` = '0' ")['COUNT(id)'];
    ?>

    <div class="row">
        <!-- ADD -->
        <div class="col-lg-6 mb-3">
            <div class="cardx">
                <div class="head">
                    <p class="title"><span class="dot good"></span>Thêm License</p>
                    <span class="chip"><span class="dot good"></span>Chưa thuê: <?= $count_free ?></span>
                </div>
                <div class="body">
                    <form action="" method="POST" enctype="multipart/form-data" id="addLicenseForm">
                        <label class="f-label">Loại gói</label>
                        <input type="text" class="f-input" value="<?= format_cash($row['price']) ?>đ/<?= format_cash($row['thoigian']) ?> Giờ" readonly>

                        <div class="mt-3">
                            <label class="f-label">Danh sách License</label>
                            <textarea name="license" rows="8" class="f-textarea" placeholder="1 dòng 1 license" required></textarea>
                            <div class="f-help">Mỗi dòng 1 license. Hệ thống sẽ thêm/cập nhật theo các tùy chọn bên dưới.</div>
                        </div>

                        <div class="mt-3">
                            <div class="checkline">
                                <input class="custom-control-input" type="checkbox" name="filter" value="1" id="add_filter" checked>
                                <label for="add_filter">Nếu tích ô này, hệ thống sẽ <b>chỉ thêm các License chưa thuê</b>.</label>
                            </div>
                            <div class="checkline mt-2">
                                <input class="custom-control-input" type="checkbox" name="loc_trung" value="1" id="add_loc_trung">
                                <label for="add_loc_trung">Nếu tích ô này, hệ thống sẽ <b>không lọc trùng</b> License đã thêm.</label>
                            </div>
                        </div>

                        <!-- FIX: value=1 + submit cứng -->
                        <button type="submit" name="AddLicense" value="1" class="btnx btn-good mt-3" id="btnAddLicense">
                            <i class="fa fa-plus"></i> Thêm Ngay
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- REMOVE -->
        <div class="col-lg-6 mb-3">
            <div class="cardx">
                <div class="head">
                    <p class="title"><span class="dot bad"></span>Xóa License</p>
                    <span class="chip"><span class="dot bad"></span>Đã thuê: <?= $count_rent ?></span>
                </div>
                <div class="body">
                    <form action="" method="POST" enctype="multipart/form-data" id="removeLicenseForm">
                        <label class="f-label">Loại gói</label>
                        <input type="text" class="f-input" value="<?= format_cash($row['price']) ?>đ/<?= format_cash($row['thoigian']) ?> Giờ" readonly>

                        <div class="mt-3">
                            <label class="f-label">Danh sách License</label>
                            <textarea name="license" rows="8" class="f-textarea" placeholder="1 dòng 1 license" required></textarea>
                        </div>

                        <div class="mt-3">
                            <div class="checkline">
                                <input class="custom-control-input" type="checkbox" name="filter" value="1" id="remove_filter">
                                <label for="remove_filter">Xóa license <b>bao gồm</b> license đã thuê.</label>
                            </div>
                        </div>

                        <!-- FIX: value=1 + submit cứng -->
                        <button type="submit" name="RemoveLicense" value="1" class="btnx btn-bad mt-3" id="btnRemoveLicense">
                            <i class="fa fa-trash"></i> Xóa Ngay
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- FREE LIST -->
        <div class="col-lg-6 mb-3">
            <div class="cardx">
                <div class="head">
                    <p class="title"><span class="dot good"></span>Danh sách chưa thuê</p>
                    <span class="chip"><span class="dot good"></span><?= $count_free ?> License</span>
                </div>
                <div class="body">
                    <label class="f-label">List</label>
                    <textarea id="listchuathue" class="f-textarea" rows="10" readonly><?php
                        foreach ($LOCNGUYEN_SIEUTHICODE->get_list(" SELECT * FROM `tbl_license` WHERE `package_id` = '" . $row['id'] . "' AND `status` = '1' ") as $live) {
                            echo trim($live['license']) . "\n";
                        }
                    ?></textarea>

                    <button type="button" class="btnx btn-copy mt-3 copy" data-clipboard-target="#listchuathue">
                        <i class="fa fa-copy"></i> Sao chép
                    </button>
                </div>
            </div>
        </div>

        <!-- RENTED LIST -->
        <div class="col-lg-6 mb-3">
            <div class="cardx">
                <div class="head">
                    <p class="title"><span class="dot bad"></span>Danh sách đã thuê</p>
                    <span class="chip"><span class="dot bad"></span><?= $count_rent ?> License</span>
                </div>
                <div class="body">
                    <label class="f-label">List</label>
                    <textarea id="listdathue" class="f-textarea" rows="10" readonly><?php
                        foreach ($LOCNGUYEN_SIEUTHICODE->get_list(" SELECT * FROM `tbl_license` WHERE `package_id` = '" . $row['id'] . "' AND `status` = '0' ORDER BY id DESC ") as $live) {
                            echo trim($live['license']) . "\n";
                        }
                    ?></textarea>

                    <button type="button" class="btnx btn-copy mt-3 copy" data-clipboard-target="#listdathue">
                        <i class="fa fa-copy"></i> Sao chép
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script>
    // clipboard
    new ClipboardJS(".copy");

    function toastCopied(){
        if (typeof swal !== "undefined") {
            swal({ title: 'Thành công', type: 'success', text: "Đã sao chép vào bộ nhớ tạm" });
        } else {
            alert("Đã sao chép vào bộ nhớ tạm");
        }
    }

    // click copy -> thông báo
    document.querySelectorAll('.copy').forEach(btn=>{
        btn.addEventListener('click', function(){
            setTimeout(toastCopied, 50);
        });
    });

    // FIX: submit cứng để tránh JS khác chặn
    (function(){
        const addForm = document.getElementById('addLicenseForm');
        const addBtn  = document.getElementById('btnAddLicense');
        if (addForm && addBtn){
            addBtn.addEventListener('click', function(){
                if (addForm.reportValidity && !addForm.reportValidity()) return;
                addForm.submit();
            });
        }

        const rmForm = document.getElementById('removeLicenseForm');
        const rmBtn  = document.getElementById('btnRemoveLicense');
        if (rmForm && rmBtn){
            rmBtn.addEventListener('click', function(){
                if (rmForm.reportValidity && !rmForm.reportValidity()) return;
                rmForm.submit();
            });
        }
    })();
</script>