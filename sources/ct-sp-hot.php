<?php
if ( !$detect->isMobile() ) {
$sp_hot = $d->simple_fetch("select * from #_sanpham where hien_thi = 1 and sp_moi = 1 $where_lang ");
if(count($sp_hot)>0){
$quangcao_c = $d->getContent(80);
$hinh_anh_sp    =   $d -> o_fet("select * from #_sanpham_hinhanh where id_sp = ".$sp_hot['id_code']." ");

$thuoctinh_chinh = $d->o_fet("SELECT * FROM `db_sanpham_chitiet` WHERE id_sp = ".(int)$sp_hot['id_code']." and id_loai=0");
if(count($thuoctinh_chinh)>0){
    if($thuoctinh_chinh[0]['khuyen_mai']>0){
        $gia_ban = $thuoctinh_chinh[0]['khuyen_mai'];
        $gia_km = $thuoctinh_chinh[0]['gia'];
        $gia = numberformat($gia_ban).'đ <div class="gia_sale"><span>Giá cũ: <del>'.  number_format($gia_km).'đ</del></span> <span>-'.  check_ptram($gia_km, $gia_ban).'%</span></div>';
        $gia_chon = $gia_ban;
    }else{
        if($thuoctinh_chinh[0]['gia']>0){
            $gia_ban = $thuoctinh_chinh[0]['gia'];
            $gia_km=0;
            $gia = numberformat($gia_ban).'đ';
            $gia_chon = $gia_ban;
        }else{
            $gia_ban = 0;
            $gia = 'Liên hệ';
            $gia_chon = 0;
        }
    }
    $tex_gia ='';
    foreach ($thuoctinh_chinh as $key => $value) {
        if($value['khuyen_mai']>0){
            $gia_ban = $value['khuyen_mai'];
            $gia_km = $value['gia'];
            $gia = numberformat($gia_ban).'đ <div class="gia_sale"><span>Giá cũ: <del>'.  number_format($gia_km).'đ</del></span> <span class="sale">-'.  check_ptram($gia_km, $gia_ban).'%</span></div>';
        }else{
            if($row['gia']>0){
                $gia_ban = $value['gia'];
                $gia_km=0;
                $gia = numberformat($gia_ban).'đ';
                
            }else{
                $gia_ban = 0;
                $gia = 'Liên hệ';
            }
        }
        if($key>0){
            $an = 'style="display: none;"';
        }else{
            $an='';
        }
        $tex_gia .='<div class="gia_thuoctinh" '.$an.' id="giathuoctinh_'.$value['id'].'">'.$gia.'</div><input class="inputthuoctinh" id="inputthuoctinh_'.$value['id'].'"  type="hidden" value="'.$gia_ban.'" name="gia" />';
    }
}else{
    if($sp_hot['khuyen_mai']>0){
        $gia_ban = $sp_hot['khuyen_mai'];
        $gia_km = $sp_hot['gia'];
        $gia = numberformat($gia_ban).'đ <div class="gia_sale"><span>Giá cũ: <del>'.  number_format($gia_km).'đ</del></span></div> <span>-'.  check_ptram($gia_km, $gia_ban).'%</span>';
        $gia_chon = $gia_ban;
    }else{
        if($row['gia']>0){
            $gia_ban = $sp_hot['gia'];
            $gia_km=0;
            $gia = numberformat($gia_ban).'đ';
             $gia_chon = $gia_ban;
        }else{
            $gia_ban = 0;
            $gia = 'Liên hệ';
            $gia_chon = 0;
        }
    }
    $tex_gia .='<div class="gia_thuoctinh" id="giathuoctinh_0">'.$gia.'<input class="inputthuoctinh" id="inputthuoctinh_0" type="hidden" value="'.$gia_chon.'" name="gia" /></div>';
}
?>

<div class="chitiet_sp_hot" style="background-image: url('<?=  Img($quangcao_c['hinh_anh'])?>')">
    <div class=" container">
        <div class="row" style="margin-left: -15px;margin-right: -15px;">
            <div class="col-lg-9 col-md-12" style=" padding-left: 15px;padding-right: 15px;">
                <div class="row" style="margin-left: -15px;margin-right: -15px;">
                    <div class="col-sm-6" style=" padding-left: 15px;padding-right: 15px;">
                        <div class="swiper Swiper_sp_hot">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide ">
                                    <img src="<?=  Img($sp_hot['hinh_anh'])?>" class="Swiper_sp_hot_img" alt="<?=$sp_hot['ten']?>" />
                                </div>
                                <?php foreach ($hinh_anh_sp as $key => $value) {?>
                                <div class="swiper-slide">
                                     <img src="<?=  Img($value['hinh_anh'])?>" class="Swiper_sp_hot_img"  alt="<?=$sp_hot['ten']?>" />
                                </div>  
                                <?php } ?>
                            </div>
                            <!--div class="swiper-pagination"></div-->
                        </div>
                    </div>
                    <div class="col-sm-6" style=" padding-left: 15px;padding-right: 15px;">
                         <form method="POST" action="<?=URLPATH.$d->getCate(26,'alias')?>.html" id="form-cart" >
                            <input type="hidden" value="<?=$_SESSION['token']?>" name="_token" />
                            <input type="hidden" value="<?=$sp_hot['id_code']?>" name="id_sp" />
                            <div class="chitiet_sp_hot_title"><?=$sp_hot['ten']?></div>
                            <div class="chitiet_sp_hot_gia "><?=$tex_gia?></div>
                            <?php if(count($thuoctinh_chinh)>0){ ?>
                            <div class="d-flex thuoctinh-sp">
                                <div class="title">Chọn thông số: </div>
                                
                                <div class="list-tt">
                                    <?php foreach ($thuoctinh_chinh as $key2 => $value2) {?>
                                    <label class="item-thuoctinh" onclick="get_gia(<?=$value2['id']?>)">
                                        <input  <?=$key2==0?'checked':'' ?> type="radio" name="thuoctinh" value="<?=$value2['id']?>" />
                                        <?php if($value2['ma_ta']!=''){ ?>
                                        <span class="lab_color" style="background-color: <?=$value2['ma_ta']?>"><?=$value2['ten']?></span>
                                        <?php }elseif($value2['hinh_anh']!=''){ ?>
                                        <span class="lab_img" style=" background-image: url('img_data/images/<?=$value2['hinh_anh']?>')"><?=$value2['ten']?></span>
                                        <?php }else{ ?>
                                        <span><?=$value2['ten']?></span>
                                        <?php } ?>
                                    </label>                       
                                    <?php } ?>
                                </div>
                            </div> 
                            <script>
                                function get_gia(id){
                                    $('.gia_thuoctinh').hide();
                                    $('#giathuoctinh_'+id).show();
                                    $('.inputthuoctinh').attr('disabled','disabled');
                                    $('#inputthuoctinh_'+id).removeAttr('disabled');
                                }
                            </script>
                            <?php } ?>
                            <?php  if($sp_hot['mo_ta']!=''){ ?>
                            <div class="chitiet_sp_hot_mota">
                                <?=$sp_hot['mo_ta']?>
                            </div>
                            <?php } ?>
                            <?php 
                                $strjson = $sp_hot['thong_so_kt'];
                                if ($strjson != '[]' and $strjson != '') {
                                    $strjson = json_decode($strjson, true);
                                    $addinfor="";
                                    foreach ($strjson as $items2) {
                                        $item = explode('%%%', $items2);
                                        $addinfor .= "<li>".$item[0].": ".$item[1]."</li>";
                                    }
                                } else {
                                    $addinfor = '';
                                }
                            ?>
                            <?php if($addinfor!=''){ ?>
                            <ul class="chitiet_sp_hot_thongso">
                                <?=$addinfor?>
                            </ul>
                            <?php } ?>
                            <div class="chitiet_sp_hot_tuvan_form ">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nhập số điện thoại tư vấn nhanh miễn phí" aria-label="Nhập số điện thoại tư vấn miễn phí" aria-describedby="button-addon2">
                                    <button class="btn " type="button" id="button-addon2">Gửi</button>
                                </div>
                            </div>
                            <div class="cart-option mb-15 d-flex justify-content-between" id="html_dathang">
                                <div class="product-quantity mr-20" style="display: flex;">
                                    <div class="cart-plus-minus p-relative">
                                        <input type="text" value="1" name="so_luong" id="soluong" data_0="10" >
                                        <div class="dec qtybutton">-</div>
                                        <div class="inc qtybutton">+</div>
                                    </div>
                                </div>
                                <button class="cart-btn" type="button" onclick="add_to_cart(0)"><?=$d->getTxt(78)?></button>
                                <button class="cart-btn cart-btn2" type="button" onclick="add_to_cart(1)"><?=$d->getTxt(77)?></button>
                            </div>
                         </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3 sm-none xs-none" style=" padding-left: 15px;padding-right: 15px;">
                <div class="swiper Swiper_sp_hot">
                    <div class="swiper-wrapper">
                        <?php foreach ($d->getContents(80) as $key => $value) {?>
                        <div class="swiper-slide">
                            <a <?=cf_tag_a($value['link'], $value['nofollow'], $value['target'])?> title="<?=$value['ten']?>">
                                <img src="<?=  Img($value['hinh_anh'])?>" class="Swiper_quangcao_img"  alt="<?=$value['ten']?>" />
                            </a>
                        </div>  
                        <?php } ?>
                    </div>
                    <!--div class="swiper-pagination"></div-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var w_slider = $('.Swiper_sp_hot').width();
    $('.Swiper_sp_hot_img').height(w_slider);
    $('.Swiper_quangcao_img').height(w_slider);
</script>

<script>
    function add_to_cart(type){
        $.ajax({
            method: $('#form-cart').attr('method'),
            url: '<?=URLPATH?>sources/ajax/ajax_cart.php',
            data: $('#form-cart').serialize(),
            // other AJAX settings goes here
            // ..
        }).done(function(response) {
            if(response==='0'){
                if(type===0){
                    swal({
                        title: '',
                        text: 'Đã thêm vào giỏ hàng',
                        icon: 'success',
                        button: false,
                        timer: 2000
                    }).then((value) => {
                        window.location="<?=URLPATH.$com?>.html";
                    }); 
                }else{
                     window.location="<?=URLPATH.$d->getCate(26,'alias')?>.html";
                }
            }
            
        });
        event.preventDefault(); // <- avoid reloading
   }
</script>
<?php }}?>