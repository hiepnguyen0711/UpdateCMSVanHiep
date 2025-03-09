<?php
// lấy danh sách thương hiệu
$brand_list = $d->o_fet("select * from #_category where hien_thi = 1 and id_loai = 210 " . _where_lang . " order by so_thu_tu asc, id desc");


?>

<section class="nb-brand-section-page">
    <div class="container">
        <div class="nb-brand-section-page-content">
            <!-- title start -->
            <div class="nb-page-about-us-page-content-title text-center nb-brand-title mb-3 mb-lg-5" data-aos="fade-up" data-aos-duration="500" data-aos-delay="0">
                <?= $row['ten'] ?>
            </div>
            <!-- title end -->

            <!-- content start -->
            <div class="nb-brand-section-page-content-box">
                <div class="row row-cols-2 row-cols-md-4 gx-5 gy-4">
                    <?php
                    foreach ($brand_list as $key => $v) {
                    ?>
                        <!-- item start -->
                        <div class="col">
                            <div class="nb-brand-section-page-content-box-item">
                                <div class="nb-brand-section-page-content-box-item-image-box p-3">
                                    <div class="nb-brand-section-page-content-box-item-image ratio ratio-1x1">
                                        <a href="<?= URLLANG . $v['alias'] . ".html" ?>">
                                            <img class="hvr-shrink" data-src="<?= Img($v['hinh_anh']) ?>" alt="ảnh thương hiệu">
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- item end -->
                    <?php } ?>
                </div>
            </div>
            <!-- content end -->
        </div>
    </div>
</section>