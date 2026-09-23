<?php
$sotin1trang = 10;
if (isset($_GET['page'])) {
    $page = xss(intval($_GET['page']));
} else {
    $page = 1;
}
$from = ($page - 1) * $sotin1trang;
?>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_products` ORDER BY `id` DESC LIMIT $from,$sotin1trang ") as $row) : ?>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="mt-2" style="height:200px; width:100%;">
                        <img src="<?= $row['images'] ?>" width="100%" height="100%" alt="" srcset="">
                    </div>
                    <div class="card-body">
                        <div>
                            <h5 class="card-title font-weight-bold text-truncate text-center text-uppercase"><?= $row['name'] ?></h5>
                            <p class="text-center font-weight-bold text-danger"><?= format_cash($row['price']) ?>đ</p>

                            <p class="card-text text-center">Lượt Xem: <?= format_cash($row['view']) ?> - Đã bán: <?= format_cash($row['sold']) ?></p>
                        </div>
                        <a href="index.php?action=view_product&product=<?= $row['slug'] ?>" class="btn btn-primary d-block shadow"><i class="fa fa-eye"></i> Xem Ngay</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 ml-auto">
            <?php
            $tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `tbl_products`");
            if ($tong > $sotin1trang) {
                echo '<center>' . pagination_account('index.php?action=source_code&', $from, $tong, $sotin1trang) . '</center>';
            } ?>
        </div>
    </div>
    
</div>