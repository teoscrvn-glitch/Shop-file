<?php
if (isset($_GET['id'])) {
    $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_blogs` WHERE `id` = '" . xss($_GET['id']) . "'  ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Dịch vụ không tồn tại !")){location.href = "/";}</script>');
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center text-dark text-uppercase"><?= $row['name'] ?></h4>
                    <div class="mt-2">
                        <?= $row['content'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>