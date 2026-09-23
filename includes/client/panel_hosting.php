<?php
CheckLogin();
if (isset($_GET['id'])) {
    $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_history_hosting` WHERE `id` = '" . xss($_GET['id']) . "' AND `user_id` = '" . $getUser['id'] . "' ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
}
?>
<div class="container-fluid">
    <div class="alert alert-dark bg-dark text-white border-0 mb-4" role="alert">
        <?= getRowRealtime('tbl_hosting', $row['hosting_id'], 'introtext') ?>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-dark">Quản Lý Hosting</h4>
                    <p>Tên miền: <span class="text-danger"><?= $row['domain'] ?></span></p>
                    <p>Cpanel login: <a href="<?= getRowRealtime('tbl_hosting', $row['hosting_id'], 'link') ?>" target="_blank"><?= str_replace('https://', '', getRowRealtime('tbl_hosting', $row['hosting_id'], 'link')) ?></a></p>
                    <p>Tài khoản: <?= $row['user'] ?></p>
                    <p>Mật khẩu: <?= $row['pass'] ?></p>
                    <p>(ĐỂ AN TOÀN HƠN, BẠN NÊN ĐỔI MẬT KHẨU ĐỂ CHO MẬT KHẨU KHÔNG GIỐNG VỚI TRANG QUẢN LÝ NÀY)</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-dark">Thông Tin</h4>
                    <p>Gói: <?= getRowRealtime('tbl_hosting', $row['hosting_id'], 'name') ?></p>
                    <p>Tình trạng: <?= ($row['status']) ?></p>
                    <p>Ngày mua: <?= date('h:i:s d-m-Y', $row['create_date']) ?></p>
                    <p>Ngày hết hạn: <?= date('h:i:s d-m-Y', $row['exp_date']) ?></p>
                    <p>Mail đăng ký: <?= $row['email'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>