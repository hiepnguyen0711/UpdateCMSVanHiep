<?php
// session_start();
$ti_gia_usd = $_SESSION['ti_gia_usd'];
$thanhcong_c = $d->getCate(160);
if (isset($_POST['dathang'])) {
    $ma_dh = 'DH-' . chuoird(5);
    token();
    $data['ma_dh']              =   $ma_dh;
    $data['ho_ten']             =   addslashes($_POST['ho_ten']);
    $data['dien_thoai']         =   addslashes($_POST['dien_thoai']);
    $data['email']              =   addslashes($_SESSION['nhahang']['email']);
    //$data['so_nha']             =   addslashes($_POST['dia_chi']);
    //$data['phuong']             =   addslashes($_POST['code_xa']);
    $data['quan']               =   addslashes($_POST['code_huyen']);
    $data['thanh_pho']          =   addslashes($_POST['code_tinh']);
    $data['dia_chi']            =   addslashes($_POST['dia_chi']) . ', ' . $d->getHuyen($_POST['code_tinh'], 'ten', $_POST['code_huyen'])['ten'] . ', ' . $d->getTinh('ten', $_POST['code_tinh'])['ten'];
    $data['loi_nhan']           =   addslashes($_POST['ghi_chu']);
    $data['thanh_toan']         =   addslashes($_POST['phuongthucthanhtoan']);
    //$data['phi_vanchuyen']      =   $_SESSION['nhahang']['phi_ship'];
    //$data['ma_giamgia']         =   $_SESSION['nhahang']['ma_sale'];
    //$data['so_tien_giam']       =   $_SESSION['nhahang']['phi_sale'];
    $data['ngay_dathang']       =   date('Y-m-d', time());
    $data['tinhtrang_donhang']  =   1;
    $d->reset();
    $d->setTable('#_dathang');
    if ($id_dh = $d->insert($data)) {
        $_SESSION['ma_dh'] =  $ma_dh;
        foreach ($_SESSION['cart'] as $key => $value) {
            $row_sp = $d->simple_fetch("select * from #_sanpham where id_code = '" . $value['productid'] . "' $where_lang");
            if ($row_sp['khuyen_mai']) {
                $gia = $row_sp['khuyen_mai'];
            } else {
                $gia = $row_sp['gia'];
            }
            $tong = $tong + ($gia * $row_sp['soluong']);
            $data_ct['id_dh']       = $id_dh;
            $data_ct['ma_dh']       = $ma_dh;
            $data_ct['ten_sp']      = $row_sp['ten'];
            $data_ct['gia_ban']     = $gia;
            $data_ct['so_luong']    = $value['soluong'];
            $data_ct['id_sp']       = $row_sp['id_code'];
            $data_ct['hinh_sp']     = $row_sp['hinh_anh'];
            // Màu sắc và kích thước
            // $data_ct['color']     = $value['mau'];
            $data_ct['size']     = $value['size'];


            $d->reset();
            $d->setTable('#_dathang_chitiet');
            $d->insert($data_ct);
        }
        unset($_SESSION['cart']);
        unset($_SESSION['nhahang']);
        $thongbao_tt        =   $d->gettxt(173);
        $thongbao_icon      =   'success';
        $thongbao_content   =   '';
        $thongbao_url = URLLANG . $thanhcong_c['alias'] . '.html?success=' . $ma_dh;
    }
}
$link = explode("?", $_SERVER['REQUEST_URI']);
if ($link[1] != '') {
    $vari = explode("&", $link[1]);
    $search = array();
    foreach ($vari as $item) {
        $str = explode("=", $item);
        $search["$str[0]"] = $str[1];
    }
}
if (isset($search['delete'])) {
    unset($_SESSION['cart'][$search['delete']]);
    if (count($_SESSION['cart']) == 0) {
        unset($_SESSION['cart']);
    } else {
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    $d->redirect(URLLANG . $com . ".html");
}

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $soluongsp = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $soluongsp = $soluongsp + $value['soluong'];
    }
}

