<?php
// $tin_lienquan
$tintuc_moi = $d->o_fet("select * from #_tintuc where hien_thi =1 " . _where_lang . " order by so_thu_tu ASC, id DESC limit 0,5 ");
?>
<div class="wrapper-main">
    <div class="container">
        <div class="news-detalis-content mb-50">
            <?= cf_tag_html($row['ten'], _heading_ct_new, 'title-news_ct mb-4') ?>
            <div class="news-detalis">
                <?php if ($row['noi_dung'] != '') { ?>
                    <?= content_mucluc($row['noi_dung'], $url_page) ?>
                <?php } ?>
            </div>
        </div>
        <?php if (_tac_gia_new == 1 and $row['id_user'] > 0) {
            $tac_gia =     $d->simple_fetch("select hinh_anh, ho_ten, noi_dung from #_user where id= " . $row['id_user'] . "");
        ?>
            <div class=" box_tacgia">
                <div class="row">
                    <div class="box_tacgia_avata col-lg-2 col-sm-3 col-4">
                        <img src="<?= Img($tac_gia['hinh_anh']) ?>" alt="<?= $tac_gia['ho_ten'] ?>" />
                    </div>
                    <div class="box_tacgia_tt col-lg-10 col-sm-9 col-8">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            </svg>
                            Giới thiệu về tác giả <b><a href="<?= URLPATH ?>author.html?code=<?= $row['id_user'] ?>"><?= $tac_gia['ho_ten'] ?></a></b>
                        </p>
                        <div>
                            <i><?= catchuoi($tac_gia['noi_dung'], 1050) ?></i>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>
    </div>
</div>