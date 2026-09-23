<?php
CheckLogin();
CheckAdmin();
$sotin1trang = 10;
if (isset($_GET['page'])) {
    $page = xss(intval($_GET['page']));
} else {
    $page = 1;
}
$from = ($page - 1) * $sotin1trang;
?>
<?php
if (isset($_POST['addBlog'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }
    $url_image = null;
    if (check_img('images') == true) {
        $rand = random('0123456789QWERTYUIOPASDGHJKLZXCVBNM', 4);
        $uploads_dir_image = 'upload/blog/blog' . $rand . '.png';
        $uploads_dir_image2 = './upload/blog/blog' . $rand . '.png';
        $tmp_name = $_FILES['images']['tmp_name'];
        $addlogo = move_uploaded_file($tmp_name, $uploads_dir_image2);
        if ($addlogo) {
            $url_image = $uploads_dir_image;
        }
    }
    $isInsert = $LOCNGUYEN_SIEUTHICODE->insert("tbl_blogs", [
        'images'         => $url_image,
        'content'         => $_POST['content'],
        'name'    => xss($_POST['name']),
        'create_date'    => gettime(),
        'update_date'    => gettime(),
        'status'    => xss($_POST['status']),
    ]);
    if ($isInsert) {
        die('<script type="text/javascript">if(!alert("Thêm thành công !")){window.history.back().location.reload();}</script>');
    } else {
        die('<script type="text/javascript">if(!alert("Thêm thất bại !")){window.history.back().location.reload();}</script>');
    }
} ?>
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
                                        <input name="name" type="text" class="form-control" placeholder="Nhập tiêu đề" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="matkhau">Hình ảnh:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" name="images" type="file" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <label for="username">Nội dung:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="content" type="text" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <label>Trạng thái:</label>
                                <div class="form-group">
                                    <select name="status" class="form-control show-tick" tabindex="-98">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="addBlog" class="btn btn-primary">THÊM NGAY</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Danh sách bài viết</h4>

                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th>ẢNH</th>
                                    <th>TIÊU ĐỀ</th>
                                    <th>TRẠNG THÁI</th>
                                    <th>THỜI GIAN TẠO</th>
                                    <th>CẬP NHẬT</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_blogs` LIMIT $from,$sotin1trang") as $row) : ?>
                                    <tr>
                                        <td class="border-top-0"><?= $row['id'] ?></td>
                                        <td class="border-top-0" width="15%"><img width="100%" src="<?= $row['images'] ?>" alt="" srcset=""></td>
                                        <td class="border-top-0"><?= $row['name'] ?></td>
                                        <td class="border-top-0"><?= status_cate($row['status']) ?></td>
                                        <td class="border-top-0"><?= $row['create_date'] ?></td>
                                        <td class="border-top-0"><?= $row['update_date'] ?></td>

                                        <td class="border-top-0">
                                            <a href="index.php?action=edit_blogs&id=<?= $row['id'] ?>" type="button" class="btn btn-primary btn-outline btn-xs m-r-5 tooltip-danger"><i class="fa fa-edit"></i></a>
                                            <button onclick="RemoveRow(<?= $row['id'] ?>)" type="button" class="btn btn-danger btn-outline btn-xs m-r-5 tooltip-danger"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    $tong = $LOCNGUYEN_SIEUTHICODE->num_rows(" SELECT * FROM `tbl_blogs`");
                    if ($tong > $sotin1trang) {
                        echo '<center>' . pagination_account('index.php?action=list_blog&', $from, $tong, $sotin1trang) . '</center>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function RemoveRow(id) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Xóa Bài Viết",
            message: "Bạn có chắc chắn muốn xóa bài viết này không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
        }).then((e) => {
            if (e) {
                $.ajax({
                    url: "/ajaxs/action/removeBlog.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        action: "delete",
                        id: id
                    },
                    success: function(respone) {
                        if (respone.status == 'success') {
                            cuteToast({
                                type: "success",
                                message: respone.msg,
                                timer: 1000
                            });
                            location.reload();
                        } else {
                            cuteAlert({
                                type: "error",
                                title: "Error",
                                message: respone.msg,
                                buttonText: "Okay"
                            });
                        }
                    }
                });
            }
        })
    }
</script>
<script>
    CKEDITOR.replace("content");
</script>