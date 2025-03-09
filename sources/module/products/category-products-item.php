<div class="category-products-item" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="<?= $keys * 100 ?>">
    <div class="zc-cate-product-item-img-box anhsang-container scale-img">
        <a href="<?= URLPATH . $t['alias'] . ".html" ?>"><img src="<?= Img($t['hinh_anh']) ?>" alt="Sản phẩm Image"></a>
        <div class="anhsang"></div>
    </div>
    <!-- Nền vàng content -->
    <div class="zc-cate-yellow-bg-content">
        <h3><?= $t['ten'] ?></h3>
        <div class="zc-cate-yellow-bg-price content-1">
            <?php
            if ($t['khuyen_mai'] != 0 && $t['khuyen_mai'] != null) {
            ?>
                <!-- Giá khuyến mãi -->
                <h5><?= number_format($t['khuyen_mai']) ?> đ</h5>
                <!-- Giá góc -->
                <h6><?= number_format($t['gia']) ?> đ</h6>
            <?php } else { ?>
                <h4 class="content-1">Liên hệ</h4>
            <?php } ?>
        </div>
        <div class="content-2">
            <div class="zc-btn-group">
                <a href="<?= URLPATH . $t['alias'] . ".html" ?>">
                    <div class="zc-btn-xemthem ">Xem chi tiết</div>
                </a>
                <!-- Button mua ngay -->
                <button type="button" class="zc-btn-muangay addcartnow" data-id=<?= $t['id_code'] ?>>Mua ngay</button>
            </div>

        </div>
    </div>
</div>