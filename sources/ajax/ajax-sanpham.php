<?php
include "ajax-config.php";

$id = isset($_POST['id']) ? $_POST['id'] : 0;

$spcap1 = $d->o_fet("select * from #_sanpham where hien_thi = 1 and noi_bat=1 and id_loai = " . $id . " " . _where_lang . " order by so_thu_tu,id desc limit 0,8");

?>

<?php if ($spcap1) { ?>
    <div class="row g-3 g-md-5">
        <?php foreach ($spcap1 as $v) { ?>
            <div class="col-6 col-md-3">
                <?php include "../module/sanpham-item.php"; ?>
            </div>
        <?php } ?>
    </div>
<?php } else { ?>
    <h5>Không có sản phẩm.</h5>

<?php } ?>