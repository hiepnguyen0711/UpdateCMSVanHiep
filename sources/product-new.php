<?php
// Lấy danh sách sản phẩm mới
$product_new = $d->o_fet("select * from #_sanpham where hien_thi = 1 " . _where_lang . " order by ngay_dang desc, cap_nhat desc ");

$id_loai = '150' . $d->findIdSub(150);
$total_records = $d->num_rows("select * from #_sanpham where hien_thi = 1 " . _where_lang . " order by ngay_dang DESC, cap_nhat desc");
$limit = 16; //get_json('product', 'paging');
$total_page = ceil($total_records / $limit);


?>

<section class="product-new">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-0" id="result">
        <?php
        foreach ($product_new as $key => $v) {
        ?>
            <!-- Item start -->
            <div class="col">
                <?php include 'module/ak-product-item.php'; ?>
            </div>
            <!-- Item end -->
        <?php } ?>
    </div>

    <!-- Pagination -->
    <div class="pagination-page text-center">
        <ul id="pagination-ajax-new" class="pagination-sm"></ul>
    </div>
    <!-- Pagination End -->

</section>




<script type="text/javascript" src="templates/js/jquery.twbsPagination.js"></script>
<?php if ($total_page > 0) { ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var chuyenmuc = '<?= $id_loai ?>';
            $('#pagination-ajax-new').twbsPagination({
                totalPages: <?= $total_page ?>,
                visiblePages: 5,
                prev: '<span aria-hidden="true">&laquo;</span>',
                next: '<span aria-hidden="true">&raquo;</span>',
                onPageClick: function(event, page) {
                    $.ajax({
                        url: "sources/ajax/ajax-pagination.php",
                        type: 'POST',
                        data: {
                            page: page,
                            totalPages: '<?= $total_page ?>',
                            chuyenmuc: chuyenmuc,
                            limit: '<?= $limit ?>',
                            do: 'pagination_sanpham_new'
                        },
                        success: function(data) {
                            //console.log(data);
                            $('#result').html(data);
                        }
                    })
                }
            });
        });
    </script>
<?php } ?>