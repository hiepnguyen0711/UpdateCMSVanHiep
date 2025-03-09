<?php
// lấy cate
$cate = $d->getCate($row['id_loai']);

// lấy album ảnh
$album_product = $d->o_fet("select hinh_anh from #_sanpham_hinhanh where id_sp = {$row['id_code']} order by stt asc");

// lấy list bình luận
$list_bl = $d->o_fet("select * from #_binhluan where id_tin =" . (int)$row['id_code'] . " and trang_thai = 1 and parent=0 order by id DESC ");
$count_bl = $d->num_rows("select * from #_binhluan where id_tin =" . (int)$row['id_code'] . " and trang_thai = 1 and parent=0 and danh_gia > 0 order by id DESC ");
$tongsao = $d->simple_fetch("select sum(danh_gia) as tong from #_binhluan where id_tin =" . (int)$row['id_code'] . " and trang_thai = 1 and parent=0 and danh_gia > 0 order by id DESC ");
if ($count_bl > 0) {
    $sao_trung_binh = $tongsao['tong'] / $count_bl;
} else {
    $sao_trung_binh = 0;
}

?>

<section class="vs-service-event-detail">
    <div class="container">
        <h2 class="vs-title">
            <?= $cate['ten'] ?>
        </h2>
        <!-- slider start -->
        <div class="vs-service-slider mt-4">
            <div class="row gy-3">
                <!-- main start -->
                <div class="col-9 col-lg-9">
                    <div class="swiper vs-sk-Swiper2">
                        <div class="swiper-wrapper">
                            <!-- item start -->
                            <div class="swiper-slide">
                                <a class="MagicZoom magiczoom-fancybox" data-zoom-image="<?= Img($row['hinh_anh']) ?>" data-fancybox="gallery" href="<?= Img($row['hinh_anh']) ?>">
                                    <img src="<?= Img($row['hinh_anh']) ?>" />
                                </a>
                            </div>
                            <!--item end  -->
                            <?php
                            if (!empty($album_product)) {

                                foreach ($album_product as $key => $v) {
                            ?>
                                    <!-- item start -->
                                    <div class="swiper-slide">
                                        <a class="MagicZoom magiczoom-fancybox" data-zoom-image="<?= Img($v['hinh_anh']) ?>" data-fancybox="gallery" href="<?= Img($v['hinh_anh']) ?>">
                                            <img src="<?= Img($v['hinh_anh']) ?>" alt="Hình sản phẩm" />
                                        </a>
                                    </div>
                                    <!--item end  -->
                            <?php }
                            } ?>

                        </div>

                    </div>
                </div>
                <!-- main end -->

                <!-- extra start -->
                <div class="col-3 col-lg-3">
                    <div class="swiper vs-sk-Swiper">
                        <div class="swiper-wrapper">
                            <!-- item start -->
                            <div class="swiper-slide">
                                <img class="product-extra-img" src="<?= Img($row['hinh_anh']) ?>" alt="Hình sản phẩm" />
                            </div>
                            <!-- item end -->
                            <?php
                            if (!empty($album_product)) {

                                foreach ($album_product as $key => $v) {
                            ?>
                                    <!-- item start -->
                                    <div class="swiper-slide">
                                        <img class="product-extra-img" src="<?= Img($v['hinh_anh']) ?>" alt="Hình sản phẩm" />
                                    </div>
                                    <!--item end  -->
                            <?php }
                            } ?>

                        </div>
                    </div>
                </div>
                <!-- extra end -->

            </div>
        </div>
        <!-- slider end -->

        <!-- tên sản pham -->
        <h1 class="service-name"><?= $row['ten']; ?></h1>

        <!-- giá tiền start -->
        <div class="vs-service-price">
            <?php
            // nếu có giá tiền
            if (!empty($row['gia'])) {
                // nếu có giá và có khuyến mãi
                if (!empty($row['khuyen_mai'])) {
            ?>
                    <!-- no sale start -->
                    <div class="service-price-no-sale">
                        <?= number_format($row['gia']) ?> đ
                    </div>
                    <!-- no sale end -->
                    <div class="service-price-sale">
                        <?= number_format($row['khuyen_mai']) ?> đ
                    </div>
                <?php } else {
                    // nếu không có khuyến mãi
                ?>
                    <!-- no sale start -->
                    <div class="service-price-sale">
                        <?= number_format($row['gia']) ?> đ
                    </div>
                    <!-- no sale end -->
                <?php } ?>

            <?php } else {
                // nếu ko có giá tiền
            ?>

                <div class="service-price-sale">
                    Liên hệ để nhận báo giá
                </div>
            <?php } ?>
        </div>
        <!-- giá tiền end -->

        <!-- thông số đánh giá start -->
        <div class="specification-review">
            <div class="specification-text">
                <?= count($list_bl) ?> đánh giá
            </div>
            <div class="specification-star">
                <?php
                for ($i = 0; $i < round($sao_trung_binh); $i++) {
                ?>
                    <i class="fa-solid fa-star"></i>
                <?php } ?>

            </div>
        </div>
        <!-- thông số đánh giá end -->


        <!-- button đặt lịch ngay start -->
        <div class="vs-service-detail-btn-booknow hvr-icon-wobble-horizontal">
            <button type="button" class="vs-service-btn-booknow" data-bs-toggle="modal" data-bs-target="#modalBookNow"><span class="vs-text-gradient">Đặt lịch ngay</span></button>
            <!-- icon start -->
            <div class="vs-service-btn-icon hvr-icon" data-bs-toggle="modal" data-bs-target="#modalBookNow">
                <i class="fa-solid fa-angle-right "></i>
            </div>
            <!-- icon end -->
        </div>
        <!-- button đặt lịch ngay end -->

        <!-- NỘI DUNG VÀ MÔ TẢ START -->
        <div class="vs-service-detail-content-describe">
            <div class="vs-service-detail-describe p-3">
                <?= $row['mo_ta']; ?>
            </div>
            <div class="vs-service-detail-content-text p-3">
                <?= $row['noi_dung']; ?>
            </div>
        </div>
        <!-- NỘI DUNG VÀ MÔ TẢ END -->

        <!-- ĐÁNH GIÁ KHÁCH HÀNG START -->
        <div class="vs-service-detail-review mt-3">
            <h2 class="vs-title">Đánh giá khách hàng</h2>
            <?php include 'module/customer-review.php'; ?>
        </div>
        <!-- ĐÁNH GIÁ KHÁCH HÀNG END -->

    </div>
