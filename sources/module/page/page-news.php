<?php
// lấy tin nổi bật
$news_hot = $d->o_fet("select ten,hinh_anh,alias, mo_ta from #_tintuc where hien_thi = 1 and noi_bat = 1 " . _where_lang . " order by RAND() limit 0,5");
?>

<div class="zc-page-news">
    <h2><?= $d->gettxt(139) ?></h2>
    <div class="zc-page-news-content">
        <div class="row row-cols-1">
            <?php
            foreach ($news_hot as $key => $v) {
            ?>
                <?php include 'page-news-item.php'; ?>
            <?php } ?>

        </div>
    </div>
</div>