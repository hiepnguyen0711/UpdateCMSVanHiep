<?php
$mxhfix = $d->getContents(169);
?>

<style>
    .mxh__fixed {
        position: fixed;
        left: 10px;
        bottom: 13%;
        z-index: 99;
    }

    .mxh__fixed ul li+li {
        margin-top: 10px;
    }

    .mxh__fixed ul li {
        display: block;
    }

    .mxh__fixed ul li img {
        transition: 0.5s;
        max-height: 50px;
    }

    .mxh__fixed ul {
        padding: 0px;
        margin-bottom: 0px;
    }
</style>

<div class="mxh__fixed">
    <ul>
        <?php foreach ($mxhfix as $v) { ?>
            <li><a class="xoay_hinh" href="<?= $v['link'] ?>"><img src="<?= URLPATH . "img_data/images/" . $v['hinh_anh'] ?>" alt="<?= $v['ten_' . $lang] ?>"></a></li>

        <?php } ?>
    </ul>
</div>