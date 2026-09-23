<?php
CheckLogin();
CheckAdmin();
?>
<?php
if (isset($_GET['id']) && $getUser['role'] == '1') {
    $row = $LOCNGUYEN_SIEUTHICODE->get_row(" SELECT * FROM `tbl_blogs` WHERE `id` = '" . xss($_GET['id']) . "'  ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "/";}</script>');
}
?>

<?php

if (isset($_POST['editBlog']) && $getUser['role'] == '1') {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đang ở chế độ demo bạn không được phép thay đổi dữ liệu hệ thống !")){window.history.back().location.reload();}</script>');
    }
    if (check_img('images') == true) {
        $rand = random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 12);
        $uploads_dir = './upload/blog';
        $tmp_name = $_FILES['images']['tmp_name'];
        $url_img = "/blog" . $rand . ".png";
        $create = move_uploaded_file($tmp_name, $uploads_dir . $url_img);
        $LOCNGUYEN_SIEUTHICODE->update("tbl_blogs", array(
            'images'       => 'upload/blog' . $url_img
        ), " `id` = '" . $row['id'] . "' ");
    }
    $isUpdate = $LOCNGUYEN_SIEUTHICODE->update("tbl_blogs", array(
        'name'         => xss($_POST['name']),
        'content'         => $_POST['name'],
        'status'        => xss($_POST['status']),
        'update_date'        => gettime()
    ), " `id` = '" . $row['id'] . "' ");
    if ($isUpdate) {
        die('<script type="text/javascript">if(!alert("Lưu thành công !")){location.href = "index.php?action=list_blog";}</script>');
    } else {
        die('<script type="text/javascript">if(!alert("Lưu thất bại!")){window.history.back().location.reload();}</script>');
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label for="taikhoan">Tiêu đề:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="name" type="text" class="form-control" value="<?= $row['name'] ?>" placeholder="Nhập tiêu đề" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="matkhau">Hình ảnh:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" name="images" type="file" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <label for="username">Nội dung:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="content" type="text" class="form-control"><?= $row['content'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <label>Trạng thái:</label>
                                <div class="form-group">
                                    <select name="status" class="form-control" data-toggle="select2" required>
                                        <option value="1" <?= $row['status'] == '1' ? 'selected' : '' ?>>Hiển thị</option>
                                        <option value="0" <?= $row['status'] == '0' ? 'selected' : '' ?>>Ẩn</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="editBlog" class="btn btn-primary">THÊM NGAY</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace("content");
</script>