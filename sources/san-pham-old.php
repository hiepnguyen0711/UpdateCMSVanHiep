<?php
$id_loai = $row['id_code'] . $d->getIdsub($row['id_code']);
$total_records = $d->num_rows("select * from #_sanpham where id_loai in ($id_loai) and hien_thi =1 " . _where_lang . " order by so_thu_tu ASC, id DESC");
$limit = 8; //get_json('product', 'paging');
$total_page = ceil($total_records / $limit);
$sanpham = $d->o_fet("select * from #_sanpham where id_loai in ($id_loai) and hien_thi =1 " . _where_lang . " order by so_thu_tu ASC, id DESC limit 0,$limit ");
$id_product_cate = '113' . $d->getIdSub(113);
$category_product = "";
// dd($id_product_cate);
?>
<div class="pnvn-sanpham">
    <div class="container">
        <div class="pnvn-sanpham-left">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <a href="#">
                                <h3>Danh mục cha 1</h3>
                            </a>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="#">Danh mục 1</a></li>
                                <li><a href="#">Danh mục 2</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- danh muc 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <a href="#">
                                <h3>Danh mục cha 2</h3>
                            </a>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="#">Danh mục 1</a></li>
                                <li><a href="#">Danh mục 2</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="pnvn-sanpham-right">
            <div class="tatca-sanpham">
                <h5>Tất cả sản phẩm (100)</h5>
            </div>
            <div class="row" id="result">
                <?php foreach ($sanpham as $v) { ?>
                    <div class="pnvn-sanpham-item">
                        <?php include "module/sanpham-item.php"; ?>
                    </div>
                <?php } ?>
            </div>

            <?php if ($total_page > 1) { ?>
                <div class="pagination-page text-center">
                    <ul id="pagination-ajax" class="pagination-sm"></ul>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>





<script type="text/javascript" src="templates/js/jquery.twbsPagination.js"></script>
<?php if ($total_page > 1) { ?>
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