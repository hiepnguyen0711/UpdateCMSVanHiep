<div class="col-12 js-news-item">
    <div class="zc-news-item">
        <div class="row gy-3">
            <!-- Hình ảnh -->
            <div class="col-12 col-lg-6">
                <div class="zc-news-item-image-box anhsang-container scale-img">
                    <a href="<?= URLLANG . $v['alias'] . ".html" ?>">
                        <img data-src="<?= Img($v['hinh_anh']) ?>" alt="Tin tức Image">
                    </a>
                    <div class="anhsang"></div>
                </div>
            </div>
            <!-- Nội dung -->
            <div class="col-12 col-lg-6">
                <div class="zc-news-item-content-page">
                    <!-- tiêu đề -->
                    <h2><a href="<?= URLLANG . $v['alias'] . ".html" ?>" class="catchuoi2"><?= $v['ten'] ?></a></h2>
                    <!-- Mô tả -->
                    <div class="zc-news-item-des-page catchuoi4">
                        <?= $v['mo_ta'] ?>
                    </div>
                    <!-- Button xem chi tiết -->
                    <a href="<?= URLLANG . $v['alias'] . ".html" ?>">
                        <div class="zc-btn-view-news"><i class="fa-solid fa-right-long"></i> <?= $d->gettxt(114); ?></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>