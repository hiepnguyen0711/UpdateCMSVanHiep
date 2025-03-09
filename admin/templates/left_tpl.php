<?php
// Define config variables with default values if not already set
$config_admin = isset($config_admin) ? $config_admin : true; 
$config_product = isset($config_product) ? $config_product : true;
$config_news = isset($config_news) ? $config_news : true;
$config_news_item = isset($config_news_item) ? $config_news_item : true;
$config_info = isset($config_info) ? $config_info : true;
$config_photo = isset($config_photo) ? $config_photo : true;
$config_contact = isset($config_contact) ? $config_contact : true;
$config_newsletter = isset($config_newsletter) ? $config_newsletter : true;
?>

<?php if($config_admin) { ?>
<li class="app-sidebar__heading">Cấu hình hệ thống</li>
<li>
    <a href="#">
        <i class="metismenu-icon fa fa-cogs"></i>
        Cấu hình website
    </a>
    <ul>
        <li>
            <a href="index.php?com=company&act=capnhat">
                <i class="metismenu-icon fa fa-building"></i>Thông tin công ty
            </a>
        </li>
        
        <li>
            <a href="index.php?com=about&act=capnhat">
                <i class="metismenu-icon fa fa-info-circle"></i>Giới thiệu công ty
            </a>
        </li>
        
        <li>
            <a href="index.php?com=footer&act=capnhat">
                <i class="metismenu-icon fa fa-paragraph"></i>Footer
            </a>
        </li>
        
        <li>
            <a href="index.php?com=title&act=capnhat">
                <i class="metismenu-icon fa fa-heading"></i>Tiêu đề website
            </a>
        </li>
        
        <li>
            <a href="index.php?com=meta&act=capnhat">
                <i class="metismenu-icon fa fa-tag"></i>Meta SEO
            </a>
        </li>
        
        <?php if(isset($_SESSION['login']['role']) && $_SESSION['login']['role']==1){ ?> 
        <li>
            <a href="index.php?com=admin&act=man">
                <i class="metismenu-icon fa fa-user-shield"></i>Quản lý admin
            </a>
        </li>
        <?php } ?>
    </ul>
</li>
<?php } ?>

<li class="app-sidebar__heading">Quản lý nội dung</li>

<?php if($config_product) { ?>
<li>
    <a href="#">
        <i class="metismenu-icon fa fa-box"></i>
        Sản phẩm
    </a>
    <ul>
        <li>
            <a href="index.php?com=product&act=man_danhmuc">
                <i class="metismenu-icon fa fa-folder"></i>Danh mục cấp 1
            </a>
        </li>
        
        <li>
            <a href="index.php?com=product&act=man_list">
                <i class="metismenu-icon fa fa-folder-open"></i>Danh mục cấp 2
            </a>
        </li>
        
        <li>
            <a href="index.php?com=product&act=man_cat">
                <i class="metismenu-icon fa fa-sitemap"></i>Danh mục cấp 3
            </a>
        </li>
        
        <li>
            <a href="index.php?com=product&act=man">
                <i class="metismenu-icon fa fa-boxes"></i>Quản lý sản phẩm
            </a>
        </li>
        
        <li>
            <a href="index.php?com=order&act=man">
                <i class="metismenu-icon fa fa-shopping-cart"></i>Quản lý đơn hàng
            </a>
        </li>
    </ul>
</li>
<?php } ?>

<?php if($config_news) { ?>
<li>
    <a href="#">
        <i class="metismenu-icon fa fa-newspaper"></i>
        Tin tức
    </a>
    <ul>
        <?php if($config_news_item) { ?>
        <li>
            <a href="index.php?com=news&act=man_item">
                <i class="metismenu-icon fa fa-folder"></i>Danh mục tin tức
            </a>
        </li>
        <?php } ?>
        
        <li>
            <a href="index.php?com=news&act=man">
                <i class="metismenu-icon fa fa-newspaper"></i>Quản lý tin tức
            </a>
        </li>
    </ul>
</li>
<?php } ?>

<?php if($config_info) { ?>
<li>
    <a href="#">
        <i class="metismenu-icon fa fa-file-alt"></i>
        Trang tĩnh
    </a>
    <ul>
        <li>
            <a href="index.php?com=info&act=capnhat&type=gioi-thieu">
                <i class="metismenu-icon fa fa-info-circle"></i>Giới thiệu
            </a>
        </li>
        
        <li>
            <a href="index.php?com=info&act=capnhat&type=dich-vu">
                <i class="metismenu-icon fa fa-concierge-bell"></i>Dịch vụ
            </a>
        </li>
        
        <li>
            <a href="index.php?com=info&act=capnhat&type=chinh-sach">
                <i class="metismenu-icon fa fa-shield-alt"></i>Chính sách
            </a>
        </li>
    </ul>
</li>
<?php } ?>

<?php if($config_photo) { ?>
<li>
    <a href="#">
        <i class="metismenu-icon fa fa-images"></i>
        Hình ảnh - Banner
    </a>
    <ul>
        <li>
            <a href="index.php?com=photo&act=edit&type=logo&id=1">
                <i class="metismenu-icon fa fa-image"></i>Logo
            </a>
        </li>
        
        <li>
            <a href="index.php?com=photo&act=edit&type=favicon&id=1">
                <i class="metismenu-icon fa fa-bookmark"></i>Favicon
            </a>
        </li>
        
        <li>
            <a href="index.php?com=photo&act=edit&type=banner&id=1">
                <i class="metismenu-icon fa fa-file-image"></i>Banner
            </a>
        </li>
        
        <li>
            <a href="index.php?com=photo&act=edit&type=background&id=1">
                <i class="metismenu-icon fa fa-image"></i>Background
            </a>
        </li>
        
        <li>
            <a href="index.php?com=photo&act=man&type=slider">
                <i class="metismenu-icon fa fa-sliders-h"></i>Slider
            </a>
        </li>
        
        <li>
            <a href="index.php?com=photo&act=man&type=doitac">
                <i class="metismenu-icon fa fa-handshake"></i>Đối tác
            </a>
        </li>
        
        <li>
            <a href="index.php?com=photo&act=man&type=mangxahoi">
                <i class="metismenu-icon fa fa-share-alt"></i>Mạng xã hội
            </a>
        </li>
    </ul>
</li>
<?php } ?>

<?php if($config_contact) { ?>
<li>
    <a href="index.php?com=contact&act=man">
        <i class="metismenu-icon fa fa-envelope"></i>
        Liên hệ
    </a>
</li>
<?php } ?>

<?php if($config_newsletter) { ?>
<li>
    <a href="index.php?com=newsletter&act=man">
        <i class="metismenu-icon fa fa-envelope-open"></i>
        Đăng ký nhận tin
    </a>
</li>
<?php } ?>

<li class="app-sidebar__heading">Công cụ hệ thống</li>
<li>
    <a href="index.php?com=user&act=admin_edit">
        <i class="metismenu-icon fa fa-user"></i>
        Tài khoản
    </a>
</li>

<li>
    <a href="index.php?com=user&act=logout">
        <i class="metismenu-icon fa fa-sign-out-alt"></i>
        Đăng xuất
    </a>
</li> 