// dd($_SESSION['cart']);
// session_destroy();

?>
<div class="shop-area mb-20 ak-cart-page">
    <div class="container py-5">
        <?php if (isset($_SESSION['cart'])) { ?>
            <div class="row gx-5 gy-4" data-select2-id="19">
                <div class="col-lg-8" data-select2-id="18">
                    <h1 class="heading-2 mb-10"><?= $d->getTxt(96) ?></h1>
                    <div class="d-flex justify-content-between mb-4">
                        <h6 class="text-body"><?= $d->gettxt(171) ?> <span class="text-brand soluong_cart"><?= $soluongsp ?></span> <?= $d->gettxt(172) ?></h6>
                        <!--h6 class="text-body"><a href="javascript:void(0)" class="text-muted"><i class="far fa-trash-alt"></i> <?= $d->getTxt(97) ?></a></h6-->
                    </div>
                    <form method="POST" action="">
                        <div class="table-responsive shopping-summery">
                            <table class="table table-wishlist">
                                <thead>
                                    <tr class="main-heading">
                                        <!--th class="custome-checkbox start pl-30">
                                            STT
                                        </th-->
                                        <th class="custome-checkbox start pl-30" scope="col"><?= $d->getTxt(98) ?></th>
                                        <th scope="col"><?= $d->getTxt(163) ?></th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col"><?= $d->getTxt(38) ?></th>
                                        <th scope="col"><?= $d->getTxt(39) ?></th>
                                        <th scope="col"><?= $d->getTxt(40) ?></th>
                                        <th scope="col" style="width: 80px;text-align: center;" class="end"><?= $d->getTxt(121) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tong = 0;
                                    $i = 1;
                                    //dd($_SESSION['cart']);
                                    foreach ($_SESSION['cart'] as $key => $value) {
                                        $product = $d->simple_fetch("select * from #_sanpham where id_code=" . $value['productid'] . " $where_lang ");
                                        if (!empty($product)) {
                                            if ($product['khuyen_mai']) {
                                                $gia = $product['khuyen_mai'];
                                            } else {
                                                $gia = $product['gia'];
                                            }
                                            $tong = $tong + ($gia * $value['soluong']);
                                    ?>
                                            <tr class="pt-30" data-code="<?= $value['code'] ?>" data-pid="<?= $product['id_code'] ?>">
                                                <!--td class="custome-checkbox pl-30">
                                            <?= $i ?>
                                        </td-->
                                                <td class="image product-thumbnail pt-40">
                                                    <img class="anh-gio-hang" src="<?= Img($product['hinh_anh']) ?>" alt="<?= $product['ten'] ?>">
                                                </td>

                                                <td style="text-transform: uppercase;">
                                                    <?php
                                                    // Lấy kích thước
                                                    if (empty($value['size'])) {
                                                        echo $size['ten'] = "Bạn chưa chọn size";
                                                    } else {
                                                        $size = $d->simple_fetch("select ten from #_sanpham_chitiet where id = {$value['size']}");
                                                        if (!empty($size)) {
                                                            echo $size['ten'];
                                                        } else {
                                                            echo $d->gettxt(164);
                                                        }
                                                    }

                                                    ?>

                                                </td>
                                                <td class="product-des product-name" style="min-width: 150px;vertical-align: middle;text-align: left;">
                                                    <h6><a class="product-name mb-10 text-heading" href="<?= URLLANG . $product['alias'] ?>.html"><?= $product['ten'] ?></a></h6>

                                                </td>
                                                <td class="price" data-title="Price">
                                                    <!-- Giá mỹ giá việt Start -->
                                                    <?php
                                                    if ($row['lang'] == 'us') { ?>
                                                        <!-- Giá mỹ -->
                                                        $ <?= number_format($gia) ?>
                                                    <?php } else { ?>
                                                        <!-- Giá việt -->
                                                        <?= number_format($gia) ?> vnđ
                                                    <?php } ?>
                                                    <!-- Giá mỹ giá việt End -->
                                                </td>
                                                <td class="text-center detail-info" data-title="Stock" style="vertical-align: middle;">
                                                    <input type="hidden" name="key_cart[]" value="<?= $key ?>" />
                                                    <div class="detail-extralink mr-15">
                                                        <div class="detail-qty border radius">
                                                            <span class="qty-button qty-down">
                                                                <i class="fa-solid fa-minus"></i>
                                                            </span>
                                                            <input type="text" class="num_sl" data-pid="<?= $value['productid'] ?>" data-code="<?= $value['code'] ?>" value="<?= $value['soluong'] ?>" />
                                                            <span class="qty-button qty-up">
                                                                <i class="fa-solid fa-plus"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="price load-price-<?= $value['code'] ?>  " data-title="Price">
                                                    <!-- Giá mỹ giá việt Start -->
                                                    <?php
                                                    if ($row['lang'] == 'us') { ?>
                                                        <!-- Giá mỹ -->
                                                        $ <?= number_format($gia * $value['soluong']) ?>
                                                    <?php } else { ?>
                                                        <!-- Giá việt -->
                                                        <?= number_format($gia * $value['soluong']) ?> vnđ
                                                    <?php } ?>
                                                    <!-- Giá mỹ giá việt End -->
                                                </td>
                                                <td class="action text-center ak-btn-delete" data-title="Remove"><a style="color: red;" href="<?= URLLANG . $com ?>.html?delete=<?= $key ?>">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        } ?>
                                    <?php } ?>
                                    <tr>
                                        <td class="price" colspan="4" data-title="Price" style="text-align: right;font-weight: 700;font-size: 16px;">
                                            <?= $d->getTxt(130) ?>:
                                        </td>
                                        <td class="price tongtien" colspan="2" data-title="Price" style="color: #bf2323; text-align: right;font-weight: 700;font-size: 1.5rem;">
                                            <!-- Giá mỹ giá việt Start -->
                                            <?php
                                            if ($row['lang'] == 'us') { ?>
                                                <!-- Giá mỹ -->
                                                $ <?= number_format($tong) ?>
                                            <?php } else { ?>
                                                <!-- Giá việt -->
                                                <?= number_format($tong) ?> vnđ
                                            <?php } ?>
                                            <!-- Giá mỹ giá việt End -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <?php $phuongthucthanhtoan = $d->getContents(113); ?>
                    <div class="phuongthuc_thanhtoan">
                        <div class="row">
                            <?php foreach ($phuongthucthanhtoan as $key => $value) { ?>
                                <div class="col">
                                    <button class="btn btn-thanhtoan <?= $key == 0 ? 'active' : '' ?>" data="<?= $value['id_code'] ?>"><?= $value['ten'] ?></button>
                                </div>
                            <?php } ?>
                        </div>
                        <?php foreach ($phuongthucthanhtoan as $key => $value) { ?>
                            <div class="thanhtoan_content thanhtoan_content_<?= $value['id_code'] ?>" <?php if ($key > 0) { ?>style=" display: none" <?php } ?>>
                                <?= $value['noi_dung'] ?>
                            </div>
                        <?php } ?>
                    </div>
                    <script>
                        $('.btn-thanhtoan').click(function() {
                            var data = $(this).attr('data');
                            $('.thanhtoan_content').hide();
                            $('.thanhtoan_content_' + data).show();
                            $('.btn-thanhtoan').removeClass('active');
                            $(this).addClass('active');
                            $('#txt_phuongthucthanhtoan').attr('value', $(this).html());
                        })
                    </script>

                </div>
                <div class="col-lg-4">
                    <h1 class="heading-2 mb-4 mt-5"><?= $d->gettxt(28) ?></h1>
                    <form method="POST" action="" class="form-dathang">
                        <div class=" form-group mb-3">
                            <label><?= $d->gettxt(5) ?></label>
                            <input type="text" required placeholder="<?= $d->gettxt(29) ?>" value="<?= $user_login['ho_ten'] ?>" name="ho_ten" class="form-control" />
                        </div>
                        <div class=" form-group mb-3">
                            <label><?= $d->gettxt(6) ?></label>
                            <input type="text" required placeholder="<?= $d->gettxt(30) ?>" value="<?= $user_login['dien_thoai'] ?>" name="dien_thoai" class="form-control" />
                        </div>
                        <!--div class=" form-group">
                            <label>Email</label>
                            <input type="text" placeholder="Nhập email" value="<?= $user_login['email'] ?>" name="email" class="form-control" />
                        </div-->

                        <div class="form-group mb-3">
                            <label><?= $d->gettxt(7) ?></label>
                            <input type="text" required placeholder="<?= $d->gettxt(32) ?>" name="dia_chi" class="form-control" />
                        </div>
                        <input type="hidden" name="phuongthucthanhtoan" id="txt_phuongthucthanhtoan" value="<?= $phuongthucthanhtoan[0]['ten'] ?>" />
                        <div class="form-group mb-3">
                            <label><?= $d->gettxt(33) ?></label>
                            <textarea class=" form-control" rows="3" placeholder="<?= $d->gettxt(33) ?>" name="ghi_chu"></textarea>
                        </div>
                        <div class="text-center vs-btn-dathang">
                            <button class="btn btn-dathang" name="dathang"><?= $d->gettxt(26) ?></button>
                        </div>
                    </form>

                </div>
            </div>
        <?php } else { ?>
            <div class="well text-center py-5" style="font-size: 18px;">
                <p><?= $d->gettxt(42) ?></p>
                <a href="<?= URLLANG ?>"><?= $d->gettxt(43) ?></a>
            </div>
        <?php } ?>
    </div>
