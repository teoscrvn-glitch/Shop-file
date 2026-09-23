<?php
require_once __DIR__ . '/core/db.php';
require_once __DIR__ . '/core/helpers.php';
require_once __DIR__ . "/version.php";
if ($LOCNGUYEN_SIEUTHICODE->site('status_minify') == 1) {
    require_once __DIR__ . "/minify.php";
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="<?=$LOCNGUYEN_SIEUTHICODE->site('description');?>">
    <meta name="keywords" content="<?=$LOCNGUYEN_SIEUTHICODE->site('keywords')?>" />
    <meta name="author" content="<?=$LOCNGUYEN_SIEUTHICODE->site('author')?>">

    <link rel="icon" type="image/png" sizes="16x16" href="<?=$LOCNGUYEN_SIEUTHICODE->site('favicon');?>">

    <meta property="og:title" content="<?=$LOCNGUYEN_SIEUTHICODE->site('keywords')?>" />
    <meta property="og:url" content="/" />
    <meta property="og:image" content="<?=$LOCNGUYEN_SIEUTHICODE->site('logo')?>" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="vi" />
    <meta name="robots" content="index,follow,noodp" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Lib giữ nguyên -->
    <link rel="stylesheet" type="text/css" href="/dist/css/sweetalert.css">
    <script src="/assets/libs/jquery/dist/jquery-1.11.2.min.js"></script>
    <script src="/dist/js/sweetalert.min.js"></script>
    <link href="assets/cute/cute-alert.css" rel="stylesheet" type="text/css">
    <script src="/assets/cute/cute-alert.js"></script>
    <script src="/assets/ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/dist/js/html2canvas.min.js"></script>

    <script type="text/javascript" src="/dist/js/bootstrap-select.min.js"></script>
    <link type="text/css" href="/dist/css/bootstrap-select.min.css" rel="stylesheet" />

    <script type="text/javascript" src="/dist/js/jwplayer.js"></script>
    <link type="text/css" href="/dist/css/zebradialog.css" rel="stylesheet" />
    <link type="text/css" href="/dist/css/owl.carousel.css" rel="stylesheet" />
    <link type="text/css" href="/dist/css/jquery.mmenu.all.css?v=<?=time()?>" rel="stylesheet" />
    <link type="text/css" href="/dist/css/modules.css?v=<?=time()?>" rel="stylesheet" />
    <link type="text/css" href="/dist/css/responsive.css?v=<?=time()?>" rel="stylesheet" />
    <link type="text/css" href="/dist/css/sieuthicode.css?v=<?=time()?>" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        :root{
            --bg0:#050914;
            --bg1:#070d1c;
            --border:rgba(255,255,255,.12);
            --text:rgba(255,255,255,.92);
            --muted:rgba(255,255,255,.70);
            --shadow:0 18px 70px rgba(0,0,0,.55);
            --radius:18px;
            --primary:#3b82f6;
            --primary2:#2563eb;
        }

        html,body{ height:100%; }
        body{
            background:
                radial-gradient(900px 360px at 18% 0%, rgba(59,130,246,.16), transparent 55%),
                radial-gradient(800px 320px at 82% 0%, rgba(34,197,94,.10), transparent 55%),
                linear-gradient(180deg, var(--bg1), var(--bg0));
            color: var(--text);
            font-family: 'Inter','Roboto',sans-serif;
        }

        /* ===== HEADER AUTO FIT LOGO ===== */
        #header{ position: sticky; top:0; z-index: 999; }
        .headermenu{
            background: rgba(7,13,28,.74);
            border-bottom: 1px solid rgba(255,255,255,.08);
            backdrop-filter: blur(12px);
        }
        .nav-fixed{
            padding: 10px 0;
            align-items:center;
            min-height: 74px;
        }
        @media (max-width: 575px){
            .nav-fixed{ min-height: 64px; }
        }

        figure.logo{
            display:flex;
            align-items:center;
            height: 54px;
            margin: 0;
        }
        @media (max-width: 575px){
            figure.logo{ height: 46px; }
        }
        figure.logo a{
            display:flex;
            align-items:center;
            height: 100%;
        }
        figure.logo img{
            height: 100% !important;
            width: auto !important;
            max-width: 100%;
            object-fit: contain;
            filter: drop-shadow(0 10px 22px rgba(0,0,0,.35));
        }

        .menuTop{
            display:flex;
            align-items:center;
            justify-content:flex-end;
            gap: 12px;
        }

        #mainMenu{ display:flex; justify-content:flex-end; }
        .navmenu{
            display:flex;
            align-items:center;
            gap: 8px;
            margin:0;
            padding:0;
            list-style:none;
        }
        .navmenu > li > a{
            display:flex;
            align-items:center;
            gap:8px;
            padding: 10px 12px;
            border-radius: 14px;
            color: rgba(255,255,255,.90) !important;
            font-weight: 800;
            text-decoration:none !important;
            border: 1px solid transparent;
            transition: transform .15s ease, background .15s ease, border-color .15s ease;
            white-space: nowrap;
        }
        .navmenu > li > a:hover{
            background: rgba(255,255,255,.06);
            border-color: rgba(59,130,246,.22);
            transform: translateY(-1px);
            color:#fff !important;
        }

        .user-chip{
            display:flex;
            align-items:center;
            gap:10px;
            padding: 9px 12px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,.12);
            background: rgba(255,255,255,.06);
            box-shadow: 0 12px 35px rgba(0,0,0,.35);
            cursor:pointer;
            user-select:none;
            max-width: 380px;
        }
        .user-chip:hover{
            border-color: rgba(59,130,246,.22);
            background: rgba(255,255,255,.08);
        }
        .user-chip__name{
            font-weight: 900;
            color: rgba(255,255,255,.92);
            overflow:hidden;
            text-overflow: ellipsis;
            max-width: 170px;
            white-space: nowrap;
        }
        .user-chip__sep{ width:1px; height:18px; background: rgba(255,255,255,.16); }
        .user-chip__money{ font-weight: 900; color:#bfdbfe; white-space:nowrap; }
        .user-chip__caret{
            margin-left: 2px;
            width: 8px; height: 8px;
            border-right: 2px solid rgba(255,255,255,.55);
            border-bottom: 2px solid rgba(255,255,255,.55);
            transform: rotate(45deg);
            opacity:.9;
        }

        .dropdown-menu.dropdown-usmenu{
            background: rgba(10,18,38,.92) !important;
            border: 1px solid rgba(255,255,255,.10) !important;
            border-radius: 16px !important;
            box-shadow: var(--shadow) !important;
            backdrop-filter: blur(12px);
            padding: 8px !important;
            min-width: 230px;
        }
        .dropdown-menu.dropdown-usmenu a,
        .dropdown-menu.dropdown-usmenu li a{
            display:flex;
            align-items:center;
            gap:10px;
            padding: 10px 12px !important;
            border-radius: 12px;
            color: rgba(255,255,255,.90) !important;
            font-weight: 800;
            text-decoration:none !important;
        }
        .dropdown-menu.dropdown-usmenu a:hover,
        .dropdown-menu.dropdown-usmenu li a:hover{
            background: rgba(255,255,255,.06) !important;
        }

        .btn.userCP{
            background: linear-gradient(135deg, var(--primary), var(--primary2));
            border:0 !important;
            border-radius: 14px !important;
            padding: 10px 14px !important;
            font-weight: 900 !important;
            color:#fff !important;
            box-shadow: 0 14px 40px rgba(37,99,235,.20);
            text-decoration:none !important;
            white-space: nowrap;
        }

        .content-main{ min-height: 55vh; }

        /* ===== Mobile menu (mmenu) đẹp ===== */
        .nav-btn-show a.sidebar-toggle{
            display:flex;
            align-items:center;
            justify-content:center;
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.12);
            box-shadow: 0 12px 35px rgba(0,0,0,.35);
            color: rgba(255,255,255,.92) !important;
            text-decoration:none !important;
        }
        .mm-menu{ background: linear-gradient(180deg, rgba(10,18,38,.98), rgba(5,9,20,.98)) !important; }
        .mm-navbar{ border-color: rgba(255,255,255,.10) !important; background: rgba(255,255,255,.04) !important; }
        .mm-navbar .mm-title{ color: rgba(255,255,255,.92) !important; font-weight: 900; }
        .mm-listview > li{ border-color: rgba(255,255,255,.08) !important; }
        .mm-listview > li > a, .mm-listview > li > span{
            color: rgba(255,255,255,.90) !important; font-weight: 800;
            padding-top: 14px !important; padding-bottom: 14px !important;
        }

        @media (max-width: 991px){
            #mainMenu{ display:none; }
            .user-chip{ max-width: 220px; padding: 9px 10px; }
            .user-chip__name{ max-width: 110px; }
        }

        /* ===== FOOTER FORCE: chắc chắn hiện ===== */
        .footer-force{
            display:block !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: relative !important;
            z-index: 5 !important;
            background: rgba(7,13,28,.78) !important;
            border-top: 1px solid rgba(255,255,255,.08) !important;
            backdrop-filter: blur(12px);
            margin-top: 24px;
        }
        .footer-force .ft-bottom-force{
            display:flex !important;
            justify-content:center !important;
            align-items:center !important;
            text-align:center !important;
            padding: 16px 10px !important;
            color: rgba(255,255,255,.86) !important;
            font-weight: 900 !important;
            letter-spacing:.2px;
        }
    </style>
