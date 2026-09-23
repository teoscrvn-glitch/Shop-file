<?php 
CheckLogin();
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Lịch sử mua hàng</h4>
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead class="thead-light">
                                <tr class="border-0">
                                    <th class="border-0">Sản phẩm
                                    </th>
                                    <th class="border-0">Thanh toán
                                    </th>
                                  
                                    <th class="border-0">
                                        Thời gian
                                    </th>
                                    <th class="border-0">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_history` WHERE `user_id`='".$getUser['id']."' ORDER BY `id` DESC LIMIT $from,$sotin1trang") as $row) : ?>
                                    <tr>
                                        <td class="border-top-0">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="mr-3"><img src="<?= getRowRealtime('tbl_products',$row['product_id'],'images') ?>" alt="user" width="55" /></div>
                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium"><?= getRowRealtime('tbl_products',$row['product_id'],'name') ?></h5>
                                                  
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-top-0"><?= format_cash($row['price']) ?></td>
                                        <td class="border-top-0"><?= $row['create_date'] ?></td>
                                        <td class="border-top-0">
                                            <a href="<?= getRowRealtime('tbl_products',$row['product_id'],'link_down') ?>" target="_blank" type="button" class="btn btn-primary btn-outline btn-xs m-r-5 tooltip-danger"><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    $tong = $LOCNGUYEN_SIEUTHICODE->num_rows("SELECT * FROM `tbl_history` WHERE `user_id`='".$getUser['id']."'");
                    if ($tong > $sotin1trang) {
                        echo '<center>' . pagination_account('index.php?action=history&', $from, $tong, $sotin1trang) . '</center>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- *************************************************************** -->
    <!-- End Top Leader Table -->
    <!-- *************************************************************** -->
</div>