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
if (isset($_POST['addHosting'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }
    $isInsert = $LOCNGUYEN_SIEUTHICODE->insert("tbl_hosting", [
        'stt'    => xss($_POST['stt']),
        'name'    => xss($_POST['name']),
        'code'    => xss($_POST['code']),
        'quantity'    => xss($_POST['quantity']),
        'price'    => xss($_POST['price']),
        'content'         => $_POST['content'],
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
                            <div class="col-sm-4">
                                <label for="taikhoan">Số thứ tự:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="stt" type="number" min="1" class="form-control" placeholder="Nhập số thứ tự hiển thị" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="taikhoan">Tên gói:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="name" type="text" class="form-control" placeholder="Nhập tên gói" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="taikhoan">Mã gói:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="code" type="text" class="form-control" placeholder="Nhập mã gói" required>
                                    </div>
                                </div>
                                <i>Mã gói phải khớp với mã gói của DAILYSIEURE</i>
                            </div>
                            <div class="col-sm-6">
                                <label for="taikhoan">Số lượng:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="quantity" type="number" class="form-control" placeholder="Nhập số lượng" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="taikhoan">Giá bán:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="price" type="number" class="form-control" placeholder="Nhập giá bán" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <label for="username">Thông tin cấu hình:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="content" type="text" class="form-control" placeholder="Mỗi thông tin 1 dòng"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="taikhoan">Link login Cpanel:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="link" type="text" class="form-control" placeholder="Link login" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xs-12">
                                <label for="username">Nội dung:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="introtext" type="text" class="form-control" placeholder="Nhập nội dung..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <label>Trạng thái:</label>
                                <div class="form-group">
                                    <select name="status" class="form-control show-tick" tabindex="-98">
                                        <option value="1">Còn Hàng</option>
                                        <option value="0">Hết Hàng</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="addHosting" class="btn btn-primary">THÊM NGAY</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Danh sách gói hosting</h4>

                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th>LOẠI GÓI</th>
                                    <th>MÃ GÓI</th>
                                    <th>GIÁ BÁN</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>TRẠNG THÁI</th>
                                    <th>THỜI GIAN TẠO</th>
                                    <th>CẬP NHẬT</th>
                                    <th style="width: 20%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_hosting` ORDER BY `stt` ASC LIMIT $from,$sotin1trang") as $row) : ?>
                                    <tr>
                                        <td class="border-top-0"><?= $row['stt'] ?></td>
                                        <td class="border-top-0"><?= $row['name'] ?></td>
                                        <td class="border-top-0"><?= $row['code'] ?></td>
                                        <td class="border-top-0"><?= format_cash($row['price']) ?>đ</td>
                                        <td class="border-top-0"><?= format_cash($row['quantity']) ?></td>
                                        <td class="border-top-0"><?= status_host($row['status']) ?></td>
                                        <td class="border-top-0"><?= $row['create_date'] ?></td>
                                        <td class="border-top-0"><?= $row['update_date'] ?></td>

                                        <td class="border-top-0">
                                            <a href="index.php?action=edit_hosting&id=<?= $row['id'] ?>" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chỉnh sửa thông tin" class="btn btn-primary btn-outline btn-xs m-r-5 tooltip-danger"><i class="fa fa-edit"></i></a>
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
            title: "Xác Nhận Xóa Gói",
            message: "Bạn có chắc chắn muốn xóa gói này có thể ảnh hưởng đến thông tin của khách hàng không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
        }).then((e) => {
            if (e) {
                $.ajax({
                    url: "/ajaxs/action/removeHosting.php",
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
    CKEDITOR.replace("introtext");
</script>