</section>



<!-- Modal đặt lịch ngay start -->

<!-- Modal -->
<div class="modal fade" id="modalBookNow" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalBookNowLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body vs-contact-body">
                <!-- nội dung start -->
                <div class="row row-cols-1 row-cols-lg-2 g-0">
                    <div class="col">
                        <div class="ban-do">
                            <?= _bando ?>
                        </div>
                    </div>
                    <!-- form liên hệ -->
                    <div class="col">
                        <div class="container">
                            <div class="vs-book-now-content">
                                <?php
                                // lấy nội dung
                                $booknow = $d->getContent(800);
                                ?>
                                <h3><?= $booknow['ten']; ?></h3>
                                <span>
                                    <?= $booknow['noi_dung']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="vs-book-now-form mt-3 ">
                            <div class="container">
                                <form action="" method="post">
                                    <div class="row row-cols-2 gx-5 gy-3">
                                        <div class="col">
                                            <input type="text" name="ho_ten" placeholder="HỌ VÀ TÊN">
                                        </div>
                                        <div class="col">
                                            <input type="number" name="dien_thoai" placeholder="ĐIỆN THOẠI">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="dia_chi" placeholder="ĐỊA CHỈ">
                                        </div>
                                        <div class="col">
                                            <input class="form-ngay" type="datetime-local" name="ngay" placeholder="NGÀY">
                                        </div>
                                        <div class="col-12">
                                            <textarea rows="1" type="text" name="noi_dung" placeholder="NỘI DUNG CHI TIẾT"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <div class="g-recaptcha" data-sitekey="<?= _sitekey ?>"></div>
                                        </div>
                                        <div class="col-12 pb-3">
                                            <div class="vs-btn-book-now-template">
                                                <button type="submit" name="lienhe" class="codepen-button"><span>Gửi</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- form liên hệ end -->
                </div>
                <!-- nội dung end -->
            </div>
        </div>
    </div>
</div>
<!-- Modal đặt lịch ngay End -->