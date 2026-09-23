<?php
CheckLogin();
CheckAdmin();

if (isset($_GET['id']) && $getUser['role'] == '1') {
    $group = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_groups_hack` WHERE `id` = '" . xss($_GET['id']) . "'  ");
    if (!$group) {
        die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
}

$sotin1trang = 10;
$page = isset($_GET['page']) ? max(1, (int)xss($_GET['page'])) : 1;
$from = ($page - 1) * $sotin1trang;

// Add package
if (isset($_POST['addPackage'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }

    $isInsert = $LOCNGUYEN_SIEUTHICODE->insert("tbl_package_hack", [
        'price'     => xss($_POST['price']),
        'thoigian'  => xss($_POST['thoigian']),
        'groups_id' => $group['id'],
    ]);

    if ($isInsert) {
        die('<script type="text/javascript">if(!alert("Thêm thành công !")){window.history.back().location.reload();}</script>');
    } else {
        die('<script type="text/javascript">if(!alert("Thêm thất bại !")){window.history.back().location.reload();}</script>');
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
        --danger:#ef4444;
        --good:#22c55e;
        --shadow: 0 18px 60px rgba(0,0,0,.35);
        --radius: 16px;
        --chip: rgba(255,255,255,.08);
    }

    .pack-wrap{ padding: 14px 10px; }

    .pack-hero{
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
    .pack-hero h3{ margin:0; font-weight:900; letter-spacing:.2px; font-size:18px; }
    .pack-hero p{ margin:6px 0 0 0; color: var(--muted); font-size:13px; }

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
    }
    .cardx .body{ padding: 16px; }

    .f-label{ font-weight:800; font-size:12.5px; color: rgba(255,255,255,.85); margin-bottom:6px; display:block; }
    .f-input{
        width:100%;
        border-radius: 12px !important;
        border: 1px solid rgba(255,255,255,.14) !important;
        background: rgba(15,23,42,.65) !important;
        color: rgba(255,255,255,.92) !important;
        padding: 11px 12px !important;
        outline:none !important;
        transition:.18s ease;
    }
    .f-input:focus{ box-shadow: 0 0 0 4px var(--focus) !important; border-color: rgba(59,130,246,.55) !important; }

    .btn-add{
        border-radius: 12px;
        padding: 11px 16px;
        font-weight: 900;
        letter-spacing: .2px;
        background: linear-gradient(135deg, var(--primary), var(--primary2));
        border: 0;
        color:#fff;
        box-shadow: 0 12px 34px rgba(59,130,246,.22);
        min-width: 180px;
        cursor:pointer;
    }
    .btn-add:hover{ filter: brightness(1.05); transform: translateY(-1px); }

    .table-shell{
        border: 1px solid rgba(255,255,255,.10);
        border-radius: 14px;
        overflow:hidden;
        background: rgba(2,6,23,.25);
    }
    .table-modern{ margin:0; color: rgba(255,255,255,.92); }
    .table-modern thead th{
        background: rgba(255,255,255,.06) !important;
        color: rgba(255,255,255,.85) !important;
        font-weight: 900 !important;
        border-bottom: 1px solid rgba(255,255,255,.10) !important;
        white-space: nowrap;
        font-size: 12.5px;
        letter-spacing:.2px;
        padding: 12px 12px !important;
    }
    .table-modern tbody td{
        border-top: 1px solid rgba(255,255,255,.06) !important;
        padding: 12px 12px !important;
        vertical-align: middle !important;
        font-size: 13.5px;
        color: rgba(255,255,255,.90) !important;
    }
    .table-modern tbody tr:hover{ background: rgba(255,255,255,.03); }

    .pill{
        display:inline-flex; align-items:center; gap:8px;
        padding: 6px 10px; border-radius: 999px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.10);
        font-weight: 900; font-size: 12px;
        color: rgba(255,255,255,.88);
        white-space: nowrap;
    }

    .btn-icon{
        border-radius: 12px !important;
        border: 1px solid rgba(255,255,255,.12) !important;
        background: rgba(255,255,255,.06) !important;
        color: rgba(255,255,255,.92) !important;
        padding: 8px 10px !important;
        display:inline-flex;
        align-items:center;
        gap:8px;
        text-decoration:none !important;
        transition:.18s ease;
        white-space:nowrap;
    }
    .btn-icon:hover{ transform: translateY(-1px); background: rgba(255,255,255,.10) !important; color:#fff !important; }
    .btn-icon.dark{ border-color: rgba(255,255,255,.14) !important; }
    .btn-icon.edit{ border-color: rgba(59,130,246,.35) !important; }
    .btn-icon.del{ border-color: rgba(239,68,68,.35) !important; }

    @media (max-width: 576px){
        .cardx .body{ padding: 14px; }
        .btn-add{ width:100%; min-width: unset; }
    }
</style>

<div class="container-fluid pack-wrap">

    <div class="pack-hero">
        <h3>Quản Lý Gói Hack</h3>
        <p>
            Nhóm: <span class="chip"><span class="dot good"></span><?= $group['name'] ?></span>
            <span class="chip"><span class="dot"></span>ID nhóm: <?= $group['id'] ?></span>
        </p>
    </div>

    <div class="row">
        <!-- FORM THÊM GÓI -->
        <div class="col-12">
            <div class="cardx">
                <div class="head">
                    <p class="title"><span class="dot good"></span>Thêm gói mới</p>
                </div>
                <div class="body">
                    <form action="" method="POST" enctype="multipart/form-data" id="addPackageForm">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label class="f-label">Giá Tiền</label>
                                <input name="price" type="number" min="1" class="f-input" placeholder="Nhập giá tiền" required>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-3">
                                <label class="f-label">Thời gian (giờ)</label>
                                <input name="thoigian" type="number" min="1" class="f-input" placeholder="Nhập số giờ" required>
                            </div>

                            <div class="col-lg-4 col-md-12 mb-3 d-flex align-items-end">
                                <!-- FIX: value=1 + submit cứng -->
                                <button type="submit" name="addPackage" value="1" class="btn-add" id="btnAddPackage">
                                    <i class="fa fa-plus"></i> THÊM NGAY
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- LIST GÓI -->
        <div class="col-12 mt-3">
            <div class="cardx">
                <div class="head">
                    <p class="title"><span class="dot"></span>Danh sách gói hack</p>
                </div>
                <div class="body">
                    <div class="table-shell">
                        <div class="table-responsive">
                            <table class="table table-modern">
                                <thead>
                                    <tr>
                                        <th style="width: 6%">#ID</th>
                                        <th>Thời Gian</th>
                                        <th>Giá Tiền</th>
                                        <th style="width: 26%">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $list = $LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_package_hack` WHERE `groups_id`='" . $group['id'] . "' ORDER BY `id` DESC LIMIT $from,$sotin1trang");
                                    ?>
                                    <?php if (!empty($list)) : foreach ($list as $pk) : ?>
                                        <tr>
                                            <td><?= $pk['id'] ?></td>
                                            <td><span class="pill"><span class="dot good"></span><?= $pk['thoigian'] ?> Giờ</span></td>
                                            <td><span class="pill"><span class="dot bad"></span><?= format_cash($pk['price']) ?>đ</span></td>
                                            <td>
                                                <div class="d-flex flex-wrap" style="gap:8px;">
                                                    <a href="main.php?action=list_license_hack&id=<?= $pk['id'] ?>" class="btn-icon dark">
                                                        <i class="fa fa-list"></i> Quản Lý License
                                                    </a>
                                                    <a href="main.php?action=edit_list_package_hack&id=<?= $pk['id'] ?>" class="btn-icon edit" title="Chỉnh sửa">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button onclick="RemoveRow(<?= $pk['id'] ?>)" type="button" class="btn-icon del" title="Xóa">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; else: ?>
                                        <tr><td colspan="4">Chưa có gói nào.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php
                    // FIX pagination: đếm đúng bảng + đúng groups_id
                    $tong = (int)$LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `tbl_package_hack` WHERE `groups_id`='" . $group['id'] . "' ");
                    if ($tong > $sotin1trang) {
                        // FIX link: đúng action của trang này + giữ id nhóm
                        echo '<center>' . pagination_account('main.php?action=list_package_hack&id=' . $group['id'] . '&', $from, $tong, $sotin1trang) . '</center>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // FIX: submit cứng để tránh JS khác chặn submit
    (function(){
        const form = document.getElementById('addPackageForm');
        const btn  = document.getElementById('btnAddPackage');
        if (!form || !btn) return;

        btn.addEventListener('click', function(){
            if (form.reportValidity && !form.reportValidity()) return;
            form.submit();
        });
    })();

    function RemoveRow(id) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Xóa Gói",
            message: "Bạn có chắc chắn muốn xóa gói này có thể ảnh hưởng đến thông tin của khách hàng không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
        }).then((e) => {
            if (e) {
                $.ajax({
                    url: "/ajaxs/action/removePacket.php",
                    method: "POST",
                    dataType: "JSON",
                    data: { action: "delete", id: id },
                    success: function(respone) {
                        if (respone.status == 'success') {
                            cuteToast({ type: "success", message: respone.msg, timer: 1000 });
                            location.reload();
                        } else {
                            cuteAlert({ type: "error", title: "Error", message: respone.msg, buttonText: "Okay" });
                        }
                    }
                });
            }
        })
    }
</script>