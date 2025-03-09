<!-- breadcrumb start -->
<?php include 'module/sca-breadcrumb.php'; ?>
<!-- breadcrumb end -->

<section class="sca-polyci-section">
    <div class="container">
        <div class="sca-polyci-section-content">
            <!-- title start -->
            <div class="sca-polyci-section-content-title mb-3">
                <?= $row['ten'] ?>
            </div>
            <!-- title end -->
            <?php
            if (!empty($row['mo_ta'])) {
            ?>
                <!-- description start -->
                <div class="sca-polyci-section-content-title-des mb-3">
                    <?= $row['mo_ta'] ?>
                </div>
                <!-- description end -->
            <?php  } ?>

            <!-- content start -->
            <div class="sca-polyci-section-content-title-content">
                <?= $row['noi_dung'] ?>
            </div>
            <!-- content end -->
        </div>
    </div>
</section>