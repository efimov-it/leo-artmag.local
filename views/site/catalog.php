<?php

use app\components\CategoryCardWidget;

$this->title = Yii::t('app', 'Products catalog') . ' | ' . Yii::t('app', 'Leo-Art – products for creativity, study and work');
$this->params['breadcrumbs'][] = Yii::t('app', 'Products catalog');

?>

<h1 class="leo-h1 leo-h1__mb"><?=Yii::t('app', 'Products catalog')?></h1>

<?=CategoryCardWidget::widget([
    'view' => 'grid',
    'cache_key' => 'catalog_page_categories_block'
])?>