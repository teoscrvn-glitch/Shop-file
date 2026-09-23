<?php
require_once(__DIR__.'/core/db.php');
require_once(__DIR__.'/core/helpers.php');
session_destroy();
?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $LOCNGUYEN_SIEUTHICODE->site('description'); ?>">
    <meta name="keywords" content="<?=$LOCNGUYEN_SIEUTHICODE->site('keywords')?>" />
    <meta name="author" content="sieuthicode.net">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$LOCNGUYEN_SIEUTHICODE->site('favicon');?>">
    <title><?=$LOCNGUYEN_SIEUTHICODE->site('title');?></title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dist/css/sweetalert.css">
    <script src="assets/libs/jquery/dist/jquery-1.11.2.min.js"></script>
    <script src="dist/js/sweetalert.min.js"></script>
</head>
<?php if ($LOCNGUYEN_SIEUTHICODE->site('status_cursor') == 1): ?>
    <style>
        body {
            cursor: url(<?=$LOCNGUYEN_SIEUTHICODE->site('cursor_default')?>), progress;
            font-family: 'Josefin Sans', sans-serif;
        }

        a,
        button,
        li,
        img,
        .btn-close,
        .btn,
        label,
        select,
        option,
        marquee {
            cursor: url(<?=$LOCNGUYEN_SIEUTHICODE->site('cursor_hover')?>), progress;
        }
    </style>
<?php endif?>
<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(assets/images/technology.webp);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                       
                        <h2 class="mt-3 text-center">Đăng Nhập</h2>
                        <p class="text-center">Enter your account and password to access website.</p>
                        <form class="mt-4" id="login_sieuthicode">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Tài khoản</label>
                                        <input class="form-control" id="user" name="user" type="text"
                                            placeholder="enter your username">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Mật khẩu</label>
                                        <input class="form-control" id="pass" name="pass" type="password"
                                            placeholder="enter your password">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Đăng Nhập</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Bạn chưa có tài khoản? <a href="register.php" class="text-danger">Đăng Ký</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <script src="dist/js/sieuthicode.js?v=<?=time()?>"></script>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>