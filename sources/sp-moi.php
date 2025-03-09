<?php
$total_records = $d->num_rows("select * from #_sanpham where sp_moi = 1 and hien_thi =1 "._where_lang." order by so_thu_tu ASC, id DESC");
$limit = get_json('product', 'paging');
$total_page = ceil($total_records / $limit);
$sanpham = $d->o_fet("select * from #_sanpham where sp_moi = 1 and hien_thi =1 "._where_lang." order by so_thu_tu ASC, id DESC limit 0,$limit ");
?>

<div class=" container">
    <div class="row" id="result">
        <?=  Create_Product($sanpham,4,3,1) ?>
    </div>
    <?php if($total_page>1){ ?>
    <div class="pagination-page text-center">
        <ul id="pagination-ajax" class="pagination-sm"></ul>
    </div>
    <?php }?>
</div>
<script>
    var w = $('.item-product').width();
    $('.item-product .img img').height(w);
</script>
<script type="text/javascript" src="templates/js/jquery.twbsPagination.js"></script>
<?php if($total_page>0){ ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var chuyenmuc = '<?=$id_loai?>';
        $('#pagination-ajax').twbsPagination({
            totalPages: <?=$total_page?>,
            visiblePages: 5,
            prev: '<span aria-hidden="true">&laquo;</span>',
            next: '<span aria-hidden="true">&raquo;</span>',
            onPageClick: function (event, page) {
                $.ajax({
                    url: "sources/ajax/ajax-pagination.php",
                    type:'POST',
                    data: {page: page,totalPages:'<?=$total_page?>', chuyenmuc: chuyenmuc, limit: '<?=$limit?>', do: 'pagination_sanpham_moi'},
                    success: function(data){
                        $('#result').html(data);
                        var w = $('.item-product').width();
                        $('.item-product .img img').height(w);
                    }
                })
            }
        });
    });
</script>
<?php } ?>