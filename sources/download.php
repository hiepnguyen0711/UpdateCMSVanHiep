<div class="download-page">
    <div class="container">
        <div class="pnvn-tintuc-left">
            <div class="pnvn-tintuc-catalog">
                <div class="catalog-header">
                    Catalogs
                </div>
                <ul>
                    <li><a href="#">Technical support</a></li>
                    <li><a href="#">Viewss</a></li>
                    <li><a href="#">Review and Tessttttt</a></li>
                </ul>
            </div>
            <div class="pnvn-tintuc-contact">
                <div class="pnvn-tintuc-contact-header">
                    Đăng ký để nhận tin sớm nhất
                </div>
                <div class="pnvn-tintuc-contact-form-input">
                    <form id="contact-form" method="post" action="">
                        <input type="hidden" value="<?= $_SESSION['token'] ?>" name="_token" />
                        <div class="messages"></div>
                        <div class="controls">

                            <h5>Email</h5>
                            <div class="form-group">
                                <input class="email-input" id="form_email" type="email" name="email" placeholder="<?= $d->gettxt(31) ?>">
                            </div>
                            <h5>Lời nhắn</h5>
                            <div class="form-group">
                                <textarea id="form_message" name="noi_dung" class="form-control message-input" placeholder="<?= $d->gettxt(8) ?>" rows="4" required="required"></textarea>
                            </div>
                            <div class="d-flex align-items-center justify-content-between google-recaptcha-form">
                                <div class="g-recaptcha" data-sitekey="<?= _sitekey ?>"></div>
                                <div style="text-align: center;" class="btn-cergy-container">
                                    <button type="submit" name="lienhe" class="btn btn-danger btn-cergy"><span>Đăng ký <i class="fas fa-paper-plane"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="pnvn-download-right">
            <div class="pnvn-download-item">
                <img class="hvr-buzz-out" src="<?= URLPATH ?>img_data/images/cergy/pdf_download.png">
                <h3 class="catchuoi2">Đây là tiêu đề tập tin bạn muốn download</h3>
                <a href="#">
                    <div class="btn-download-item hvr-bounce-to-right">
                        <i class="fa-solid fa-cloud-arrow-down"></i> Tải xuống
                    </div>
                </a>
            </div>
            <div class="pnvn-download-item">
                <img class="hvr-buzz-out" src="<?= URLPATH ?>img_data/images/cergy/pdf_download.png">
                <h3 class="catchuoi2">Đây là tiêu đề tập tin bạn muốn download tin bạn muốn download tin bạn muốn download tin bạn muốn download</h3>
                <a href="#">
                    <div class="btn-download-item hvr-bounce-to-right">
                        <i class="fa-solid fa-cloud-arrow-down"></i> Tải xuống
                    </div>
                </a>
            </div>
            <div class="pnvn-download-item">
                <img class="hvr-buzz-out" src="<?= URLPATH ?>img_data/images/cergy/pdf_download.png">
                <h3 class="catchuoi2">Đây là tiêu đề tập tin bạn muốn download</h3>
                <a href="#">
                    <div class="btn-download-item hvr-bounce-to-right">
                        <i class="fa-solid fa-cloud-arrow-down"></i> Tải xuống
                    </div>
                </a>
            </div>
            <div class="pnvn-download-item">
                <img class="hvr-buzz-out" src="<?= URLPATH ?>img_data/images/cergy/pdf_download.png">
                <h3 class="catchuoi2">Đây là tiêu đề tập tin bạn muốn download</h3>
                <a href="#">
                    <div class="btn-download-item hvr-bounce-to-right">
                        <i class="fa-solid fa-cloud-arrow-down"></i> Tải xuống
                    </div>
                </a>
            </div>
            <!-- pagination -->
            <div class="pagination-page text-center">
                <ul id="pagination-ajax" class="pagination-sm"></ul>
            </div>
            <!-- pagination end -->
        </div>
    </div>
</div>



<script type="text/javascript" src="templates/js/jquery.twbsPagination.js"></script>
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