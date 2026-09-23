<?php
CheckLogin();
CheckAdmin();
?>

<?php
if (isset($_POST['ThemNganHang'])) {
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
        }
    }

    $isInsert = $LOCNGUYEN_SIEUTHICODE->insert("bank", [
        'logo'      => $url_image,
        'ghichu'    => $_POST['ghichu'],
        'name'      => xss($_POST['name']),
        'stk'       => xss($_POST['stk']),
        'bank_name' => xss($_POST['bank_name'])
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

    .bank-wrap{ padding: 14px 10px; }

    .bank-hero{
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
    .bank-hero h3{ margin:0; font-weight:900; letter-spacing:.2px; font-size:18px; }
    .bank-hero p{ margin:6px 0 0 0; color: var(--muted); font-size:13px; line-height:1.4; }

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
        text-transform: uppercase;
    }
    .dot{ width:9px; height:9px; border-radius:50%;
        background: rgba(255,255,255,.45);
        box-shadow: 0 0 0 4px rgba(255,255,255,.08);
    }
    .dot.good{ background: var(--good); box-shadow:0 0 0 4px rgba(34,197,94,.15); }

    .cardx .body{ padding: 16px; }

    .f-label{ font-weight:800; font-size:12.5px; color: rgba(255,255,255,.85); margin-bottom:6px; display:block; }
    .f-help{ margin-top: 6px; font-size: 12px; color: rgba(255,255,255,.65); line-height:1.35; }

    .f-input,.f-textarea,.f-select{
        width:100%;
        border-radius: 12px !important;
        border: 1px solid rgba(255,255,255,.14) !important;
        background: rgba(15,23,42,.65) !important;
        color: rgba(255,255,255,.92) !important;
        padding: 11px 12px !important;
        outline:none !important;
        transition:.18s ease;
    }
    .f-textarea{ min-height: 130px; resize: vertical; }
    .f-input:focus,.f-textarea:focus,.f-select:focus{
        box-shadow: 0 0 0 4px var(--focus) !important;
        border-color: rgba(59,130,246,.55) !important;
    }

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

    .logo-prev{
        width: 92px;
        height: 92px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
        overflow:hidden;
        display:flex;
        align-items:center;
        justify-content:center;
        color: rgba(255,255,255,.65);
        font-weight: 900;
        font-size: 12px;
    }
    .logo-prev img{ width:100%; height:100%; object-fit: cover; display:block; }

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
    .btn-icon.del{ border-color: rgba(239,68,68,.35) !important; }

    @media (max-width: 576px){
        .cardx .body{ padding: 14px; }
        .btn-add{ width:100%; min-width: unset; }
    }
</style>

<div class="container-fluid bank-wrap">

    <div class="bank-hero">
        <h3>Ngân Hàng Nạp Tiền</h3>
        <p>Thêm tài khoản ngân hàng hiển thị cho người dùng nạp tiền. Ảnh logo sẽ được upload lên server.</p>
    </div>

    <div class="row">
        <!-- ADD FORM -->
        <div class="col-12">
            <div class="cardx">
                <div class="head">
                    <p class="title"><span class="dot good"></span>Thêm ngân hàng</p>
                </div>
                <div class="body">
                    <form action="" method="POST" enctype="multipart/form-data" id="bankForm">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="f-label">Ngân hàng</label>
                                <select id="select2-data-array" name="name" class="f-select" data-toggle="select2" required>
                                    <?php foreach ($config_listbank as $list) { ?>
                                        <option value="<?= $list; ?>"><?= $list; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="f-label">Số tài khoản</label>
                                <input name="stk" type="text" class="f-input" placeholder="Nhập số tài khoản" required>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="f-label">Chủ tài khoản</label>
                                <input name="bank_name" type="text" class="f-input" placeholder="Nhập tên chủ tài khoản" required>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="f-label">Hình ảnh logo</label>
                                <div class="d-flex" style="gap:12px; align-items:center; flex-wrap:wrap;">
                                    <div class="logo-prev" id="logoPrev">PREVIEW</div>
                                    <div style="flex:1; min-width: 220px;">
                                        <input class="f-input" name="images" id="imagesInput" type="file" accept="image/*" required />
                                        <div class="f-help">Chọn ảnh logo ngân hàng (png/jpg). Tải lên 1 ảnh.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="f-label">Ghi chú</label>
                                <textarea name="ghichu" class="f-textarea" placeholder="VD: Nội dung chuyển khoản, lưu ý..."></textarea>
                            </div>

                            <div class="col-12">
                                <!-- FIX: value=1 + submit cứng -->
                                <button type="submit" name="ThemNganHang" value="1" class="btn-add" id="btnAddBank">
                                    <i class="fa fa-plus"></i> THÊM NGAY
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- LIST -->
        <div class="col-12 mt-3">
            <div class="cardx">
                <div class="head">
                    <p class="title"><span class="dot"></span>Danh sách ngân hàng</p>
                </div>
                <div class="body">
                    <div class="table-shell">
                        <div class="table-responsive">
                            <table class="table table-modern">
                                <thead>
                                    <tr>
                                        <th style="width: 6%">ID</th>
                                        <th>Ảnh</th>
                                        <th>Ngân hàng</th>
                                        <th>Số TK</th>
                                        <th>Chủ TK</th>
                                        <th style="width: 18%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `bank` ORDER BY id DESC") as $b) : ?>
                                        <tr>
                                            <td><?= $b['id'] ?></td>
                                            <td style="width:160px;">
                                                <div class="logo-prev" style="width:120px;height:70px;border-radius:12px;">
                                                    <?php if (!empty($b['logo'])): ?>
                                                        <img src="<?= $b['logo'] ?>" alt="logo">
                                                    <?php else: ?>
                                                        NO LOGO
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td><?= $b['name'] ?></td>
                                            <td><?= $b['stk'] ?></td>
                                            <td><?= $b['bank_name'] ?></td>
                                            <td>
                                                <div class="d-flex flex-wrap" style="gap:8px;">
                                                    <a class="btn-icon" href="main.php?action=edit_bank&id_bank=<?= $b['id'] ?>">
                                                        <i class="fa fa-edit"></i> Sửa
                                                    </a>
                                                    <button type="button" class="btn-icon del" onclick="RemoveRow(<?= $b['id'] ?>)">
                                                        <i class="fa fa-trash"></i> Xóa
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
    // Preview logo
    (function(){
        const input = document.getElementById('imagesInput');
        const prev  = document.getElementById('logoPrev');
        if (!input || !prev) return;

        input.addEventListener('change', function(){
            const f = this.files && this.files[0];
            if (!f) return;
            const url = URL.createObjectURL(f);
            prev.innerHTML = '<img src="'+url+'" alt="preview">';
        });
    })();

    // FIX: submit cứng tránh JS ngoài chặn
    (function(){
        const form = document.getElementById('bankForm');
        const btn  = document.getElementById('btnAddBank');
        if (!form || !btn) return;

        btn.addEventListener('click', function(){
            if (form.reportValidity && !form.reportValidity()) return;
            form.submit();
        });
    })();

    function RemoveRow(id) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Xóa Ngân Hàng",
            message: "Bạn có chắc chắn muốn xóa ngân hàng này không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
        }).then((e) => {
            if (e) {
                $.ajax({
                    url: "/ajaxs/action/removeBank.php",
                    method: "POST",
                    dataType: "JSON",
                    data: { id: id },
                    success: function(respone) {
                        if (respone.status == 'success') {
                            cuteToast({ type: "success", message: respone.msg, timer: 1000 });
                            location.reload();
                        } else {
                            cuteAlert({ type: "error", title: "Error", message: respone.msg, buttonText: "Okay" });
                        }
                    },
                    error: function() {
                        location.reload();
                    }
                });
            }
        })
    }
</script>