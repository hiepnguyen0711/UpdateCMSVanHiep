<div class="col zc-news-items" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="<?= $key * 100 ?>">
    <div class="row zc-news-top-item gx-3 gy-4">
        <!-- Hình ảnh tin tức -->
        <div class="col-12 col-lg-5 zc-news-top-img-box anhsang-container ">
            <a href="<?= URLPATH . $v['alias'] . ".html" ?>"><img src="<?= Img($v['hinh_anh']) ?>" alt="Tin nổi bật Image"></a>
            <div class="anhsang"></div>
        </div>
        <!-- Nội dung tin tức -->
        <div class="col-12 col-lg-7 zc-news-top-content">
            <h3><a href="<?= URLPATH . $v['alias'] . ".html" ?>" class="catchuoi2"><?= $v['ten'] ?></a></h3>
            <!-- Mô tả tin tức -->
            <div class="zc-news-top-des catchuoi4">
                <?= $v['mo_ta'] ?>
            </div>
        </div>
    </div>
</div>