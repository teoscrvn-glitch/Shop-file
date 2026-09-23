<style>

.left-sidebar{
    background:#0f172a;
    width:270px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    overflow-y:auto;
    border-right:1px solid rgba(255,255,255,0.08);
}

/* scroll */
.left-sidebar::-webkit-scrollbar{
    width:6px;
}
.left-sidebar::-webkit-scrollbar-thumb{
    background:#334155;
}

/* menu */
.sidebar-nav ul{
    padding:15px 10px;
}

.nav-small-cap{
    color:#94a3b8;
    font-size:12px;
    letter-spacing:1px;
    padding:10px 10px;
    font-weight:700;
}

/* item */
.sidebar-item{
    margin-bottom:6px;
}

.sidebar-link{
    display:flex;
    align-items:center;
    padding:12px 14px;
    border-radius:8px;
    text-decoration:none;
    color:#ffffff;
    font-weight:600;
    transition:0.2s;
}

/* icon */
.sidebar-link i{
    margin-right:10px;
    width:18px;
    height:18px;
}

/* hover */
.sidebar-link:hover{
    background:#1e293b;
}

/* active */
.sidebar-link.active{
    background:#2563eb;
}

/* submenu */
.collapse{
    padding-left:15px;
}

.collapse .sidebar-link{
    font-size:14px;
    padding:10px 12px;
    color:#e2e8f0;
}

/* mobile */
@media(max-width:768px){

.left-sidebar{
    width:220px;
}

.sidebar-link span{
    font-size:14px;
}

}

</style>



<aside class="left-sidebar">

<div class="scroll-sidebar">

<nav class="sidebar-nav">

<ul id="sidebarnav">

<?php if (isset($_SESSION['username']) && $getUser['role'] == 1) : ?>

<li class="nav-small-cap">Trang Quản Trị Viên</li>


<li class="sidebar-item">
<a class="sidebar-link" href="main.php?action=home-panel">
<i data-feather="pie-chart"></i>
<span>Thống Kê</span>
</a>
</li>


<li class="sidebar-item">
<a class="sidebar-link" data-toggle="collapse" href="#toolmenu">
<i data-feather="crosshair"></i>
<span>Dịch Vụ Key Tool</span>
</a>

<ul id="toolmenu" class="collapse">

<li class="sidebar-item">
<a href="main.php?action=list_category_hack" class="sidebar-link">
<span>Danh Mục Key Tool</span>
</a>
</li>

<li class="sidebar-item">
<a href="main.php?action=list_groups_hack" class="sidebar-link">
<span>Nhóm Key Tool</span>
</a>
</li>

</ul>
</li>


<li class="sidebar-item">
<a class="sidebar-link" href="main.php?action=list_bank">
<i data-feather="credit-card"></i>
<span>Ngân Hàng</span>
</a>
</li>


<li class="sidebar-item">
<a class="sidebar-link" href="main.php?action=list_users">
<i data-feather="users"></i>
<span>Khách Hàng</span>
</a>
</li>


<li class="sidebar-item">
<a class="sidebar-link" href="main.php?action=list_menu">
<i data-feather="align-justify"></i>
<span>Cài Đặt Menu</span>
</a>
</li>


<li class="sidebar-item">

<a class="sidebar-link" data-toggle="collapse" href="#historymenu">
<i data-feather="clock"></i>
<span>Lịch Sử</span>
</a>

<ul id="historymenu" class="collapse">

<li class="sidebar-item">
<a href="main.php?action=history_card" class="sidebar-link">
<span>Lịch sử nạp thẻ</span>
</a>
</li>

<li class="sidebar-item">
<a href="main.php?action=history_bank" class="sidebar-link">
<span>Lịch sử nạp bank</span>
</a>
</li>

</ul>

</li>



<li class="sidebar-item">

<a class="sidebar-link" data-toggle="collapse" href="#configmenu">
<i data-feather="settings"></i>
<span>Cấu Hình</span>
</a>

<ul id="configmenu" class="collapse">

<li class="sidebar-item">
<a href="main.php?action=theme" class="sidebar-link">
<span>Giao diện</span>
</a>
</li>

<li class="sidebar-item">
<a href="main.php?action=settings" class="sidebar-link">
<span>Cài đặt hệ thống</span>
</a>
</li>

</ul>

</li>

<?php endif; ?>

</ul>

</nav>

</div>

</aside>

<script>
feather.replace();
</script>