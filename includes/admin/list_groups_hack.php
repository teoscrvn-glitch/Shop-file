<?php
CheckLogin();
CheckAdmin();
?>

<style>
    :root{
        --bg-card: #0b1222;
        --bg-card-2:#0f1b33;
        --border: rgba(255,255,255,.10);
        --muted: rgba(255,255,255,.70);
        --text: rgba(255,255,255,.92);
        --shadow: 0 18px 60px rgba(0,0,0,.35);
        --radius: 16px;
        --primary:#3b82f6;
        --primary2:#2563eb;
        --danger:#ef4444;
        --chip: rgba(255,255,255,.08);
    }

    .page-wrap{ padding: 14px 10px; }

    .card-pro{
        background: linear-gradient(180deg, rgba(11,18,34,.98), rgba(15,27,51,.98));
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow:hidden;
    }

    .head-pro{
        padding: 16px 18px;
        border-bottom: 1px solid var(--border);
        background:
            radial-gradient(900px 220px at 10% 0%, rgba(59,130,246,.28), transparent 60%),
            radial-gradient(900px 240px at 90% 0%, rgba(34,197,94,.14), transparent 55%);
        display:flex;
        align-items:flex-start;
        justify-content:space-between;
        gap:12px;
        flex-wrap:wrap;
    }
    .title-pro{
        margin:0;
        font-weight: 900;
        letter-spacing:.2px;
        font-size: 18px;
        color: var(--text);
        line-height: 1.2;
    }
    .sub-pro{
        margin:6px 0 0 0;
        font-size: 13px;
        color: var(--muted);
        line-height: 1.35;
    }

    .actions-pro{
        display:flex;
        align-items:center;
        gap:10px;
        flex-wrap:wrap;
        justify-content:flex-end;
    }
    .btn-add{
        border-radius: 12px;
        padding: 10px 14px;
        font-weight: 900;
        letter-spacing: .2px;
        background: linear-gradient(135deg, var(--primary), var(--primary2));
        border: 0;
        color: #fff;
        box-shadow: 0 12px 34px rgba(59,130,246,.22);
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:8px;
        white-space:nowrap;
    }
    .btn-add:hover{ filter: brightness(1.05); transform: translateY(-1px); color:#fff; text-decoration:none; }

    .btn-more{
        border-radius: 12px !important;
        border: 1px solid var(--border) !important;
        background: rgba(255,255,255,.06) !important;
        color: rgba(255,255,255,.85) !important;
        padding: 10px 12px !important;
        display:inline-flex;
        align-items:center;
        justify-content:center;
    }

    .body-pro{ padding: 18px; }

    .table-shell{
        border: 1px solid var(--border);
        border-radius: 14px;
        background: rgba(2,6,23,.25);
        overflow:hidden;
    }

    table.table-pro{ margin:0; color: rgba(255,255,255,.92); }
    table.table-pro thead th{
        background: rgba(255,255,255,.06) !important;
        color: rgba(255,255,255,.85) !important;
        font-weight: 900 !important;
        border-bottom: 1px solid var(--border) !important;
        white-space: nowrap;
        font-size: 12.5px;
        letter-spacing:.2px;
        padding: 14px 12px !important;
    }
    table.table-pro tbody td{
        border-top: 1px solid rgba(255,255,255,.06) !important;
        padding: 14px 12px !important;
        vertical-align: middle !important;
        font-size: 13.5px;
        color: rgba(255,255,255,.92) !important;
    }
    table.table-pro tbody tr:hover{ background: rgba(255,255,255,.03); }

    .chip{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding: 6px 10px;
        border-radius: 999px;
        background: var(--chip);
        border: 1px solid rgba(255,255,255,.10);
        font-weight: 900;
        font-size: 12px;
        color: rgba(255,255,255,.88);
        white-space: nowrap;
    }
    .dot{
        width:9px;height:9px;border-radius:50%;
        background: rgba(255,255,255,.45);
        box-shadow: 0 0 0 4px rgba(255,255,255,.08);
    }

    .img-thumb{
        width: 92px;
        height: 56px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,.10);
        overflow:hidden;
        background: rgba(255,255,255,.05);
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .img-thumb img{
        width:100%;
        height:100%;
        object-fit: cover;
        display:block;
    }

    .btn-act{
        border-radius: 12px !important;
        padding: 9px 12px !important;
        font-weight: 900 !important;
        letter-spacing: .15px;
        border: 1px solid rgba(255,255,255,.12) !important;
        background: rgba(255,255,255,.06) !important;
        color: rgba(255,255,255,.92) !important;
        display:inline-flex;
        align-items:center;
        gap:8px;
        white-space:nowrap;
        transition:.18s ease;
        text-decoration:none !important;
    }
    .btn-act:hover{ transform: translateY(-1px); background: rgba(255,255,255,.10) !important; color:#fff !important; }
    .btn-act.list{ border-color: rgba(255,255,255,.18) !important; }
    .btn-act.edit{ border-color: rgba(59,130,246,.35) !important; }
    .btn-act.del{ border-color: rgba(239,68,68,.35) !important; }

    @media (max-width: 576px){
        .body-pro{ padding: 14px; }
        .btn-add{ width:100%; justify-content:center; }
        .actions-pro{ width:100%; justify-content:flex-start; }
        .btn-act{ width:100%; justify-content:center; }
    }
</style>

<div class="container-fluid page-wrap">
    <div class="row">
        <div class="col-12">

            <div class="card-pro">

                <div class="head-pro">
                    <div>
                        <h4 class="title-pro">Danh Sách Nhóm Hack Game</h4>
                        <p class="sub-pro">Quản lý nhóm hack: xem, sửa, xóa và vào “Quản Lý Gói”. Giao diện rõ ràng trên mọi thiết bị.</p>
                    </div>

                    <div class="actions-pro">
                        <a class="btn-add" href="main.php?action=add_groups_hack">
                            <i class="fa fa-plus"></i> Tạo Gói Mới
                        </a>

                        <div class="dropdown sub-dropdown">
                            <button class="btn btn-more dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                <a class="dropdown-item" href="main.php?action=add_groups_hack">Tạo Gói Mới</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="body-pro">
                    <div class="table-shell">
                        <div class="table-responsive">
                            <table class="table table-pro no-wrap v-middle mb-0">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0">#ID</th>
                                        <th class="border-0">Hình Ảnh</th>
                                        <th class="border-0">Tên Gói Hack</th>
                                        <th class="border-0">Thuộc Danh Mục</th>
                                        <th class="border-0">Thứ Tự</th>
                                        <th class="border-0">Trạng Thái</th>
                                        <th class="border-0">Ngày Tạo</th>
                                        <th class="border-0">Cập Nhật</th>
                                        <th class="border-0">Thao Tác</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_groups_hack` ORDER BY `stt` ASC") as $row) : ?>
                                        <tr>
                                            <td class="border-top-0">
                                                <span class="chip"><span class="dot"></span>#<?= $row['id'] ?></span>
                                            </td>

                                            <td class="border-top-0">
                                                <div class="img-thumb">
                                                    <img src="<?= $row['images'] ?>" width="100" alt="" onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
                                                </div>
                                            </td>

                                            <td class="border-top-0" style="font-weight:900;">
                                                <?= $row['name'] ?>
                                            </td>

                                            <td class="border-top-0">
                                                <span class="chip"><span class="dot"></span><?= getRowRealtime('tbl_category_hack',$row['cate_id'],'name') ?></span>
                                            </td>

                                            <td class="border-top-0">
                                                <span class="chip"><span class="dot"></span><?= $row['stt'] ?></span>
                                            </td>

                                            <td class="border-top-0">
                                                <?= status_cate($row['status']) ?>
                                            </td>

                                            <td class="border-top-0"><?= $row['create_date'] ?></td>
                                            <td class="border-top-0"><?= $row['update_date'] ?></td>

                                            <td class="border-top-0">
                                                <div class="d-flex flex-wrap" style="gap:8px;">
                                                    <a href="main.php?action=list_package_hack&id=<?= $row['id'] ?>"
                                                       class="btn-act list">
                                                        <i class="fa fa-list"></i> Quản Lý Gói
                                                    </a>

                                                    <a href="main.php?action=edit_groups_hack&id=<?= $row['id'] ?>"
                                                       class="btn-act edit" title="Sửa">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <button onclick="RemoveRow(<?= $row['id'] ?>)" type="button"
                                                            class="btn-act del" title="Xóa">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    function RemoveRow(id) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Xóa Danh Mục",
            message: "Bạn có chắc chắn muốn xóa danh mục này không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
        }).then((res) => {

            const confirmed =
                res === true ||
                res === "confirm" ||
                (res && res.value === true) ||
                (res && res.isConfirmed === true);

            if (!confirmed) return;

            $.ajax({
                url: "/ajaxs/action/removeGroup.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    action: "delete",
                    id: id
                },
                success: function(respone) {
                    if (respone && respone.status == 'success') {
                        cuteToast({
                            type: "success",
                            message: respone.msg,
                            timer: 1000
                        });
                        setTimeout(() => location.reload(), 600);
                    } else {
                        cuteAlert({
                            type: "error",
                            title: "Error",
                            message: (respone && respone.msg) ? respone.msg : "Xóa thất bại (phản hồi không hợp lệ).",
                            buttonText: "Okay"
                        });
                    }
                },
                error: function(xhr) {
                    let msg = "Không thể xóa. Server có thể đang trả về lỗi/HTML thay vì JSON.";
                    if (xhr && xhr.responseText) {
                        msg += "\n\n" + xhr.responseText.substring(0, 300);
                    }
                    cuteAlert({
                        type: "error",
                        title: "AJAX Error",
                        message: msg,
                        buttonText: "Okay"
                    });
                }
            });
        });
    }
</script>