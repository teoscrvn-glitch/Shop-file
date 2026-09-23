<?php
if (isset($_GET['product'])) {
    $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_products` WHERE `slug` = '" . xss($_GET['product']) . "'  ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
    }
    $LOCNGUYEN_SIEUTHICODE->update("tbl_products", [
        'view' => $row['view'] + 1
    ], " `id` = '" . $row['id'] . "' ");
} else {
    die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <img src="<?= $row['images'] ?>" width="100%" alt="" srcset="">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-dark font-weight-bold"><?= $row['name']; ?></h4>
                    <p class="mb-1">Giá bán: <?= format_cash($row['price'] - ($row['price']*$row['sale']/100)); ?>đ</p>
                    <p class="mb-1">Danh mục: <?= getRowRealtime('tbl_categories',$row['category'],'name'); ?></p>
                    <p class="mb-1">Cập nhật: <?= $row['update_date']; ?></p>

                    <div class="row">
                       
                        <div class="col-md-6 col-lg-6 col-xs-12 d-grid"><button class="btn btn-primary" onclick="showPopup(<?= $row['id']; ?>)">THANH TOÁN</button></div>
                        <div class="col-md-6 col-lg-6 col-xs-12"><a href="<?= $row['link_demo']; ?>" target="_blank" class="btn btn-danger">XEM DEMO</a></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?= trim($row['intro']); ?>

                    <?php $a = explode(PHP_EOL, $row['list_images']);
                    foreach ($a as $b) {; ?>
                        <img src="<?= $b; ?>" data-sizes="auto" width="100%" />
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="dist/js/sieuthicode.js?v=<?= time() ?>"></script>