<?php
$id_loai = $row['id_code'] . $d->getIdsub($row['id_code']);
$sale = 0;
if ($row['id_code'] == 194) {
    $id_loai = '150' . $d->getIdSub(150);
    $sale = 1;
}
$total_records = $d->num_rows("select * from #_sanpham where id_loai in ($id_loai) and hien_thi =1 " . _where_lang . " order by so_thu_tu ASC, id DESC");
$limit = 12; //get_json('product', 'paging');
$total_page = ceil($total_records / $limit);
$sanpham = $d->o_fet("select * from #_sanpham where id_loai in ($id_loai) and hien_thi =1 " . _where_lang . " order by so_thu_tu ASC, id DESC limit 0,$limit ");
$id_product_cate = '113' . $d->getIdSub(113);
$category_product = "";
// dd($id_product_cate);

// dd($row);

// Lấy nội dung sản phẩm

?>
<!-- breadcrumb start  -->
<?php include 'module/bee-breadcrumb.php'; ?>
<!-- breadcrumb end -->

<!-- Banner start -->
<?php
$banner = "";
if (!empty($row['hinh_anh'])) {
    $banner = $row['hinh_anh'];
} else {
    $banner_id = $d->getContent(798);
    $banner = $banner_id['hinh_anh'];
}
?>
<section class="bee-about-us-banner" style="background-image: url('<?= Img($banner) ?>');">
    <h1><?= $row['ten']; ?></h1>
</section>
<!-- Banner end -->

<div class="zc-product-page bee-product-page">
    <div class="container">

        <!-- Content -->
        <div class="zc-product-page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 gx-5 gy-4" id="result">

            </div>
        </div>
        <!-- Pagination -->
        <div class="pagination-page text-center">
            <ul id="pagination-ajax" class="pagination-sm"></ul>
        </div>
        <!-- Pagination End -->
    </div>
</div>

<!-- Tin tức start -->
<?php
include 'module/index/bee-news.php';
?>
<!-- Tin tức end -->





<script type="text/javascript" src="templates/js/jquery.twbsPagination.js"></script>
<?php if ($total_page > -1) { ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var chuyenmuc = '<?= $id_loai ?>';
            $('#pagination-ajax').twbsPagination({
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
                            sale: <?= $sale ?>,
                            do: 'pagination_sanpham'
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