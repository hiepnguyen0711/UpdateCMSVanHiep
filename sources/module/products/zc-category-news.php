<?php
$news_cate = $d->getCate(114);
// Lấy tin tức mới nhất
$zc_news_top = $d->o_fet("select * from #_tintuc where hien_thi = 1 and id_loai = 114 " . _where_lang . " order by ngay_dang desc limit 0,10");

?>

<div class="zc-category-news">
    <div class="container">
        <!-- Title -->
        <div class="zc-category-product-title">
            <div class="zc-cate-title"><?= $d->gettxt(141) ?></div>
            <div class="zc-cate-viewmore"><a href="<?= URLPATH . $news_cate['alias'] . ".html" ?>">Xem tất cả <i class="fa-solid fa-circle-chevron-right"></i></a></div>
        </div>
        <!-- Content -->
        <div class="zc-cate-news-content">
            <!-- Carousel start -->
            <div class="owl-carousel owl-theme owl-category-news-page">
                <?php
                foreach ($zc_news_top as $key => $v) {
                ?>
                    <div class="item">
                        <?php include 'zc-cate-news-item.php'; ?>
                    </div>
                <?php } ?>


            </div>
            <!-- Carousel END -->
        </div>
    </div>
</div>