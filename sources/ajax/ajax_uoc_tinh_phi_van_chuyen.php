<?php
include 'ajax-config.php';

$province_send = validate_content($_POST['province_send']);
$province_receive = validate_content($_POST['province_receive']);
$district_send = validate_content($_POST['district_send']);
$district_receive = validate_content($_POST['district_receive']);
$weight = validate_content($_POST['weight']);
$cod = addslashes(($_POST['cod'] == '') ? 0 : $_POST['cod']);

if (empty($cod)) {
    $cod = 0;
}

// API tính giá
$price_url = "http://api-cus.scaexpress.vn/price/get-price";
$price_data = array(
    "cod" => $cod,
    "receiver_district_id" => $district_receive,
    "receiver_province_id" => $province_receive,
    "sender_district_id" => $district_send,
    "sender_province_id" => $province_send,
    "weight" => $weight
);
$options = array(
    'http' => array(
        'header'  => "Content-Type: application/json",
        'method'  => 'POST',
        'content' => json_encode($price_data)
    )
);
$context  = stream_context_create($options);
$price_response = file_get_contents($price_url, false, $context);
$price_result = json_decode($price_response, true);
// Xử lý dữ liệu ở đây

// dd($price_result);

// nếu ko có lỗi
if ($price_result['error'] == '') {
    // nếu có dữ liệu
    if (!empty($price_result['data'])) {
        $price_result_list = $price_result['data']; ?>
        <div class="sca-tc-uoc-tinh-info p-3 p-lg-5 mb-5">
            <div class="sca-tc-uoc-tinh-info-title text-center mb-2">
                <?= $d->gettxt(260) ?>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 gx-5 gy-4 mb-3">
                <?php
                foreach ($price_result_list as $key => $v) { ?>
                    <!-- item start -->
                    <div class="col">
                        <div class="sca-tc-uoc-tinh-info-cost-item d-flex flex-column align-items-center">
                            <div class="sca-tc-uoc-tinh-info-cost-title text-center mb-2">
                                <?= $v['service_code'] . " - " . $v['service_name'] ?>
                            </div>
                            <div class="sca-tc-uoc-tinh-info-cost text-center">
                                <?= number_format($v['fee']) ?> VNĐ
                            </div>

                        </div>

                    </div>
                    <!-- item end -->
                <?php  }  ?>
            </div>
            <div class="sca-tc-uoc-tinh-info-des text-center">
                <?= $d->gettxt(261) ?>
            </div>
        </div>

    <?php
    } else {
        // nếu ko có dữ liệu thì hiện giá mặc định
        $price_result_list = $d->getContents(1073);
    ?>
        <div class="sca-tc-uoc-tinh-info p-3 p-lg-5 mb-5">
            <div class="sca-tc-uoc-tinh-info-title text-center mb-2">
                <?= $d->gettxt(260) ?>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 gx-5 gy-4 mb-3">
                <?php
                foreach ($price_result_list as $key => $v) { ?>
                    <!-- item start -->
                    <div class="col">
                        <div class="sca-tc-uoc-tinh-info-cost-item d-flex flex-column align-items-center">
                            <div class="sca-tc-uoc-tinh-info-cost-title text-center mb-2">
                                <?= $v['ten'] . " - " . $v['link'] ?>
                            </div>
                            <div class="sca-tc-uoc-tinh-info-cost text-center">
                                <?= number_format($v['chucvu']) ?> VNĐ
                            </div>

                        </div>

                    </div>
                    <!-- item end -->
                <?php  }  ?>
            </div>
            <div class="sca-tc-uoc-tinh-info-des text-center">
                <?= $d->gettxt(261) ?>
            </div>
        </div>

<?php
    }
} else { ?>
    <div class="text-center fs-5 api-tra-cuu-thong-bao">
        <?php
        echo $price_result['message'];
        ?>
    </div>
<?php }
