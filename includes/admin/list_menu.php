<?php
CheckLogin();
CheckAdmin();
?>

<style>
    :root{
        --card:#0f172a;
        --card2:#0b142c;
        --border: rgba(255,255,255,.10);
        --muted: rgba(255,255,255,.70);
        --text: rgba(255,255,255,.92);
        --shadow: 0 18px 60px rgba(0,0,0,.35);
        --radius: 16px;
        --primary:#3b82f6;
        --primary2:#2563eb;
        --danger:#ef4444;
        --good:#22c55e;
        --chip: rgba(255,255,255,.08);
    }

    .menu-wrap{ padding: 14px 10px; }

    .menu-card{
        background: linear-gradient(180deg, rgba(15,23,42,.96), rgba(11,20,44,.96));
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .menu-head{
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
    .menu-title{
        margin:0;
        font-weight: 900;
        letter-spacing:.2px;
        font-size: 18px;
        color: var(--text);
        line-height: 1.2;
    }
    .menu-sub{
        margin:6px 0 0 0;
        font-size: 13px;
        color: var(--muted);
        line-height: 1.35;
    }

    .menu-actions{
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

    .menu-body{ padding: 18px; }

    .table-shell{
        border: 1px solid var(--border);
        border-radius: 14px;
        background: rgba(2,6,23,.25);
        overflow:hidden;
    }
    .table-modern{
        margin:0;
        color: rgba(255,255,255,.9);
    }
    .table-modern thead th{
        background: rgba(255,255,255,.06) !important;
        color: rgba(255,255,255,.85) !important;
        font-weight: 900 !important;
        border-bottom: 1px solid var(--border) !important;
        white-space: nowrap;
        font-size: 12.5px;
        letter-spacing:.2px;
        padding: 14px 12px !important;
    }
    .table-modern tbody td{
        border-top: 1px solid rgba(255,255,255,.06) !important;
        padding: 14px 12px !important;
        vertical-align: middle !important;
        font-size: 13.5px;
        color: rgba(255,255,255,.90) !important;
    }
    .table-modern tbody tr:hover{
        background: rgba(255,255,255,.03);
    }

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
    .dot.good{ background: var(--good); box-shadow:0 0 0 4px rgba(34,197,94,.15); }
    .dot.bad{ background: var(--danger); box-shadow:0 0 0 4px rgba(239,68,68,.15); }

    .btn-icon{
        width: 36px;
        height: 36px;
        border-radius: 12px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.06);
        color: rgba(255,255,255,.92);
        transition: .18s ease;
        text-decoration:none;
    }
    .btn-icon:hover{ transform: translateY(-1px); background: rgba(255,255,255,.10); color:#fff; text-decoration:none; }
    .btn-icon.edit{ border-color: rgba(59,130,246,.35); }
    .btn-icon.del{ border-color: rgba(239,68,68,.35); }

    @media (max-width: 576px){
        .menu-body{ padding: 14px; }
        .btn-add{ width:100%; justify-content:center; }
        .menu-actions{ width:100%; justify-content:flex-start; }
    }
</style>

<div class="container-fluid menu-wrap">
    <div class="row">
        <div class="col-12">

            <div class="menu-card">

                <div class="menu-head">
                    <div>
                        <h4 class="menu-title">Danh Sách Menu</h4>
                        <p class="menu-sub">Quản lý menu: xem, sửa, xóa — giao diện rõ ràng, đẹp trên mọi thiết bị.</p>
                    </div>

                    <div class="menu-actions">
                        <a class="btn-add" href="main.php?action=add_menu">
                            <i class="fa fa-plus"></i> Tạo menu mới
                        </a>

                        <div class="dropdown sub-dropdown">
                            <button class="btn btn-more dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                <a class="dropdown-item" href="main.php?action=add_menu">Tạo menu mới</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="menu-body">
                    <div class="table-shell">
                        <div class="table-responsive">
                            <table class="table table-modern no-wrap v-middle">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0">#ID</th>
                                        <th class="border-0">Tên Menu</th>
                                        <th class="border-0">Thứ Tự</th>
                                        <th class="border-0">Trạng Thái</th>
                                        <th class="border-0">Thao Tác</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_menu` ORDER BY `stt` ASC") as $row) : ?>
                                        <tr>
                                            <td class="border-top-0">
                                                <span class="chip"><span class="dot"></span>#<?= $row['id'] ?></span>
                                            </td>

                                            <td class="border-top-0" style="font-weight:900;">
                                                <?= $row['name'] ?>
                                            </td>

                                            <td class="border-top-0">
                                                <span class="chip"><span class="dot"></span><?= $row['stt'] ?></span>
                                            </td>

                                            <td class="border-top-0">
                                                <?php if ((string)$row['status'] === '1'): ?>
                                                    <span class="chip"><span class="dot good"></span>Hiển thị</span>
                                                <?php else: ?>
                                                    <span class="chip"><span class="dot bad"></span>Ẩn</span>
                                                <?php endif; ?>
                                                <!-- Nếu bạn muốn hiển thị đúng format cũ:
                                                <?= status_cate($row['status']) ?>
                                                -->
                                            </td>

                                            <td class="border-top-0">
                                                <div class="d-flex" style="gap:8px; flex-wrap:wrap;">
                                                    <a href="main.php?action=edit_menu&id=<?= $row['id'] ?>"
                                                       class="btn-icon edit" title="Sửa">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <button onclick="RemoveRow(<?= $row['id'] ?>)" type="button"
                                                            class="btn-icon del" title="Xóa">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div><!-- /table-responsive -->
                    </div><!-- /table-shell -->
                </div><!-- /menu-body -->

            </div><!-- /menu-card -->

        </div>
    </div>
</div>

<script>
    function RemoveRow(id) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Xóa Menu",
            message: "Bạn có chắc chắn muốn xóa menu này không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
        }).then((e) => {
            if (e) {
                $.ajax({
                    url: "/ajaxs/action/removeMenu.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        action: "delete",
                        id: id
                    },
                    success: function(respone) {
                        if (respone.status == 'success') {
                            cuteToast({
                                type: "success",
                                message: respone.msg,
                                timer: 1000
                            });
                            location.reload();
                        } else {
                            cuteAlert({
                                type: "error",
                                title: "Error",
                                message: respone.msg,
                                buttonText: "Okay"
                            });
                        }
                    },
                    error: function() {
                        alert(html(response));
                        location.reload();
                    }
                });
            }
        })
    }
</script>