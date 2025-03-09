<?php
include 'ajax-config.php';
$province_id = validate_content($_POST['province']);


// API danh mục quận/huyện
$district_list_url = "http://api-cus.scaexpress.vn/categories/list-district?province_id={$province_id}";
$district_response = file_get_contents($district_list_url);
$district_data = json_decode($district_response, true);
$district_list = $district_data['data'];

foreach ($district_list as $key => $v) {
?>

    <option value="<?= $v['district_id'] ?>"><?= $v['district_name'] ?></option>
<?php } ?>