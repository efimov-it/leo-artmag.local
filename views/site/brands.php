<?php
use app\components\BrandCardWidget;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Our brands') . ' | ' . Yii::t('app', 'Leo-Art – products for creativity, study and work');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Products catalog'),
    'url'   => Url::home(true).'catalog'
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Our brands');

?>

<h1 class="leo-h1 leo-h1__mb"><?=Yii::t('app', 'Our brands')?></h1>

<?=BrandCardWidget::widget([
    'cache_key' => 'brands_page_block'
])?>