<aside class="left-sidebar vip-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <div class="vip-brand">
            <a href="/" class="vip-brand__link">
                <span class="vip-brand__dot"></span>
                <div class="vip-brand__text">
                    <div class="vip-brand__title">MENU</div>
                    <div class="vip-brand__sub">Tối ưu mobile • tablet • PC</div>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="vip-nav">

                <li class="sidebar-item">
                    <a class="sidebar-link vip-link" href="/" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Trang Chủ</span>
                    </a>
                </li>

                <li class="list-divider vip-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">MENU</span></li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow vip-link" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu">Thể Loại</span>
                        <span class="vip-caret"></span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line vip-sub">
                        <?php foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_categories` WHERE `status`=1 ORDER BY `stt` ASC") as $row) : ?>
                            <li class="sidebar-item">
                                <a href="index.php?action=category&view=<?= $row['slug'] ?>" class="sidebar-link vip-sublink">
                                    <span class="hide-menu"><?= $row['name'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow vip-link" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu">Bán Hack Game</span>
                        <span class="vip-caret"></span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line vip-sub">
                        <li class="sidebar-item"><a href="index.php?action=hackgame" class="sidebar-link vip-sublink"><span class="hide-menu">Mua Hack Game</span></a></li>
                        <li class="sidebar-item"><a href="index.php?action=history_license" class="sidebar-link vip-sublink"><span class="hide-menu">Lịch Sử Thuê Hack</span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow vip-link" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu">Dịch Vụ Hosting</span>
                        <span class="vip-caret"></span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line vip-sub">
                        <li class="sidebar-item"><a href="index.php?action=hosting" class="sidebar-link vip-sublink"><span class="hide-menu">Mua Hosting</span></a></li>
                        <li class="sidebar-item"><a href="index.php?action=history_hosting" class="sidebar-link vip-sublink"><span class="hide-menu">Lịch Sử Mua Hosting</span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link vip-link" href="index.php?action=history" aria-expanded="false">
                        <i data-feather="shopping-cart" class="feather-icon"></i>
                        <span class="hide-menu">Lịch Sử Mua Hàng</span>
                    </a>
                </li>

                <li class="list-divider vip-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">NẠP TIỀN</span></li>

                <li class="sidebar-item">
                    <a class="sidebar-link vip-link" href="index.php?action=card" aria-expanded="false">
                        <i data-feather="sidebar" class="feather-icon"></i>
                        <span class="hide-menu">Nạp Thẻ Cào</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link vip-link" href="index.php?action=bank" aria-expanded="false">
                        <i data-feather="sidebar" class="feather-icon"></i>
                        <span class="hide-menu">Ví Điện Tử</span>
                    </a>
                </li>

                <li class="list-divider vip-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">KHÁC</span></li>

                <li class="sidebar-item">
                    <a class="sidebar-link vip-link" href="index.php?action=blog" aria-expanded="false">
                        <i data-feather="book-open" class="feather-icon"></i>
                        <span class="hide-menu">Bài Viết</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow vip-link" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="phone-call" class="feather-icon"></i>
                        <span class="hide-menu">Liên Hệ</span>
                        <span class="vip-caret"></span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line vip-sub">
                        <li class="sidebar-item"><a href="<?= $LOCNGUYEN_SIEUTHICODE->site('link_facebook') ?>" class="sidebar-link vip-sublink"><span class="hide-menu">Facebook</span></a></li>
                        <li class="sidebar-item"><a href="index.php?action=settings" class="sidebar-link vip-sublink"><span class="hide-menu">Zalo</span></a></li>
                    </ul>
                </li>

                <?php if (isset($_SESSION['username']) && $getUser['role'] == 1) : ?>
                    <li class="list-divider vip-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">ADMIN</span></li>

                    <li class="sidebar-item"><a class="sidebar-link vip-link" href="index.php?action=dashboard" aria-expanded="false"><i data-feather="pie-chart" class="feather-icon"></i><span class="hide-menu">Thống Kê</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link vip-link" href="index.php?action=list_category" aria-expanded="false"><i data-feather="folder" class="feather-icon"></i><span class="hide-menu">Quản Lý Danh Mục</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link vip-link" href="index.php?action=list_product" aria-expanded="false"><i data-feather="hard-drive" class="feather-icon"></i><span class="hide-menu">Mã Nguồn</span></a></li>

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow vip-link" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="crosshair" class="feather-icon"></i><span class="hide-menu">Dịch Vụ Key Tool</span>
                            <span class="vip-caret"></span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level base-level-line vip-sub">
                            <li class="sidebar-item"><a href="index.php?action=list_category_hack" class="sidebar-link vip-sublink"><span class="hide-menu">Danh Mục Key Tool</span></a></li>
                            <li class="sidebar-item"><a href="index.php?action=list_groups_hack" class="sidebar-link vip-sublink"><span class="hide-menu">Nhóm Key Tool</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow vip-link" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="crosshair" class="feather-icon"></i><span class="hide-menu">Dịch Vụ Hosting</span>
                            <span class="vip-caret"></span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level base-level-line vip-sub">
                            <li class="sidebar-item"><a href="index.php?action=list_hosting" class="sidebar-link vip-sublink"><span class="hide-menu">Danh Sách Gói Hosting</span></a></li>
                            <li class="sidebar-item"><a href="index.php?action=order_hosting" class="sidebar-link vip-sublink"><span class="hide-menu">Đơn Hàng Hosting</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"><a class="sidebar-link vip-link" href="index.php?action=list_bank" aria-expanded="false"><i data-feather="credit-card" class="feather-icon"></i><span class="hide-menu">Ngân Hàng</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link vip-link" href="index.php?action=list_blog" aria-expanded="false"><i data-feather="book-open" class="feather-icon"></i><span class="hide-menu">Bài Viết</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link vip-link" href="index.php?action=list_users" aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span class="hide-menu">Khách Hàng</span></a></li>

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow vip-link" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="crosshair" class="feather-icon"></i><span class="hide-menu">Lịch Sử</span>
                            <span class="vip-caret"></span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level base-level-line vip-sub">
                            <li class="sidebar-item"><a href="index.php?action=history_card" class="sidebar-link vip-sublink"><span class="hide-menu">Lịch sử nạp thẻ</span></a></li>
                            <li class="sidebar-item"><a href="index.php?action=history_bank" class="sidebar-link vip-sublink"><span class="hide-menu">Lịch sử nạp bank</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow vip-link" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="settings" class="feather-icon"></i><span class="hide-menu">Cấu Hình</span>
                            <span class="vip-caret"></span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level base-level-line vip-sub">
                            <li class="sidebar-item"><a href="index.php?action=theme" class="sidebar-link vip-sublink"><span class="hide-menu">Giao diện</span></a></li>
                            <li class="sidebar-item"><a href="index.php?action=settings" class="sidebar-link vip-sublink"><span class="hide-menu">Cài đặt hệ thống</span></a></li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>
</aside>

<style>
/* ====== VIP SIDEBAR THEME (KHÔNG ĐỔI LOGIC) ====== */
:root{
  --sb-bg1:#070d1c;
  --sb-bg2:#0a1226;
  --sb-card: rgba(255,255,255,.06);
  --sb-border: rgba(255,255,255,.12);
  --sb-text: rgba(255,255,255,.90);
  --sb-muted: rgba(255,255,255,.65);
  --sb-primary:#3b82f6;
  --sb-primary2:#2563eb;
  --sb-radius: 18px;
}

/* nền aside */
.vip-sidebar.left-sidebar{
  background: linear-gradient(180deg, var(--sb-bg2), var(--sb-bg1)) !important;
  border-right: 1px solid rgba(255,255,255,.08);
}

/* scroll area */
.vip-sidebar .scroll-sidebar{
  padding: 12px 10px 14px;
}

/* brand */
.vip-brand{
  padding: 8px 6px 12px;
}
.vip-brand__link{
  display:flex; align-items:center; gap:12px;
  text-decoration:none !important;
  padding: 12px 12px;
  border-radius: var(--sb-radius);
  border:1px solid var(--sb-border);
  background: rgba(255,255,255,.05);
  backdrop-filter: blur(10px);
  box-shadow: 0 14px 40px rgba(0,0,0,.35);
}
.vip-brand__dot{
  width:12px; height:12px; border-radius:50%;
  background: var(--sb-primary);
  box-shadow: 0 0 0 8px rgba(59,130,246,.14);
  animation: sbPulse 1.6s infinite;
}
@keyframes sbPulse{
  0%{ box-shadow: 0 0 0 0 rgba(59,130,246,.25); }
  70%{ box-shadow: 0 0 0 12px rgba(59,130,246,0); }
  100%{ box-shadow: 0 0 0 0 rgba(59,130,246,0); }
}
.vip-brand__title{
  font-weight: 900;
  color: var(--sb-text);
  letter-spacing:.3px;
}
.vip-brand__sub{
  margin-top:2px;
  font-size: 12px;
  color: var(--sb-muted);
}

/* list */
.vip-nav{
  padding: 8px 0 0;
}

/* divider */
.vip-divider{
  border-color: rgba(255,255,255,.10) !important;
  margin: 10px 0 !important;
}

/* small cap */
.vip-sidebar .nav-small-cap{
  margin: 10px 8px 6px;
  padding: 0;
}
.vip-sidebar .nav-small-cap .hide-menu{
  display:block;
  font-size: 11px;
  letter-spacing: .22em;
  color: rgba(255,255,255,.55) !important;
  font-weight: 900;
}

/* link base */
.vip-sidebar .sidebar-item .vip-link,
.vip-sidebar .sidebar-item .sidebar-link{
  display:flex;
  align-items:center;
  gap: 12px;
  border-radius: 14px;
  margin: 6px 6px;
  padding: 11px 12px;
  color: var(--sb-text) !important;
  border: 1px solid transparent;
  background: transparent;
  transition: transform .15s ease, background .15s ease, border-color .15s ease;
}
.vip-sidebar .sidebar-item .sidebar-link i,
.vip-sidebar .sidebar-item .vip-link i{
  opacity: .95;
}

/* hover */
.vip-sidebar .sidebar-item .sidebar-link:hover,
.vip-sidebar .sidebar-item .vip-link:hover{
  background: rgba(255,255,255,.06);
  border-color: rgba(59,130,246,.22);
  transform: translateY(-1px);
}

/* active (nếu theme có class active) */
.vip-sidebar .sidebar-item.active > .sidebar-link,
.vip-sidebar .sidebar-item.active > .vip-link{
  background: linear-gradient(135deg, rgba(59,130,246,.22), rgba(37,99,235,.12));
  border-color: rgba(59,130,246,.30);
}

/* caret (tạo mũi tên đẹp, không phá JS has-arrow) */
.vip-caret{
  margin-left:auto;
  width: 8px; height: 8px;
  border-right: 2px solid rgba(255,255,255,.55);
  border-bottom: 2px solid rgba(255,255,255,.55);
  transform: rotate(-45deg);
  transition: transform .18s ease, opacity .18s ease;
  opacity: .9;
}
.vip-sidebar .sidebar-link[aria-expanded="true"] .vip-caret{
  transform: rotate(45deg);
}

/* sub menu */
.vip-sub{
  padding: 6px 0 6px;
  margin: 0 6px 6px;
  border-radius: 14px;
  border:1px solid rgba(255,255,255,.08);
  background: rgba(0,0,0,.18);
  overflow:hidden;
}
.vip-sidebar .vip-sublink{
  margin: 4px 8px !important;
  padding: 9px 12px !important;
  border-radius: 12px !important;
  color: rgba(255,255,255,.88) !important;
  background: transparent !important;
  border: 1px solid transparent !important;
}
.vip-sidebar .vip-sublink:hover{
  background: rgba(255,255,255,.06) !important;
  border-color: rgba(255,255,255,.10) !important;
}

/* tối ưu chữ, tránh mờ */
.vip-sidebar .hide-menu{
  font-weight: 800;
  letter-spacing:.15px;
}

/* mobile: sidebar thường là overlay của template, chỉ làm đẹp scrollbar */
.vip-sidebar .scroll-sidebar::-webkit-scrollbar{ width: 8px; }
.vip-sidebar .scroll-sidebar::-webkit-scrollbar-thumb{
  background: rgba(255,255,255,.12);
  border-radius: 999px;
}
.vip-sidebar .scroll-sidebar::-webkit-scrollbar-track{
  background: rgba(255,255,255,.04);
}
</style>