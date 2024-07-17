<div class="leo-brandsView<?=$view === 'grid' ? ' leo-brandsView__grid' : ''?>">
<?php
use yii\helpers\Url;
foreach ($brands as $brand) {
?>
    <div class="leo-brandsView_card" title="<?=$brand -> name?>">
        <img src="/uploads/brands_images/<?=$brand -> id?>.svg" width="140" height="100" class="leo-brandsView_logo" alt="">
        <a href="<?=Url::home(true) . 'catalog/brands/' . $brand -> permalink?>" class="leo-brandsView_link" aria-label=""></a>
    </div>
<?php
}
?>
</div>