</div>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

<script>
    <?php if (isset($_SESSION['cart'])) { ?>
        <?php if (!$_SESSION['nhahang']['ma_sale']) { ?>

            function check_sale() {
                var ma_sale = $('#ma_sale').val();
                $.ajax({
                    url: "sources/ajax/ajax.php",
                    type: "post",
                    dataType: "text",
                    data: {
                        do: 'check_sale',
                        ma_sale: ma_sale,
                        tong_dong: <?= $tong ?>,
                        phi_ship: $('#phi_ship').val()
                    },
                    success: function(result) {
                        if (result === '0') {
                            window.location.href = "<?= URLPATH . $com ?>.html";
                        } else {
                            swal({
                                title: '',
                                text: 'Mã khuyến mãi không hợp lệ',
                                icon: 'error',
                                button: false,
                                timer: 2000
                            });
                        }
                    }
                });
            }
        <?php } ?>

        $(document).ready(function() {
            $("#form-diachi").validate({
                rules: {
                    ho_ten: "required",
                    dien_thoai: "required",
                    email: {
                        email: true
                    },
                    id_countries: "required",
                    id_states: "required",
                    id_cities: "required",
                    dia_chi: "required"
                },
                messages: {
                    ho_ten: "Vui lòng nhập họ tên",
                    dien_thoai: "Vui lòng nhập số diện thoại",
                    email: {
                        email: "Vui lòng nhập đúng định dạng mail"
                    },
                    id_countries: "Vui lòng chọn quốc gia",
                    id_states: "Vui lòng chọn tỉnh / thành phố",
                    id_cities: "Vui lòng chọn quận / huyện",
                    dia_chi: "Vui lòng nhập dịa chỉ"
                }
            });
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#form-shopping").validate({
                rules: {
                    ten: "required",
                    email: {
                        email: true
                    },
                    dienthoai: "required",
                    diachi: "required"
                },
                messages: {
                    ten: "<?= $d->gettxt(44) ?>",
                    email: {
                        email: "<?= $d->gettxt(45) ?>"
                    },
                    dienthoai: "<?= $d->gettxt(46) ?>",
                    diachi: "<?= $d->gettxt(47) ?>",
                }
            });

        });
    <?php } ?>
</script>