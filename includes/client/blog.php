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
        <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_blogs` LIMIT $from,$sotin1trang") as $row) : ?>
            <div class="col-md-12 col-lg-12">
                <div class="card mb-2">
                    <div class="row no-gutters">
                        <div class="col-md-6 col-lg-4">
                            <a href="index.php?action=view_blog&id=<?=$row['id']?>"><img src="<?=$row['images']?>" class="card-img" alt="#"></a>
                        </div>
                        <div class="col-md-6 col-lg-8">
                            <div class="card-body">
                                <h4 class="card-title text-uppercase"><a href="index.php?action=view_blog&id=<?=$row['id']?>"><?=$row['name']?></a></h4>
                                <p class="card-text"></p>
                                <p class="text-truncate"><?=$row['content']?></p>
                                <p></p>
                                <p class="card-text"><small class="text-muted"><?=$row['update_date']?></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col-md-12 col-lg-12">
            <?php
            $tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `tbl_blogs`");
            if ($tong > $sotin1trang) {
                echo '<center>' . pagination_account('index.php?action=blog&', $from, $tong, $sotin1trang) . '</center>';
            } ?>
        </div>
    </div>
</div>