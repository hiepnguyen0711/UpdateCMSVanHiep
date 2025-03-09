<?php
session_start();
$link = explode("?", $_SERVER['REQUEST_URI']);
if ($link[1] != '') {
    $vari = explode("&", $link[1]);
    $search = array();
    foreach ($vari as $item) {
        $str = explode("=", $item);
        $search["$str[0]"] = $str[1];
    }
}
$hinh_anh_sp    =   $d->o_fet("select * from #_sanpham_hinhanh where id_sp = " . $row['id_code'] . " ");
$ma_sp          =   $row['ma_sp'];
$soluong_con    =   $row['so_luong'];
$id_loai = $category['id_code'] . $d->getIdsub($category['id_code']);
$sanphamcl = $d->o_fet("select * from #_sanpham where id_loai in ($id_loai) and hien_thi =1 " . _where_lang . " and id <> " . $row['id'] . " order by so_thu_tu ASC, id DESC limit 0,4 ");

$cart_link = $d->getCate(121);
if (isset($_POST['addcart'])) {
    $id_pro = $_POST['id_sp'];
    $soluong = $_POST['soluong'];
    $color = $_POST['p-color'];
    $size = $_POST['p-size'];
    // var_dump($soluong."+++".$id_pro);
    // die();
    $d->addtocart($soluong, $id_pro, $color, $size);
    header("Location:" . URLLANG . $cart_link['alias'] . ".html");
}
// dd($url_page);

// Lấy danh sách sản phẩm đề xuất
$cate_parent = $d->getCate($row['id_loai']);
?>

<link href="<?= URLPATH ?>templates/module/magiczoomplus/magiczoomplus.css" rel="stylesheet" />
<script src="<?= URLPATH ?>templates/module/magiczoomplus/magiczoomplus.js"></script>


<!-- breadcrumb start  -->
<?php include 'module/nb-breadcrumb.php'; ?>
<!-- breadcrumb end -->


