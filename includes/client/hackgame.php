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
        <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_category_hack` ORDER BY `stt` ASC LIMIT $from,$sotin1trang ") as $row) : ?>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="mt-2" style="height:12rem">
                        <img src="<?= $row['images'] ?>" width="100%" height="100%" alt="" srcset="">
                    </div>
                    <div class="card-body">
                        <div>
                            <h5 class="card-title font-weight-bold text-truncate text-center text-uppercase"><?= $row['name'] ?></h5>
                            <p class="text-center font-weight-bold text-danger"><?= $row['content'] ?></p>
                        </div>
                        <a href="index.php?action=groups_hack&type=<?= $row['slug'] ?>" class="btn btn-primary d-block shadow"><i class="fa fa-shopping-cart"></i> Thuê Ngay</a>
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
                echo '<center>' . pagination_account('index.php?action=hackgame&', $from, $tong, $sotin1trang) . '</center>';
            } ?>
        </div>
    </div>
</div>