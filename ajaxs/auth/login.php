<?php
require_once '../../core/db.php';
require_once '../../core/helpers.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_login = xss($_POST['user']);
    $user_pass = xss($_POST['pass']);
    if (empty($user_login) || empty($user_pass)) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Bạn chưa nhập tài khoản hoặc mật khẩu')));
    }
    if ($LOCNGUYEN_SIEUTHICODE->site('status_captcha') == 1) {
        $secret = $LOCNGUYEN_SIEUTHICODE->site('secret_key');
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = xss($_POST['g-recaptcha-response']);
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip";
        $fire = file_get_contents($url);
        $data = json_decode($fire);
        if ($data->success == false) {
            exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Vui lòng xác thực captcha')));
        }
    }
    if (!$row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `username`='" . $user_login . "' AND `password`='" . sha1(md5($user_pass)) . "'")) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Tài khoản hoặc mật khẩu không chính xác')));
    }
    if ($row['banned'] == 1) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Tài khoản đã bị khóa')));
    }
    $LOCNGUYEN_SIEUTHICODE->insert("logs", [
        'user_id' => $row['id'],
        'ip' => myip(),
        'device' => $_SERVER['HTTP_USER_AGENT'],
        'create_date' => gettime(),
        'action' => "Đăng nhập vào hệ thống",
    ]);
    $_SESSION['username'] = $user_login;
    exit(json_encode(array('title' => 'Thành công', 'status' => 'success', 'msg' => 'Đăng nhập thành công', 'redirect' => '/')));
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'GET'.")));
}
