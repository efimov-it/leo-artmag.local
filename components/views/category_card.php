<?php

use yii\helpers\Url;

?>
<div class="leo-categoriesView<?=$view === 'grid' ? ' leo-categoriesView__grid' : ''?>">
    <?php
    foreach ($categories as $category) {
        $image = '/assets/images/no_category_image.svg';
        // var_dump(__DIR__.'/../../web/uploads/catalog_images/' . $category -> refs_id . '.png');die();
        if (file_exists(__DIR__.'/../../web/uploads/catalog_images/' . $category -> refs_id . '.png')) {
            $image = "/uploads/catalog_images/" . $category -> refs_id . ".png";
        }
    ?>
    <div class="leo-categoriesView_card">
        <img src="<?=$image?>" width="160" height="140" class="leo-categoriesView_img" alt="">
        <a href="<?=Url::home(true) . 'catalog/' . ($parent ? $parent -> permalink . '/' : '') . $category -> permalink?>" class="leo-categoriesView_title"><?=$category -> title?></a>
    </div>
    <?php
    }
    ?>
</div>