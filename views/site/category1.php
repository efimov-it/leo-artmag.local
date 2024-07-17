<?php
use app\components\BrandCardWidget;
use app\components\CardsSliderWidget;
use app\components\CategoryCardWidget;
use app\components\GoodCardWidget;
use yii\helpers\Url;

$this->title = $category -> title . ' | ' . Yii::t('app', 'Leo-Art – products for creativity, study and work');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Products catalog'),
    'url'   => Url::home(true).'catalog'
];
$this->params['breadcrumbs'][] = $category -> title;

?>

<h1 class="leo-hidden"><?=$category -> title?></h1>

<?=CardsSliderWidget::widget([
    'title' => $category -> title,
    'hideControls' => count($child_categories) < 5,
    'content' => CategoryCardWidget::widget([
        'view' => 'row',
        'data' => $child_categories,
        'parent' => $category
    ])
])?>

<?php
if (count($goods_ids) > 0) {
?>
<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'Popular products'),
    'hideControls' => count($goods_ids) < 5,
    'small_title' => true,
    'content' => GoodCardWidget::widget([
        'view' => 'row',
        'ids' => array_slice($goods_ids, 0, 12),
        'cache_key' => 'category1_page_popular_products_block_' . $category -> id
    ])
])?>
<?php
}
?>

<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'Popular brands'),
    'hideControls' => count($brands) < 5,
    'small_title' => true,
    'content' => BrandCardWidget::widget([
        'view' => 'row',
        'data' => $brands
    ])
])?>

<?php
if (count($goods_ids) > 15) {
?>
<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'You might like it'),
    'small_title' => true,
    'hideControls' => true,
    'content' => GoodCardWidget::widget([
        'view' => 'grid',
        'ids' => array_slice($goods_ids, 12),
        'cache_key' => 'category1_page_products_block_' . $category -> id
    ])
])?>
<?php
}
?>