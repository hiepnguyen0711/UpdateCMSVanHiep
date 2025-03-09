<?php
include 'ajax-config.php';
$ma_van_don = validate_content($_POST['ma_van_don']);


// API tra cứu hành trình
$journey_url = "http://api-cus.scaexpress.vn/bill/list-journeys?order_number=" . $ma_van_don;
$journey_response = file_get_contents($journey_url);
$journey_data = json_decode($journey_response, true);
// Xử lý dữ liệu ở đây

?>

<?php
if ($journey_data['error']) { ?>
    <div class="text-center fs-5 api-tra-cuu-thong-bao">
        <?php
        echo $journey_data['message'];
        ?>
    </div>
    <?php } else {
    if (empty($journey_data['data'])) { ?>
        <!-- nếu ko tồn tài -->
        <div class="text-center fs-4 api-tra-cuu-thong-bao">
            <?php echo $d->gettxt(279);
            // echo $journey_data['message'];
            ?>
        </div>
    <?php
    } else { ?>
        <!-- nếu có tồn tại thì -->
        <!-- tra cứu info start -->
        <div class="tc-info-box p-3 p-lg-5">
            <div class="tc-info-box-title text-center mb-3">
                <?= $d->gettxt(242); ?>
            </div>
            <div class="tc-info-box-content p-3 p-lg-5">
                <!-- khung mã đơn hàng start -->
                <div class="tc-info-box-content-table p-3 mb-3">
                    <div class="row row-cols-1 g-0">
                        <!-- item start -->
                        <div class="tc-info-box-item">
                            <div class="row gx-4 gy-4">
                                <!-- mã hóa đơn -->
                                <div class="col-4">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-title">
                                            <?= $d->gettxt(243) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-des">
                                            <?= $journey_data['data']['order_number']; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- tên người gửi -->
                                <div class="col-4">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-title">
                                            <?= $d->gettxt(244) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-des">
                                            <?= $journey_data['data']['sender_name']; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Số điện thoại -->
                                <div class="col-4">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-title">
                                            <?= $d->gettxt(245) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-des">
                                            <?= $journey_data['data']['sender_phone']; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Địa chỉ người gửi -->
                                <div class="col-4">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-title">
                                            <?= $d->gettxt(246) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-des">
                                            <?= $journey_data['data']['sender_address']; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- tên người nhận -->
                                <div class="col-4">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-title">
                                            <?= $d->gettxt(247) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-des">
                                            <?= $journey_data['data']['receiver_name']; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- sđt người nhận -->
                                <div class="col-4">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-title">
                                            <?= $d->gettxt(248) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-des">
                                            <?= $journey_data['data']['receiver_phone']; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- địa chỉ người nhận -->
                                <div class="col-4">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-title">
                                            <?= $d->gettxt(249) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-des">
                                            <?= $journey_data['data']['receiver_address']; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- tên dịch vụ -->
                                <div class="col-4">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-title">
                                            <?= $d->gettxt(250) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-des">
                                            <?= $journey_data['data']['service_name']; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- ngày khởi tạo -->
                                <div class="col-4">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-title">
                                            <?= $d->gettxt(251) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-des">
                                            <?= $journey_data['data']['create_date']; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- trạng thái -->
                                <div class="col-4">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-title">
                                            <?= $d->gettxt(252) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tc-info-box-subitem">
                                        <div class="tc-info-box-subitem-des">
                                            <?= $journey_data['data']['status_name']; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- item end -->
                    </div>
                </div>
                <!-- khung mã đơn hàng end -->

                <!-- lịch sử mã đơn hàng -->
                <div class="tc-info-box-content-journey">
                    <div class="tc-info-box-content-journey-title text-center mb-3">
                        <?= $d->gettxt(253) ?>
                    </div>
                    <div class="tc-info-box-content-journey-content">
                        <div class="row row-cols-1">

                            <?php
                            $list_journeys = $journey_data['data']['list_journeys'];
                            // php 7.4
                            /*
                            usort($list_journeys, function ($a, $b) {
                                $dateA = DateTime::createFromFormat('H:i d/m/Y', $a['create_date']);
                                $dateB = DateTime::createFromFormat('H:i d/m/Y', $b['create_date']);
                                return $dateB <=> $dateA;
                            }); */

                            // php 5.6
                            usort($list_journeys, function ($a, $b) {
                                $timestampA = strtotime($a['create_date']);
                                $timestampB = strtotime($b['create_date']);
                                return $timestampB - $timestampA;
                            });

                            foreach ($list_journeys as $key => $v) {
                            ?>
                                <!-- item start -->
                                <div class="col tc-info-box-content-journey-content-col">
                                    <div class="tc-info-box-content-journey-content-subitem">
                                        <div class="row g-0">
                                            <div class="col-4 col-lg-3">
                                                <div class="py-3 pe-3 tc-info-box-content-journey-content-item tc-info-box-content-journey-day">
                                                    <?= $v['create_date'] ?>
                                                </div>
                                            </div>
                                            <div class="col-8 col-lg-9">
                                                <div class=" px-3 ps-md-5 py-3 tc-info-box-content-journey-content-item d-flex flex-column">
                                                    <div class="tc-info-box-content-journey-content-item-title mb-1">
                                                        <?= $v['status_name'] ?>
                                                    </div>
                                                    <div class="tc-info-box-content-journey-content-item-des">
                                                        <?= $v['note'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- item end -->
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <!-- lịch sử mã đơn hàng end -->

            </div>
        </div>
        <!-- tra cứu info end -->

<?php   }
}
?>