<?php
if ($category['id_code']) {
    $id = $category['id_code'];
} else {
    $id = $row['id_code'];
}

?>

<?php if ($id) { ?>
    <div class="sodotrang">
        <div class="container">
            <?= $d->breadcrumblist($id) ?>
        </div>
    </div>

<?php } else { ?>
    <div class="sodotrang">
        <div class="container">
            <ol vocab="https://schema.org/" typeof="BreadcrumbList" class="breadcrumb">
                <li property="itemListElement" typeof="ListItem" class="breadcrumb-item">
                    <a property="item" typeof="WebPage" href="' . URLLANG . '">
                        <span property="name"><?= $d->getTxt(11) ?></span></a>
                    <meta property="position" content="1">
                </li>
                <li property="itemListElement" typeof="ListItem" class="breadcrumb-item ' . $act . '">
                    <a property="item" typeof="WebPage" href="' . URLLANG . $row['alias'] . '.html">
                        <span property="name"><?= $title ?></span></a>
                    <meta property="position" content="' . $j . '">
                </li>
            </ol>
        </div>
    </div>

<?php } ?>