<?php
$nav_left = $d->o_fet("select id, ten, alias from #_category where hien_thi=1 and id_loai = 42 " . _where_lang . " ");
$iddvall = '41' . $d->findIdSub(41);
$dichvu = $d->o_fet("select id, ten, alias, hinh_anh, mo_ta from #_tintuc where hien_thi=1 and id_loai in ({$iddvall}) " . _where_lang . " ");
$httt = $d->o_fet("select id, ten, hinh_anh, email, dienthoai, mess, skype, zalo from #_hotrotructuyen where hien_thi=1 ");
$idtvall = '59' . $d->findIdSub(59);
$tuvankt = $d->o_fet("select id, ten, alias, hinh_anh, mo_ta from #_tintuc where hien_thi=1 and id_loai in ({$idtvall}) " . _where_lang . " order by so_thu_tu,id desc " . _where_lang . " ");
?>
<div class="box-left danhmuc_left">
    <h2 class="title-home2"><span>Danh mục sản phẩm</span></h2>
    <ul class="left__box">
        <?php foreach ($nav_left as $key => $value) {
            $danhmucc2 = $d->o_fet("select id, ten, alias from #_category where hien_thi=1 and id_loai= " . $value['id'] . " order by so_thu_tu asc, id desc");

        ?>
            <li>
                <a href="<?= URLPATH . $value['alias'] ?>.html" title="<?= $value['ten'] ?>">
                    <?= $value['ten'] ?>
                    <?php if ($danhmucc2) { ?><i class="fa-solid fa-caret-down"></i><?php } ?>
                </a>
                <?php if ($danhmucc2) { ?>
                    <ul class="box-cap2">
                        <?php foreach ($danhmucc2 as $v2) {
                            $danhmucc3 = $d->o_fet("select ten, alias from #_category where hien_thi=1 and id_loai= " . $v2['id'] . " order by so_thu_tu asc, id desc");
                        ?>
                            <li>
                                <a href="<?= $v2['alias'] ?>.html">
                                    <?= $v2['ten'] ?>
                                    <?php if ($danhmucc3) { ?><i class="fa-solid fa-caret-down"></i><?php } ?>
                                </a>
                                <ul class="box-cap3">
                                    <?php foreach ($danhmucc3 as $v3) { ?>
                                        <li>
                                            <a href="<?= $v3['alias'] ?>.html"><?= $v3['ten'] ?></a>

                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
</div>

<div class="box-left hotrotructuyen">
    <h2 class="title-home2"><span>Hỗ trợ trực tuyến</span></h2>
    <div class="hotro">
        <?php foreach ($httt as $v) { ?>
            <div class="hotr__box">
                <div class="hotr__left">
                    <p class="img-container "><img src="<?= Img($v['hinh_anh']); ?>" /></p>
                </div>
                <div class="hotr__right">
                    <div class="hotr__ten"><?= $v['ten'] ?></div>
                    <div class="hotr__dienthoai"><i class="fa-solid fa-phone"></i> <?= $v['dienthoai'] ?></div>
                    <div class="hotr__email"><i class="fa-solid fa-envelope"></i> <?= $v['email'] ?></div>
                    <ul class=" hotr__mxh d-flex align-items-center">
                        <li><a href="<?= $v['mess'] ?>" class="xoay_hinh"><img src="templates/images/mess.png" alt="" class="xoay_hinh"></a></li>
                        <li><a href="https://zalo.me/<?= $v['zalo'] ?>" target="_blank" class="xoay_hinh"><img src="templates/images/zalo.png" alt=""></a></li>
                        <li><a href="skype:<?= $v['skype'] ?>?call" class="xoay_hinh"><img src="templates/images/skype.png" alt=""></a></li>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="box-left danhmuc_left">
    <h2 class="title-home2"><span>Tư vấn kỹ thuật</span></h2>
    <ul class="left__box">
        <?php foreach ($tuvankt as $key => $value) {
            $danhmucc2 = $d->o_fet("select id, ten, alias from #_category where hien_thi=1 and id_loai= " . $value['id'] . " order by so_thu_tu asc, id desc");

        ?>
            <li>
                <a href="<?= URLPATH . $value['alias'] ?>.html" title="<?= $value['ten'] ?>">
                    <?= $value['ten'] ?>
                    <?php if ($danhmucc2) { ?><i class="fa-solid fa-caret-down"></i><?php } ?>
                </a>
                <?php if ($danhmucc2) { ?>
                    <ul class="box-cap2">
                        <?php foreach ($danhmucc2 as $v2) {
                            $danhmucc3 = $d->o_fet("select ten, alias from #_category where hien_thi=1 and id_loai= " . $v2['id'] . " order by so_thu_tu asc, id desc");
                        ?>
                            <li>
                                <a href="<?= $v2['alias'] ?>.html">
                                    <?= $v2['ten'] ?>
                                    <?php if ($danhmucc3) { ?><i class="fa-solid fa-caret-down"></i><?php } ?>
                                </a>
                                <ul class="box-cap3">
                                    <?php foreach ($danhmucc3 as $v3) { ?>
                                        <li>
                                            <a href="<?= $v3['alias'] ?>.html"><?= $v3['ten'] ?></a>

                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
</div>

<?php /* <div class="box-left hotrotructuyen">
        <h2 class="title-home2"><span><?= _support_online ?></span></h2>
        <div class="hotro">
            <p class="img-container "><img src="<?= URLIMG . $support[0]['hinh_anh'] ?>" /></p>
            <div class="hotline-right">
                <?= $company['dienthoai'] ?> - <?= $company['hotline'] ?>
            </div>
            <div class="mxh-left d-flex align-items-center">
                <ul>
                    <li><a href="skype:<?= $support[0]['skype'] ?>?call"><img src="templates/images/skype.png" alt=""></a></li>
                    <li><a href="tel:<?= $support[0]['sdt'] ?>"><img src="templates/images/hotline4.png" alt=""></a></li>
                    <li><a href="https://zalo.me/<?= $support[0]['zalo'] ?>" target="_blank"><img src="templates/images/zalo.png" alt=""></a></li>
                </ul>
                <div class="box__right">
                    <p><?= $support[0]['ten_' . $lang] ?></p>
                    <div class="sdt__right"><?= $support[0]['sdt'] ?></div>
                </div>
            </div>

            <div class="email-httt">
                <?= $support[0]['gmail'] ?>
            </div>

        </div>
    </div>

    <div class="box-left box-spbanchay">
        <h2 class="title-home2"><span>Sản phẩm bán chạy</span></h2>
        <div class="spbanchay">
            <div class="slick-banchay">
                <?php foreach ($spbanchay as $v) { ?>
                    <?php include "ct_product.php" ?>

                <?php } ?>
            </div>
        </div>
    </div>

    <div class="box-left box-bvmoi">
        <h2 class="title-home2"><span>Bài viết mới</span></h2>
        <div class="bvmoi">
            <ul class="bvmoi-list">
                <?php foreach ($bvmoi as $v) { ?>
                    <li><a href="<?= $v['alias_' . $lang] ?>.html"><?= $v['ten_' . $lang] ?></a></li>

                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="box-left box-video">
        <h2 class="title-home2"><span>Video clip</span></h2>
        <div class="video-body">
            <a class="video" data-fancybox data-src="<?= $video['link'] ?>">
                <div class="img-container scale-img"><img src="<?= $d->getImageYoutube($video['link']) ?>" alt=""></div>
                <div class="video-play"><i class="fa-solid fa-play"></i></div>
            </a>
        </div>
    </div>*/ ?>