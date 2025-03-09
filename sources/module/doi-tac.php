<?php
$doitac = $d->getContents(392);
?>

<section class="doitac">
    <div class="doitac__block py-4">
        <div class="container ">
            <div class="owl-carousel owl-theme owl-doitac">
                <?php foreach ($doitac as $dt) { ?>
                    <div class="doitac-item">
                        <a href="<?= $dt['link'] ?>" class="doitac-img img-container">
                            <img src="<?= Img($dt['hinh_anh']) ?>" />
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>