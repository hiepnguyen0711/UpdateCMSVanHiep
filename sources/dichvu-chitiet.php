<!-- breadcrumb start -->
<?php include 'module/sca-breadcrumb.php'; ?>
<!-- breadcrumb end -->
<!-- banner start -->
<?php include 'module/sca-banner.php'; ?>
<!-- banner end -->

<section class="sca-service-detail-section">
    <div class="container">
        <div class="sca-service-detail-section-content">
            <!-- title start -->
        <div class="sca-service-detail-section-content-title mb-3 mb-lg-4">
            <?= $d->gettxt(235). " ". $row['ten'] ?>
        </div>
            <!-- title end -->
            <?= $row['noi_dung'] ?>
        </div>
    </div>
</section>