</head>

<?php if ($LOCNGUYEN_SIEUTHICODE->site('status_cursor') == 1): ?>
<style>
    body { cursor: url(<?=$LOCNGUYEN_SIEUTHICODE->site('cursor_default')?>), progress; font-family: 'Roboto', sans-serif; }
    a,button,li,img,.btn-close,.btn,label,select,option,marquee { cursor: url(<?=$LOCNGUYEN_SIEUTHICODE->site('cursor_hover')?>), progress; }
</style>
<?php endif?>

<body id="body" class="mainbg">
<div class="Wrapper">

    <header id="header">
        <section class="headermenu">
            <div class="container">
                <div class="row nav-fixed">
                    <div class="nav-btn-show fl hidden-lg hidden-md col-sm-2 col-xs-2">
                        <a href="#my-mobile-menu" class="sidebar-toggle" aria-label="Mở menu"><i class="fa fa-bars"></i></a>
                    </div>

                    <figure class="logo col-lg-2 col-md-2 col-sm-6 col-xs-5">
                        <a href="/" rel="nofollow">
                            <img alt="Logo" src="<?=$LOCNGUYEN_SIEUTHICODE->site('logo')?>" height="45" />
                        </a>
                    </figure>

                    <div class="col-lg-10 col-md-10 col-sm-4 col-xs-5 menuTop">

                        <?php if (!isset($_SESSION['username'])): ?>
                            <a class="btn userCP" href="index.php?action=login" rel="nofollow">Đăng nhập</a>
                        <?php else: ?>
                            <div class="dropdown sa-user">
                                <div class="user-chip" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="user-chip__name"><?=$getUser['username']?></span>
                                    <span class="user-chip__sep"></span>
                                    <span class="user-chip__money"><?=format_cash($getUser['coin'])?>đ</span>
                                    <span class="user-chip__caret"></span>
                                </div>

                                <div class="dropdown-menu dropdown-usmenu">
                                    <?php if ($getUser['role'] == 1): ?>
                                        <a href="main.php?action=home-panel"><i class="fa fa-cog"></i>Quản Lý Website</a>
                                    <?php endif?>
                                    <a href="index.php?action=info"><i class="fa fa-user"></i>Thông tin tài khoản</a>
                                    <a href="index.php?action=history_balance"><i class="fa fa-exchange"></i>Thay đổi số dư</a>
                                    <a href="index.php?action=history_license" rel="nofollow"><i class="fa fa-clock-o"></i>Lịch sử license</a>
                                    <a href="index.php?action=document_api" rel="nofollow"><i class="fa fa-link"></i>Kết nối API</a>
                                    <a href="index.php?action=login"><i class="fa fa-sign-out"></i>Đăng xuất</a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div id="mainMenu">
                            <ul class="navmenu">
                                <!-- chỉ giữ nạp bank -->
                                <li>
                                    <a href="index.php?action=bank"><i class="fa fa-university"></i> Nạp Bank</a>
                                </li>
                                <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_menu` WHERE `status` = 1 ORDER BY `stt` ASC") as $menu): ?>
                                    <li><a href="index.php?action=menu&slug=<?=$menu['slug']?>"><?=$menu['name']?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </header>

    <div class="content-main">
        <?php
        $action = !empty($_GET['action']) ? xss($_GET['action']) : '';
        switch ($action) {
            case "login":    session_destroy(); include "includes/client/login.php"; break;
            case "register": session_destroy(); include "includes/client/register.php"; break;
            case "forgot":   session_destroy(); include "includes/client/forgot.php"; break;
            case "reset":    session_destroy(); include "includes/client/reset.php"; break;

            case "category": include "includes/client/category.php"; break;
            case "info":     include "includes/client/info.php"; break;
            case "menu":     include "includes/client/menu.php"; break;
            case "history":  include "includes/client/history.php"; break;
            case "document_api": include "includes/client/document_api.php"; break;

            case "card":     include "includes/client/card.php"; break;
            case "bank":     include "includes/client/bank.php"; break;

            case "blog":     include "includes/client/blog.php"; break;
            case "view_blog":include "includes/client/view_blog.php"; break;

            case "hosting":  include "includes/client/hosting.php"; break;
            case "history_hosting": include "includes/client/history_hosting.php"; break;
            case "panel_hosting":   include "includes/client/panel_hosting.php"; break;

            case "hackgame": include "includes/client/hackgame.php"; break;
            case "history_license": include "includes/client/history_license.php"; break;
            case "groups_hack": include "includes/client/groups_hack.php"; break;
            case "view_hack":  include "includes/client/view_hack.php"; break;

            case "history_balance": include "includes/client/history_balance.php"; break;
            case "logs": include "includes/client/logs.php"; break;

            /* admin */
            case "dashboard": include "includes/admin/dashboard.php"; break;
            case "list_category": include "includes/admin/list_category.php"; break;
            case "add_category": include "includes/admin/add_category.php"; break;
            case "edit_category": include "includes/admin/edit_category.php"; break;

            case "list_product": include "includes/admin/list_product.php"; break;
            case "add_product": include "includes/admin/add_product.php"; break;
            case "edit_product": include "includes/admin/edit_product.php"; break;

            case "list_users": include "includes/admin/list_users.php"; break;
            case "edit_users": include "includes/admin/edit_users.php"; break;

            case "list_bank": include "includes/admin/list_bank.php"; break;

            case "list_blog": include "includes/admin/list_blog.php"; break;
            case "edit_blogs": include "includes/admin/edit_blogs.php"; break;

            case "theme": include "includes/admin/theme.php"; break;
            case "settings": include "includes/admin/settings.php"; break;

            case "edit_bank": include "includes/admin/edit_bank.php"; break;
            case "list_hosting": include "includes/admin/list_hosting.php"; break;
            case "edit_hosting": include "includes/admin/edit_hosting.php"; break;
            case "order_hosting": include "includes/admin/order_hosting.php"; break;
            case "edit_order_hosting": include "includes/admin/edit_order_hosting.php"; break;
            case "list_category_hack": include "includes/admin/list_category_hack.php"; break;
            case "add_category_hack": include "includes/admin/add_category_hack.php"; break;
            case "list_groups_hack": include "includes/admin/list_groups_hack.php"; break;
            case "list_package_hack": include "includes/admin/list_package_hack.php"; break;
            case "list_license_hack": include "includes/admin/list_license_hack.php"; break;
            case "history_card": include "includes/admin/history_card.php"; break;
            case "history_bank": include "includes/admin/history_bank.php"; break;

            default:
            case "": include "includes/client/home.php"; break;
        }
        ?>
    </div>

    <!-- ✅ FOOTER: CHẮC CHẮN HIỆN -->
    <footer class="footer-force">
        <div class="container">
            <div class="ft-bottom-force">
                © Copyright 2026 Trần Hào Dev
            </div>
        </div>
    </footer>

</div><!-- /Wrapper -->

<script type="text/javascript" src="/dist/js/owl.carousel.js"></script>
<script type="text/javascript" src="/dist/js/jquery.mmenu.min.all.js"></script>
<script type="text/javascript" src="/dist/js/chosen.jquery.js"></script>
<script type="text/javascript" src="/dist/js/library.js"></script>

</body>
</html>