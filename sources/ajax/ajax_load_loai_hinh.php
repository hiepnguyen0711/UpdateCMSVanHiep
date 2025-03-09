<?php
include 'ajax-config.php';
$loai_hinh = addslashes($_POST['loai_hinh']);

if ($loai_hinh == 1) {
    $loai_hinh_list = $d->o_fet("select * from #_category where module = 2 and id_loai != 0 " . _where_lang . " order by so_thu_tu asc, id desc");
} else {
    $loai_hinh_list = $d->o_fet("select * from #_category where module = 29 and id_loai != 0 " . _where_lang . " order by so_thu_tu asc, id desc");
}
foreach ($loai_hinh_list as $key => $v) {
?>
    <option value="<?= $v['id_code'] ?>"><?= $v['ten'] ?></option>
<?php

}
