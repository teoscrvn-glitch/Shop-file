<?php
$sotin1trang = 10;
if (isset($_GET['page'])) {
    $page = xss(intval($_GET['page']));
} else {
    $page = 1;
}
$from = ($page - 1) * $sotin1trang;
?>
<style>
    .divider {
        height: 1px;
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: none;
        background-color: #ccd3df;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="text-primary">Giá Siêu Rẻ</div>
            <h2 class="text-dark" id="title_hosting">Bảng Giá Chi Tiết</h2>
        </div>
    </div>
    <div class="row" id="hosting_panel">
        <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_hosting` ORDER BY `stt` ASC LIMIT $from,$sotin1trang ") as $row) : ?>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center text-primary font-weight-bold h3"><?= $row['name'] ?></div>
                        <div class="text-center">
                            <span class="font-weight-bold text-dark h3"><?= format_cash($row['price']) ?>đ/Tháng</span></span>
                        </div>
                        <div class="divider"></div>
                        <ul class="">
                            <?php $a = explode(PHP_EOL, $row['content']);
                            foreach ($a as $key => $b) : ?>
                                <li class="media">
                                    <i class="fas fa-check mr-1 text-primary"></i>
                                    <?= trim($b); ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                        <div class="text-center">
                            <button class="btn btn-primary font-weight-bold" id="next_section" onclick="nextSection(<?= $row['id'] ?>)">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row" id="confirm_hosting" style="display: none;">
        <div class="col-lg-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <img class="m-auto" src="/assets/images/server.png" width="80px" height="80px" alt="" srcset="">
                    <h4>Tên Gói: <span class="text-primary" id="name_confirm"></span></h4>
                    <h4>Giá Bán: <span class="text-danger" id="cash_confirm"></span></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-sm-8 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <form id="buy_host_sieuthicode">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <label>Tên miền:</label>
                                <div class="form-group">
                                    <input type="text" id="domain" name="domain" class="form-control" placeholder="Ví dụ: sieuthicode.net">
                                    <input type="hidden" id="id_confirm" name="id_confirm" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <label>Email quản lý:</label>
                                <div class="form-group">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Ví dụ: locdz@gmail.com">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info">THANH TOÁN</button>
                                <button onClick="window.location.reload();" type="button" class="btn btn-danger">CHỌN GÓI KHÁC</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 ml-auto">
            <?php
            $tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `tbl_products`");
            if ($tong > $sotin1trang) {
                echo '<center>' . pagination_account('index.php?action=home&', $from, $tong, $sotin1trang) . '</center>';
            } ?>
        </div>
    </div>
</div>
<script src="dist/js/sieuthicode.js?v=<?= time() ?>"></script>