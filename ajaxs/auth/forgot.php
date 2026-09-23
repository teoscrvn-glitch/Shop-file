<?php
require_once '../../core/db.php';
require_once '../../core/helpers.php';
require_once('../../core/class/class.smtp.php');
require_once('../../core/class/PHPMailerAutoload.php');
require_once('../../core/class/class.phpmailer.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = xss($_POST['email']);
    if (empty($email)) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Vui lòng địa chỉ email')));
    }
    if (check_email($email) != true) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Email không đúng định dạng')));
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
    if (!$row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `email`='" . $email . "'")) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Địa chỉ email không tồn tại')));
    }
    if ($row['banned'] == 1) {
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Tài khoản đã bị khóa, vui lòng liên hệ admin để được xử lý')));
    }
    $otp = random('0123456789', '6');
    $LOCNGUYEN_SIEUTHICODE->update("tbl_users", array(
        'otp' => $otp
    ), " `id` = '" . $row['id'] . "' ");
    $LOCNGUYEN_SIEUTHICODE->insert("logs", [
        'user_id' => $row['id'],
        'ip' => myip(),
        'device' => $_SERVER['HTTP_USER_AGENT'],
        'create_date' => gettime(),
        'action' => "Xác nhận khôi phục mật khẩu qua mail: " . $email,
    ]);
    $guitoi = $row['email'];
    $subject = 'XÁC NHẬN KHÔI PHỤC';
    $bcc = "KEY HACK";
    $hoten = 'Client';
    $noi_dung = '<h3>Có ai đó vừa yêu cầu gửi mã xác nhận khôi phục mật khẩu bằng Email này, nếu là bạn thì mã xác nhận bên dưới dùng để khôi phục mật khẩu</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">OTP:</td>
        <td><b style="color:blue;font-size:30px;">' . $otp . '</b></td>
        </tr>
        </tbody>
        </table>';
    $isSend = sendEmail($guitoi, $hoten, $subject, $noi_dung, $bcc);
    if($isSend){
        exit(json_encode(array('title' => 'Thành công', 'status' => 'success', 'msg' => 'Chúng tôi đã gửi một mã xác nhận đến Email của bạn', 'redirect' => 'index.php?action=reset')));
    }else{
        exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Đã xảy ra lỗi khi gửi email')));
    }
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'GET'.")));
}
