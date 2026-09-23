<?php
require_once '../../core/db.php';
require_once '../../core/helpers.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = xss($_POST['email']);
    $username = xss($_POST['user']);
    $password = xss($_POST['pass']);

    if (empty($username) || empty($password) || empty($email)) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Vui lòng nhập đủ thông tin')));
    }
    if (check_email($email) != true) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Email không đúng định dạng')));
    }
    if (strlen($username) < 6) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Tài khoản đăng nhập không được ngắn hơn 6 ký tự')));
    }
    if (strlen($password) < 6) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Mật khẩu đăng nhập không được ngắn hơn 6 ký tự')));
    }
    if ($LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `email`='$email'")) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Email này đã có người sử dụng')));
    }
    if ($LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `username`='$username'")) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Tài khoản này đã có người sử dụng')));
    }
    $token = md5(random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 6) . time());
    $create = $LOCNGUYEN_SIEUTHICODE->insert("tbl_users", [
        'username' => $username,
        'email' => $email,
        'password' => sha1(md5($password)),
        'token' => $token,
        'ip' => myip(),
        'create_date' => gettime(),
        'update_date' => gettime(),
    ]);
    if ($create) {
        $_SESSION['username'] = $username;
        exit(json_encode(array('title' => 'Thành công', 'status' => 'success', 'msg' => 'Tạo tài khoản thành công', 'redirect' => '/')));
    } else {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Đã xảy ra lỗi gì đó, vui lòng liên hệ admin để xử lý')));
    }
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'GET'.")));
}
