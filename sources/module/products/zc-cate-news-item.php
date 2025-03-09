<div class="zc-cate-news-item" data-aos="fade-up-right" data-aos-duration="1200" data-aos-delay="<?= $key * 100 ?>">
    <!-- hình ảnh -->
    <div class="zc-news-img-box anhsang-container scale-img">
        <img data-src="<?= Img($v['hinh_anh']) ?>" alt="Tin tức">
        <div class="anhsang"></div>
    </div>
    <!-- Nội dung -->
    <div class="zc-cate-news-item-content">
        <h3><a href="" class="catchuoi2"><?= $v['ten'] ?></a></h3>
        <h4><?= date('d/m/Y', $v['ngay_dang']) ?></h4>
        <h5 class="catchuoi3"><?= $v['mo_ta'] ?></h5>
        <h6><a href="<?= URLPATH . $v['alias'] . ".html" ?>">Xem thêm <i class="fa-solid fa-arrow-right-long"></i></a></h6>
    </div>
</div>