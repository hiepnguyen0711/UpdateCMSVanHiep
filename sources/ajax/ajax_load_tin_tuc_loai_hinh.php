<?php
include 'ajax-config.php';
$loai_hinh = validate_content($_POST['loai_hinh']);
$id_loai = validate_content($_POST['id_loai']);

// lấy 3 tin tức mới nhất
$recruitment_list_hot = $d->o_fet("select * from #_tintuc where hien_thi = 1 and id_loai = {$id_loai} " . _where_lang . " order by so_thu_tu asc, id desc limit 0,3");

?>

<div class="row gy-3">
    <div class="col-12 col-lg-8">
        <div class="sca-contact-recruitment-box-content-item">
            <!-- hình -->
            <div class="sca-contact-recruitment-box-content-item-image mb-3 ratio ratio-16x9">
                <a href="<?= URLLANG . $recruitment_list_hot[0]['alias'] . ".html" ?>" title="<?= $recruitment_list_hot[0]['ten'] ?>">
                    <img class="hvr-grow" src="<?= Img($recruitment_list_hot[0]['hinh_anh']) ?>" alt="ảnh tin tức">
                </a>
            </div>
            <!-- tên -->
            <div class="sca-contact-recruitment-box-content-item-name mb-2">
                <a href="<?= URLLANG . $recruitment_list_hot[0]['alias'] . ".html" ?>" class="catchuoi2">
                    <?= $recruitment_list_hot[0]['ten'] ?>
                </a>
            </div>
            <!-- ngày đăng -->
            <div class="sca-contact-recruitment-box-content-item-date mb-2">
                <?= date('d/m/Y', $recruitment_list_hot[0]['ngay_dang']) ?>
            </div>
            <!-- mô tả -->
            <div class="sca-contact-recruitment-box-content-item-des catchuoi2">
                <?= $recruitment_list_hot[0]['mo_ta'] ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="sca-contact-recruitment-box-content-item">
            <div class="row row-cols-1 gy-3">
                <?php
                foreach ($recruitment_list_hot as $key => $v) {
                    if ($key > 0) {
                ?>
                        <!-- item start -->
                        <div class="col">
                            <div class="sca-contact-recruitment-box-content-item">
                                <!-- hình -->
                                <div class="sca-contact-recruitment-box-content-item-image mb-3 ratio ratio-16x9">
                                    <a href="<?= URLLANG . $v['alias'] . ".html" ?>" title="<?= $v['ten'] ?>">
                                        <img class="hvr-grow" src="<?= Img($v['hinh_anh']) ?>" alt="ảnh tin tức">
                                    </a>
                                </div>
                                <!-- tên -->
                                <div class="sca-contact-recruitment-box-content-item-name mb-2">
                                    <a href="<?= URLLANG . $v['alias'] . ".html" ?>" class="catchuoi2">
                                        <?= $v['ten'] ?>
                                    </a>
                                </div>
                                <!-- ngày đăng -->
                                <div class="sca-contact-recruitment-box-content-item-date mb-2">
                                    <?= date('d/m/Y', $v['ngay_dang']) ?>
                                </div>
                                <!-- mô tả -->
                                <div class="sca-contact-recruitment-box-content-item-des catchuoi2">
                                    <?= $v['mo_ta'] ?>
                                </div>
                            </div>
                        </div>
                        <!-- item end -->

                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>