<?php
ob_start(); // ✅ FIX: chặn "headers already sent"

require_once(__DIR__ . '/core/db.php');
require_once(__DIR__ . '/core/helpers.php');
require_once(__DIR__ . "/version.php");
CheckLogin();
CheckAdmin();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Thực hiện bởi Nguyễn Nhật Lộc - SIEUTHICODE.NET - 0978364572 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $LOCNGUYEN_SIEUTHICODE->site('description'); ?>">
    <meta name="keywords" content="<?= $LOCNGUYEN_SIEUTHICODE->site('keywords') ?>" />
    <meta name="author" content="sieuthicode.net">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $LOCNGUYEN_SIEUTHICODE->site('favicon'); ?>">
    <title><?= $LOCNGUYEN_SIEUTHICODE->site('title'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="/dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/dist/css/sweetalert.css">

    <script src="/assets/libs/jquery/dist/jquery-1.11.2.min.js"></script>
    <script src="/dist/js/sweetalert.min.js"></script>

    <link class="/main-stylesheet" href="assets/cute/cute-alert.css" rel="stylesheet" type="text/css">
    <script src="/assets/cute/cute-alert.js"></script>
    <script src="/assets/ckeditor/ckeditor.js"></script>
</head>

<?php if ($LOCNGUYEN_SIEUTHICODE->site('status_cursor') == 1) : ?>
    <style>
        body {
            cursor: url(<?= $LOCNGUYEN_SIEUTHICODE->site('cursor_default') ?>), progress;
            font-family: 'Josefin Sans', sans-serif;
        }
        a, button, li, img, .btn-close, .btn, label, select, option, marquee {
            cursor: url(<?= $LOCNGUYEN_SIEUTHICODE->site('cursor_hover') ?>), progress;
        }
    </style>
<?php endif ?>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

                    <div class="navbar-brand">
                        <a href="/">
                            <img src="<?= $LOCNGUYEN_SIEUTHICODE->site('logo') ?>" alt="homepage" width="200px" class="dark-logo" />
                        </a>
                    </div>

                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1"></ul>

                    <ul class="navbar-nav float-right">
                        <li class="nav-item dropdown">
                            <?php if (!isset($_SESSION['username'])) : ?>
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="assets/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="40">
                                    <span class="ml-2 d-none d-lg-inline-block">Chưa đăng nhập <i data-feather="chevron-down" class="svg-icon"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                    <a class="dropdown-item" href="login.php"><i data-feather="user" class="svg-icon mr-2 ml-1"></i> Đăng Nhập</a>
                                    <a class="dropdown-item" href="register.php"><i data-feather="settings" class="svg-icon mr-2 ml-1"></i> Đăng Ký</a>
                                </div>
                            <?php else : ?>
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="assets/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="40">
                                    <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span class="text-dark"><?= $getUser['username'] ?></span> <i data-feather="chevron-down" class="svg-icon"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i data-feather="box" class="svg-icon mr-2 ml-1"></i><?= format_cash($getUser['coin']) ?>đ
                                    </a>
                                    <a class="dropdown-item" href="index.php?action=login"><i data-feather="power" class="svg-icon mr-2 ml-1"></i> Đăng Xuất</a>
                                </div>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <?php require_once __DIR__ . '/includes/admin/left.php' ?>

        <div class="page-wrapper">
            <?php
            $action = !empty($_GET['action']) ? xss($_GET['action']) : '';
            switch ($action) {
                case "edit_bank": include "includes/admin/edit_bank.php"; break;
                case "list_category_hack": include "includes/admin/list_category_hack.php"; break;
                case "edit_category_hack": include "includes/admin/edit_category_hack.php"; break;
                case "add_category_hack": include "includes/admin/add_category_hack.php"; break;
                case "add_groups_hack": include "includes/admin/add_groups_hack.php"; break;
                case "list_groups_hack": include "includes/admin/list_groups_hack.php"; break;
                case "list_package_hack": include "includes/admin/list_package_hack.php"; break;
                case "list_license_hack": include "includes/admin/list_license_hack.php"; break;
                case "edit_list_package_hack": include "includes/admin/edit_list_package_hack.php"; break;
                case "history_license": include "includes/client/history_license.php"; break;
                case "groups_hack": include "includes/client/groups_hack.php"; break;
                case "edit_groups_hack": include "includes/admin/edit_groups_hack.php"; break;
                case "view_hack": include "includes/client/view_hack.php"; break;
                case "history_card": include "includes/admin/history_card.php"; break;
                case "history_bank": include "includes/admin/history_bank.php"; break;
                case "list_users": include "includes/admin/list_users.php"; break;
                case "edit_users": include "includes/admin/edit_users.php"; break;
                case "list_bank": include "includes/admin/list_bank.php"; break;
                case "list_menu": include "includes/admin/list_menu.php"; break;
                case "edit_menu": include "includes/admin/edit_menu.php"; break;
                case "add_menu": include "includes/admin/add_menu.php"; break;
                case "theme": include "includes/admin/theme.php"; break;
                case "settings": include "includes/admin/settings.php"; break;
                default:
                case "home-panel": include "includes/admin/dashboard.php"; break;
            }
            ?>

            <footer class="footer text-center text-dark">
                All Rights Reserved by TRẦN HÀO DEV. Designed and Developed by
                <a href="https://www.facebook.com/profile.php?id=61578683206427">Hào Mun - Version <span class="text-danger"><?= $config['version'] ?></span></a>.
            </footer>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>

    <script>
        (function() {
            var isLogin = <?= isset($_SESSION['username']) ? 'true' : 'false' ?>;
            if (!isLogin) return;

            function pingOnline() {
                fetch("/ajaxs/action/pingOnline.php", {
                    method: "POST",
                    credentials: "include",
                    cache: "no-store"
                }).catch(function() {});
            }

            pingOnline();
            setInterval(pingOnline, 20000);

            window.addEventListener("beforeunload", function() {
                try { navigator.sendBeacon("/ajaxs/action/pingOnline.php"); } catch (e) {}
            });
        })();
    </script>

</body>
</html>
<?php
ob_end_flush(); // ✅ FIX: xả buffer cuối trang