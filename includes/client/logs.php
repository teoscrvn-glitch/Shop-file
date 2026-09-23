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
                        <h4 class="card-title">Lịch sử hoạt động</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>HÀNH ĐỘNG</th>
                                    <th>ĐỊA CHỈ IP</th>
                                    <th>THIẾT BỊ</th>
                                    <th>THỜI GIAN</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; foreach($LOCNGUYEN_SIEUTHICODE->get_list(" SELECT * FROM `logs` WHERE `user_id` = '".$getUser['id']."' ORDER BY id DESC ") as $row){ ?>
                                <tr>
                                    <td class="text-sm text-gray-800"><?=$i++;?></td>
                                    <td class="text-sm text-gray-800"><?=$row['action'];?></td>
                                    <td class="text-sm text-gray-800"><?=$row['ip'];?></td>
                                    <td class="text-sm text-gray-800"><?=$row['device'];?></td>
                                    <td class="text-sm text-gray-800"><span class="badge badge-dark"><?=$row['create_date'];?></span></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    $tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `dongtien` WHERE `user_id`='".$getUser['id']."'");
                    if ($tong > $sotin1trang) {
                        echo '<center>' . pagination_account('index.php?action=history_balance&', $from, $tong, $sotin1trang) . '</center>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>