<?php
use app\components\BrandCardWidget;
use app\components\CardsSliderWidget;
use app\components\CategoryCardWidget;
use app\components\GoodCardWidget;
use app\components\MainPageBanner;

$this->title = 'Лео-Арт – Товары для творчества, учёбы и работы';
?>

<?=MainPageBanner::widget([])?>

<section class="leo-main_section">
    <h2 class="leo-hidden"><?=Yii::t('app', 'Popular categories')?></h2>
    <?=CategoryCardWidget::widget([
        'limit' => 4,
        'view' => 'row',
        'random' => true,
        'cache_key' => 'main_page_popular_categories_block'
    ])?>
</section>

<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'New items in Leo Art'),
    'content' => GoodCardWidget::widget([
        'ids'       => $newProductsIds,
        'cache_key' => 'main_page_new_products_goods_block'
    ])
])?>

<?='';CardsSliderWidget::widget([
    'title' => Yii::t('app', 'Discounted products'),
    'content' => GoodCardWidget::widget([
        'ids' => $discountProductsIds,
        'cache_key' => 'main_page_discount_products_goods_block'
    ])
])?>

<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'Our brands'),
    'content' => BrandCardWidget::widget([
        'limit' => 12,
        'random' => true,
        'view' => 'row',
        'cache_key' => 'main_page_brands_block'
    ])
])?>

<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'Everything for creativity'),
    'content' => GoodCardWidget::widget([
        'ids' => $creativityProductsIds,
        'cache_key' => 'main_page_creativity_products_goods_block'
    ])
])?>

<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'Stationery'),
    'content' => GoodCardWidget::widget([
        'ids' => $stationeryProductsIds,
        'cache_key' => 'main_page_stationery_products_goods_block'
    ])
])?>

<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'You might like it'),
    'hideControls' => true,
    'content' => GoodCardWidget::widget([
        'view' => 'grid',
        'ids' => $interestingProductsIds,
        'cache_key' => 'main_page_interesting_products_goods_block'
    ])
])?>