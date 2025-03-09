 <!-- Popup danh mục cấp 3 start -->
 <div class="ft-popup-level-3">
     <div class="card">
         <div class="card__content">
             <?php
                foreach ($cate_level_3 as $keyss => $p) {
                ?>
                 <!-- item start -->
                 <div class="ft-popup-item">
                     <span class="hvr-forward"><?= $p['ten'] ?></span>
                 </div>
                 <!-- item end -->
             <?php } ?>
         </div>
     </div>
 </div>
 <!-- Popup danh mục cấp 3 end -->