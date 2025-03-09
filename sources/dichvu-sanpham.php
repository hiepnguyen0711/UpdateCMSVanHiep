<?php
$service_list = $d->o_fet("select * from #_category where hien_thi = 1 and id_loai = 229 " . _where_lang . " order by so_thu_tu asc, id desc");
// nguyên tắc giao hàng
$principles_of_delivery_list = $d->getContents(1032);
// quản lý dịch vụ
$manager_service = $d->getContent(1035);
// Hình quảng cáo
$picture_ad = $d->getContent(1036);
?>



<!-- breadcrumb start -->
<?php include 'module/sca-breadcrumb.php'; ?>
<!-- breadcrumb end -->
<!-- banner start -->
<?php include 'module/sca-banner.php'; ?>
<!-- banner end -->

<!-- danh sách dịch vụ start -->
<section class="sca-service-page-section">
    <div class="container">
        <div class="sca-service-page-section-content">
            <div class="row flex-column-reverse flex-lg-row gx-5 gy-4">
                <div class="col-12 col-lg-8">
                    <div class="sca-service-page-section-content-item">
                        <div class="row row-cols-1 row-cols-lg-2 gx-5 gy-4">
                            <?php
                            foreach ($service_list as $key => $v) {
                            ?>
                                <!-- item start -->
                                <div class="col">
                                    <div class="sca-service-page-section-content-subitem">
                                        <div class="sca-service-page-section-content-subitem-title mb-3 d-flex align-items-center">
                                            <div class="sca-service-page-section-content-subitem-icon">
                                                <img class="" data-src="<?= Img($v['icon']) ?>" alt="icon dịch vụ">
                                            </div>
                                            <div class="sca-service-page-section-content-subitem-name py-1 px-3">
                                                <?= $v['ten'] ?>
                                            </div>
                                        </div>
                                        <div class="sca-service-page-section-content-subitem-content catchuoi3 mb-2" data-aos="fade-up" data-aos-duration="500" data-aos-delay="<?= ($key + 1) * 100 ?>" data-aos-once="true" data-aos-offset="-20">
                                            <?= $v['noi_dung'] ?>
                                        </div>
                                        <div class="sca-service-page-section-content-subitem-link d-flex justify-content-end">
                                            <a href="<?= URLLANG . $v['alias'] . ".html" ?>" class="hvr-icon-wobble-horizontal" data-aos="fade-up" data-aos-duration="500" data-aos-delay="<?= ($key + 1) * 200 ?>" data-aos-once="true" data-aos-offset="-30">
                                                <span class="hvr-underline-from-left"><?= $d->gettxt(114) ?></span>
                                                <svg class="hvr-icon" width="41" height="10" viewBox="0 0 41 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.88843 8.52051H37.7949L30.7404 1.27783" stroke="url(#paint0_linear_58_8831)" stroke-width="2" stroke-linecap="round" />
                                                    <defs>
                                                        <linearGradient id="paint0_linear_58_8831" x1="21.3726" y1="4.89917" x2="28.0653" y2="14.98" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#ff5226" />
                                                            <stop offset="1" stop-color="#ff5226" />
                                                        </linearGradient>
                                                    </defs>
                                                </svg>


                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- item end -->
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="sca-service-page-section-content-item">
                        <div class="sca-service-page-section-content-item-right">
                            <div class="sca-service-page-section-content-item-right-box">
                                <!-- title -->
                                <div class="sca-service-page-section-content-item-right-title py-3 px-2 text-center">
                                    <?= $d->gettxt(27) . " " . $row['ten'] ?>
                                </div>
                                <!-- content start -->
                                <div class="sca-service-page-section-content-item-right-content">
                                    <div class="accordion" id="service_list">
                                        <?php
                                        foreach ($service_list as $key => $v) {
                                            if ($key == 0) {
                                                $service_collapse = "";
                                                $service_show = "show";
                                            } else {
                                                $service_collapse = "collapsed";
                                                $service_show = "";
                                            }
                                        ?>
                                            <!-- item start -->
                                            <div class="accordion-item accordion-service-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button <?= $service_collapse ?>" type="button" data-bs-toggle="collapse" data-bs-target="#serviceCollapse-<?= $key ?>" aria-expanded="true" aria-controls="serviceCollapse-<?= $key ?>">
                                                        <div class="accordion-service-item-icon me-3">
                                                            <img data-src="<?= Img($v['icon']) ?>" alt="icon service category">
                                                        </div>
                                                        <div class="accordion-service-item-text">
                                                            <?= $v['ten'] ?>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="serviceCollapse-<?= $key ?>" class="accordion-collapse collapse <?= $service_show ?>" aria-labelledby="headingOne" data-bs-parent="#service_list">
                                                    <div class="accordion-body accordion-service-item-body p-2">
                                                        <div class="accordion-service-item-body-box p-3">
                                                            <?= $v['mo_ta'] ?>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- danh sách dịch vụ end -->

<!-- nguyên tắc giao hàng start -->
<section class="sca-service-principles-of-delivery">
    <div class="sca-service-principles-of-delivery-box">
        <div class="row row-cols-1 gy-4">
            <?php
            foreach ($principles_of_delivery_list as $key => $v) {
                if ($key % 2 == 0) {
                    $principles_bg = "sca-principles-left";
                    $principles_row = "";
                    $principles_padding = "pe-lg-5";
                } else {
                    $principles_bg = "sca-principles-right";
                    $principles_row = "flex-lg-row-reverse";
                    $principles_padding = "ps-lg-5";
                }
            ?>
                <!-- item start -->
                <div class="col">
                    <div class="sca-service-principles-of-delivery-box-parent-item <?= $principles_bg  ?>">
                        <!-- ITEM CHILD START -->
                        <?php include 'module/sca-service-principles-item.php'; ?>
                        <!-- ITEM CHILD END -->
                    </div>
                </div>
                <!-- item end -->
            <?php } ?>
        </div>
    </div>

</section>
<!-- nguyên tắc giao hàng end -->

<!-- quản lý dịch vụ start -->
<section class="sca-service-manager-service">
    <div class="container">
        <div class="sca-service-manager-service-content">
            <!-- title start -->
            <div class="sca-service-manager-service-title text-center mb-3 sca-core-values-content-subitem-title"
            data-aos="fade-up" data-aos-duration="500" data-aos-delay="0" data-aos-once="true"
            >
                <?= $manager_service['ten'] ?>
            </div>
            <!-- title end -->
            <!-- content start -->
            <div class="sca-service-manager-service-des text-center sca-core-values-content-subitem-des mb-3"
            data-aos="fade-up" data-aos-duration="500" data-aos-delay="200" data-aos-once="true"
            >
                <?= $manager_service['noi_dung'] ?>
            </div>
            <!-- content end -->
            <!-- button view more start -->
            <div class="principles-of-delivery-button text-center">
                <a <?= vanhiep_link($manager_service) ?> class="btn sca-btn hvr-float-shadow hvr-icon-wobble-horizontal">
                    <?= $d->gettxt(114) ?>
                    <svg class="hvr-icon" width="41" height="11" viewBox="0 0 41 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.86719 9.14429H37.7737L30.7191 1.90161" stroke="white" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </a>
            </div>
            <!-- button view more end -->
        </div>
    </div>
</section>
<!-- quản lý dịch vụ end -->


<!-- quảng cáo start -->
<!-- hình quảng cáo -->
<section class="sca-background-ad pb-0">
    <div class="sca-background-ad-image ratio">
        <a <?= vanhiep_link($picture_ad) ?>>
            <img class="" data-src="<?= Img($picture_ad['hinh_anh']) ?>" alt="Ảnh banner quảng cáo">
        </a>
    </div>
</section>
<!-- quảng cáo end -->