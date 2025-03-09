<?php
// lấy danh sách danh mục cấp 2
$cate_level_2 = $d->o_fet("select ten from #_category where hien_thi = 1 and id_loai = {$v['id_code']} " . _where_lang . " order by so_thu_tu asc");
if (count($cate_level_2) > 0) {
?>
    <!-- Content Card start -->
    <div class="ft-cate-product-card">
        <div class="card">
            <?php
            foreach ($cate_level_2 as $keys => $t) {
            ?>
                <p><span><?= $t['ten'] ?></span></p>
            <?php } ?>

        </div>
    </div>
    <!-- Content Card end -->
<?php } ?>