<!-- Content Product Detail -->
<section class="ft-product-detail nb-product-detail-section">
    <!-- Content start -->
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 gx-5 gy-4 bee-product-detail-row align-items-start mb-3 mb-lg-5">
            <!-- Slider start -->
            <div class="col">
                <div class="row bee-product-slider">

                    <!-- extra start -->
                    <div class="col-2">
                        <!-- Extra start -->
                        <div thumbsSlider="" class="swiper ftSwiper nbExtraSwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="hq-slide-product-main-image nb-slide-product-extra-image ratio ratio-4x3">
                                        <img class="ft-extra-image" src="<?= Img($row['hinh_anh']) ?>" />
                                    </div>
                                </div>
                                <!-- Kiểm tra hình con sản phẩm -->
                                <?php
                                if (count($hinh_anh_sp) > 0) {
                                    foreach ($hinh_anh_sp as $key => $v) {
                                ?>

                                        <div class="swiper-slide">
                                            <div class="hq-slide-product-main-image nb-slide-product-extra-image ratio ratio-4x3">
                                                <img class="ft-extra-image" src="<?= Img($v['hinh_anh']) ?>">
                                            </div>
                                        </div>
                                <?php }
                                } ?>

                            </div>
                        </div>
                        <!-- Extra end -->
                    </div>
                    <!-- extra end -->

                    <!-- main start -->
                    <div class="col-10">
                        <!-- Main start -->
                        <div class="swiper ftSwiper2 mb-2">
                            <div class="swiper-wrapper">
                                <!-- Item start -->
                                <div class="swiper-slide">
                                    <div class="hq-slide-product-main-image ratio ratio-4x3">
                                        <a class="MagicZoom magiczoom-fancybox" data-zoom-image="<?= Img($row['hinh_anh']) ?>" data-fancybox="gallery" href="<?= Img($row['hinh_anh']) ?>">
                                            <img class="ft-main-image" src="<?= Img($row['hinh_anh']) ?>" />
                                        </a>
                                    </div>
                                </div>
                                <!-- Item end -->
                                <!-- Kiểm tra hình con sản phẩm -->
                                <?php
                                if (count($hinh_anh_sp) > 0) {
                                    foreach ($hinh_anh_sp as $key => $v) {
                                ?>

                                        <div class="swiper-slide">
                                            <div class="hq-slide-product-main-image ratio ratio-4x3">
                                                <a class="MagicZoom magiczoom-fancybox" data-zoom-image="<?= Img($v['hinh_anh']) ?>" data-fancybox="gallery" href="<?= Img($v['hinh_anh']) ?>">
                                                    <img class="ft-main-image" src="<?= Img($v['hinh_anh']) ?>">
                                                </a>
                                            </div>

                                        </div>
                                <?php }
                                } ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <!-- Main end -->
                    </div>
                    <!-- main end -->



                </div>
                <!-- Swiper -->



                <!-- Swiper end -->

            </div>
            <!-- Slider end -->

            <div class="col">
                <!-- Thông số start -->
                <div class="ft-product-detail-info">
                    <div class="nb-product-brand">
                        <?php
                        // lấy tên thương hiệu
                        $brand_name = $d->getCate($row['brand']);
                        echo $brand_name['ten'];
                        ?>
                    </div>
                    <div class="nb-product-name-detail"><?= $row['ten'] ?></div>

                    <!-- giảm giá start -->
                    <?php if (!empty($row['khuyen_mai'])) { ?>
                        <div class="bee-sale-phantram">
                            <i class="fa-solid fa-tag"></i> <?= check_ptram($row['gia'], $row['khuyen_mai']) ?> %
                        </div>
                    <?php } ?>
                    <!-- Giảm giá end -->

                    <!-- giá start -->
                    <div class="bee-product-price my-2">
                        <?php
                        if (!empty($row['gia'])) { ?>
                            <!-- Nếu có giá tiền -->
                            <?php
                            // nếu có khuyến maiũ
                            if (!empty($row['khuyen_mai'])) { ?>
                                <div class="bee-price">
                                    <?= number_format($row['gia']); ?> đ
                                </div>
                                <div class="bee-sale">
                                    <?= number_format($row['khuyen_mai']); ?> đ
                                </div>
                            <?php   } else {
                                // nếu ko có khuyến mãi 
                            ?>
                                <div class="bee-sale">
                                    <?= number_format($row['gia']); ?> đ
                                </div>
                            <?php
                            }
                            ?>

                        <?php   } else {
                            // nếu ko có giá tiền 
                        ?>
                            <div class="bee-sale">
                                <?= $d->gettxt(209) ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- giá end -->





                    <!-- ĐẶT HÀNG START -->
                    <form action="" method="post" id="form-cart" class="mb-3">
                        <input type="hidden" value="<?= $_SESSION['token'] ?>" name="_token" />
                        <input type="hidden" value="<?= $row['id_code'] ?>" name="id_sp" />
                        <input type="hidden" value="1" name="soluong" />
                        <!-- kích thước start -->
                        <div class="bee-product-size">

                            <!-- size start -->
                            <?php
                            // lấy kích cỡ size
                            $product_size = $d->o_fet("select * from #_sanpham_chitiet where id_sp = {$row['id_code']} order by id asc");
                            if (!empty($product_size)) {
                            ?>
                                <div class="nb-product-size mb-3">
                                    <select class="form-select" required name="p-size" aria-label="Default select example">
                                        <option value="0" disabled>Size</option>
                                        <?php
                                        foreach ($product_size as $key => $v) {
                                        ?>
                                            <!-- item start -->
                                            <option value="<?= $v['id'] ?>"><?= $v['ten'] ?></option>
                                            <!-- item end -->
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                            <!-- size end -->

                            <!-- nút thêm vào giỏ hàng start -->
                            <div class="bee-product-btn-cart mt-3 nb-btn-add-cart-box">
                                <div class="row gx-3 gy-4">
                                    <!-- thêm vào giỏ hàng -->
                                    <div class="col-10 col-lg-10 bee-btn-addcartnow">
                                        <div class="nb-btn-add-cart-box-item">
                                            <button type="submit" class="nb-btn-addcart" name="addcart" data-id=<?= $row['id_code'] ?>><span><?= $d->gettxt(223) ?></span></button>
                                        </div>
                                    </div>

                                    <!-- mua ngay -->
                                    <div class="col-2 col-lg-2 bee-btn-buy-now">
                                        <div class="nb-btn-add-cart-box-item">
                                            <div class="nb-btn-add-cart-box-item-heart-box d-inline-flex justify-content-center align-items-center">
                                                <i class="fa-regular fa-heart"></i>
                                            </div>

                                        </div>
                                    </div>
                                    <!--  -->
                                </div>
                            </div>
                            <!-- nút thêm vào giỏ hàng end -->

                        </div>
                        <!-- kích thước end -->
                    </form>

                    <!-- ĐẶT HÀNG END -->

                    <!-- Thông số kỹ thuật start -->
                    <div class="nb-thong-so-ky-thuat ">
                        <div class="nb-thong-so-ky-thuat-title mb-2">
                            <?= $d->gettxt(231) ?>
                        </div>
                        <?= $row['noi_dung_1'] ?>
                    </div>
                    <!-- Thông số kỹ thuật end -->

                </div>
                <!-- Thông số end -->


            </div>
        </div>

        <!-- Chi tiết sản phẩm nội dung start -->
        <div class="nb-product-detail-content-box mb-5">
            <!-- title start -->
            <div class="nb-product-brand mb-3">
                <?php
                echo  $d->gettxt(24);
                ?>
                <!-- title end -->
                <div class="nb-product-detail-content-box-des p-2">
                    <?= $row['noi_dung'] ?>
                </div>

            </div>
        </div>

        <!-- mô tả start -->
        <div class="nb-product-detail-content-box">
            <!-- title start -->
            <div class="nb-product-brand mb-3">
                <?php
                echo  $d->gettxt(221);
                ?>
                <!-- title end -->
                <div class="nb-product-detail-content-box-des p-2">
                    <?= $row['mo_ta'] ?>
                </div>
            </div>
        </div>
        <!-- mô tả end -->
        <!-- chi tiết sản phẩm nội dung end -->

    </div>

    <!-- Content end -->
</section>



<?php
$product_related = $d->o_fet("select * from #_sanpham where hien_thi = 1 and id_loai = {$row['id_loai']} and id_code != {$row['id_code']} " . _where_lang . " order by RAND() limit 0,9");
?>


<!-- sản phẩm cùng loại -->
<section class="nb-index-product-bestseller-section">
    <div class="container">
        <div class="nb-index-product-bestseller-content">
            <div class="nb-index-product-bestseller-title-box d-flex w-100 justify-content-between align-items-center">
                <!-- title start -->
                <div class="nb-index-product-bestseller-title mb-3 mb-lg-4">
                    <?php
                    $title = $d->gettxt(131);
                    include 'sources/module/nb-category-title.php';
                    ?>
                </div>
                <!-- title end -->

                <!-- xem all start -->
                <div class="nb-index-product-bestseller-a">
                    <a title="" href="<?= URLLANG . $cate_parent['alias'] . ".html" ?>">
                        <?= $d->gettxt(228) ?>
                    </a>
                </div>
                <!-- xem all end -->
            </div>

            <!-- content start -->
            <div class="nb-index-product-bestseller-content-box">
                <!-- Swiper -->
                <div class="swiper nb-swiper-bestseller">
                    <div class="swiper-wrapper">
                        <?php 
                            foreach($product_related as $key => $v) { 
                        ?>
                        <!-- item start -->
                        <div class="swiper-slide">
                            <?php include 'sources/module/nb-product-item.php'; ?>
                        </div>
                       <!-- item end -->
                       <?php  } ?>
                    </div>
                </div>
            </div>
            <!-- content end -->
        </div>
    </div>
</section>
<!-- sản phẩm cùng loại end -->



<script>
    $(document).ready(function() {
        $(".magiczoom-fancybox").on("click", function(e) {
            e.preventDefault();

            var imageUrl = $(this).attr("href");

            // Apply MagicZoom functionality
            $(this).addClass("MagicZoom").attr("data-options", "zoom-position: inner").attr("data-zoom-image", imageUrl);

            // Open Fancybox
            $.fancybox.open({
                type: "image",
                src: imageUrl
            });
        });
    });
</script>