<?php
require_once('../../core/db.php');
require_once('../../core/helpers.php');

if(empty($_SESSION['username'])){
    $data = json_encode([
        'status'    => 'error',
        'msg'       => 'Vui lòng đăng nhập'
    ]);
    die($data);
}
if($getUser['role'] != 1){
    $data = json_encode([
        'status'    => 'error',
        'msg'       => 'Không thể thực hiện'
    ]);
    die($data);
}
if ($LOCNGUYEN_SIEUTHICODE->site('status_demo')==1) {
    die(json_encode(['status' => 'error', 'msg' => 'Đây là trang web demo bạn không thể thực hiện chức năng này!']));
}
if(isset($_POST['action']) && $_POST['action']=='delete'){
    if (isset($_POST['id'])) {
        $id = xss($_POST['id']);
        $row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_category_hack` WHERE `id` = '$id' ");
        if (!$row) {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Danh mục không tồn tại trong hệ thống'
            ]);
            die($data);
        }
        $isRemove = $LOCNGUYEN_SIEUTHICODE->remove("tbl_category_hack", " `id` = '$id' ");
        if ($isRemove) {
            $data = json_encode([
                'status'    => 'success',
                'msg'       => 'Xóa danh mục thành công'
            ]);
            die($data);
        }
    } else {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'Dữ liệu không hợp lệ'
        ]);
        die($data);
    }
}

