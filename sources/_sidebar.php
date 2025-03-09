<?php
$tintuc_home = $d->o_fet("select * from #_tintuc where noi_bat = 1 and hien_thi =1 "._where_lang." order by so_thu_tu ASC, id DESC limit 0,5");
?>
<div class="col-xl-4 col-lg-5">
    <div class="news-sidebar pl-10">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="widget">
                    <h6 class="sidebar-title"> <?=$d->getTxt(119)?></h6>
                    <div class="n-sidebar-search">
                        <input type="text" placeholder="<?=$d->getTxt(57)?>...">
                        <button href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="widget">
                    <h6 class="sidebar-title"><?=$d->getTxt(120)?></h6>
                    <div class="n-sidebar-feed">
                        <ul>
                            <?php foreach ($tintuc_home as $key => $value) {?>
                            <li>
                                <div class="feed-number">
                                    <a style="display: block;width: 100px;" href="<?=URLPATH.$value['alias']?>.html"><img src="img_data/images/<?=$value['hinh_anh']?>" alt=""></a>
                                </div>
                                <div class="feed-content">
                                    <h6><a href="<?=URLPATH.$value['alias']?>.html" title="<?=$value['ten']?>"><?=$value['ten']?></a></h6>
                                    <span class="feed-date">
                                    <i class="fal fa-calendar-alt"></i> <?=date('d M, Y', $value['ngay_dang']) ?>
                                    </span>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!--div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h6 class="sidebar-title">Categories</h6>
                    <ul class="n-sidebar-categories">
                        <li>
                            <a href="blog-details.html">
                                <div class="single-category p-relative mb-10">
                                    Business
                                    <span class="category-number">26</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="blog-details.html">
                                <div class="single-category p-relative mb-10">
                                    consultant
                                    <span class="category-number">30</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="blog-details.html">
                                <div class="single-category p-relative mb-10">
                                    Creative
                                    <span class="category-number">71</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="blog-details.html">
                                <div class="single-category p-relative mb-10">
                                    UI/UX
                                    <span class="category-number">56</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="blog-details.html">
                                <div class="single-category p-relative">
                                    Texhnology
                                    <span class="category-number">60</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h6 class="sidebar-title">Instagram Feeds</h6>
                    <div class="dktags">
                        <a class="single-tag" href="#">Popular</a>
                        <a class="single-tag" href="#">Design</a>
                        <a class="single-tag" href="#">Usability</a>
                        <a class="single-tag" href="#">Icon</a>
                        <a class="single-tag" href="#">Kit</a>
                        <a class="single-tag" href="#">Business</a>
                        <a class="single-tag" href="#">Keypad</a>
                        <a class="single-tag" href="#">Tech</a>
                    </div>
                </div>
            </div-->
        </div>
    </div>
</div>