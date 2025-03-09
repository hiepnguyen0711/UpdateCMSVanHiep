<?php
$nav  = $d->o_fet("select * from #_category where id_loai = 123 and hien_thi= 1 " . _where_lang . " order by so_thu_tu asc, id asc");
$menu = "";
// dd($nav);

foreach ($nav as $v) {
    $menu .= '<li>
                        <a href="' . URLLANG . $v['alias'] . '.html" title="' . $v['ten'] . '">' . $v['ten'] . ' <span class="caret"></span></a>
                       
                    </li>';
}
echo $menu;
