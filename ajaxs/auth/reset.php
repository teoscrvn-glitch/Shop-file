<?php
require_once '../../core/db.php';
require_once '../../core/helpers.php';
require_once('../../core/class/class.smtp.php');
require_once('../../core/class/PHPMailerAutoload.php');
require_once('../../core/class/class.phpmailer.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otp = xss(preg_replace('/\D/', '', $_POST['otp']));
    $pass = xss($_POST['pass']);
    $repass = xss($_POST['repass']);
    $email = xss($_POST['email']);
    if (empty($otp) || empty($pass) || empty($repass) || empty($email)) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Vui lòng nhập đủ thông tin')));
    }
    if (check_email($email) != true) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Email không đúng định dạng')));
    }
    if(strlen($pass) < 6){
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Mật khẩu phải ít nhất 6 ký tự')));
    }
    if ($pass != $repass) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Nhập lại mật khẩu không đúng')));
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
    if (!$row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `email`='" . $email . "' AND `otp` = '$otp'")) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Địa chỉ email hoặc OTP không hợp lệ')));
    }
    if ($row['banned'] == 1) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Tài khoản đã bị khóa, vui lòng liên hệ admin để được xử lý')));
    }
    $LOCNGUYEN_SIEUTHICODE->insert("logs", [
        'user_id' => $row['id'],
        'ip' => myip(),
        'device' => $_SERVER['HTTP_USER_AGENT'],
        'create_date' => gettime(),
        'action' => "Đã đặ lại mật khẩu mới",
    ]);
    $isUpdate = $LOCNGUYEN_SIEUTHICODE->update("tbl_users", [
        'otp' => NULL,
        'password' => sha1(md5($pass))
    ], " `id` = '".$row['id']."' ");
    if ($isUpdate) {
        exit(json_encode(array('title' => 'Thành công', 'status' => 'success', 'msg' => 'Đặt lại mật khẩu thành công', 'redirect' => 'index.php?action=login')));
    } else {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Đã xảy ra lỗi khi đặt lại mật khẩu')));
    }
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'GET'.")));
}
