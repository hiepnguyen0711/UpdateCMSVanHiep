<?php
// Lấy sản phẩm danh mục đó
$sanpham = $d->o_fet("select * from #_sanpham where id_loai = {$v['id_code']} and hien_thi = 1 " . _where_lang . " order by so_thu_tu asc limit 0,9");
?>

<div class="zc-category-products">
    <div class="container">
        <!-- Title -->
        <div class="zc-category-product-title">
            <div class="zc-cate-title"><?= $v['ten'] ?></div>
            <div class="zc-cate-viewmore"><a href="<?= URLPATH . $v['alias'] . ".html" ?>">Xem tất cả <i class="fa-solid fa-circle-chevron-right"></i></a></div>
        </div>
        <!-- Content -->
        <div class="zc-category-product-content">
            <!-- Carousel start -->
            <div class="owl-carousel owl-theme owl-products-special">

                <?php
                foreach ($sanpham as $keys => $t) {
                ?>
                    <!-- Item -->
                    <div class="item col-text">
                        <?php include 'category-products-item.php'; ?>
                    </div>
                <?php } ?>
            </div>
            <!-- carousel end -->
        </div>
    </div>
</div>