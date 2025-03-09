<?php
// Lấy hình Banner
$banner_default = $d->getContent(721);
$banner = '';
$name = $row['ten'];
$alias = $row['alias'];
if (!empty($row['hinh_anh'])) {
    $banner = $row['hinh_anh'];
} else {
    $banner = $banner_default['hinh_anh'];
}

if ($source == 'tin-tuc-detail') {
    $cate = $d->getCate($row['id_loai']);
    $name = $cate['ten'];
    $alias = $cate['alias'];
}
?>

<div class="zc-banner-category" style="background: url('<?= Img($banner) ?>');">
    <div class="container">
        <!-- Banner BreadCrum -->
        <div class="zc-banner-breadcrumb">
            <ul>
                <li><a href="<?= URLLANG ?>"><?= $d->gettxt(11) ?></a></li>
                <li><a href="<?= URLLANG . $alias . ".html" ?>" class="active"><?= $name ?></a></li>
            </ul>
        </div>
    </div>
</div>