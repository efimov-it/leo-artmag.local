<?php
use app\components\ButtonWidget;
use app\components\CardsSliderWidget;
use app\components\GoodCardWidget;
use app\components\IconsWidget;
use yii\helpers\Url;


$this->title = $good -> name . ' | ' . Yii::t('app', 'Leo-Art – products for creativity, study and work');

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Products catalog'),
    'url'   => Url::home(true).'catalog'
];
$this->params['breadcrumbs'][] = [
    'label' => $root -> title,
    'url'   => Url::home(true) . 'catalog/' . $root -> permalink
];

$this->params['breadcrumbs'][] = [
    'label' => $category -> title,
    'url' => Url::home(true) . 'catalog/' . $root -> permalink . '/' . $category -> permalink
];

$this->params['breadcrumbs'][] = $good -> name;
?>

<div class="leo-goodHeader leo-customHeader">
    <a href="<?=Url::home(true) . 'catalog/' . $root -> permalink . '/' . $category -> permalink?>" class="leo-customHeader_backButton" aria-label="">
        <?=IconsWidget::widget([
            'name'      => 'arrow',
            'className' => 'leo-customHeader_backButtonIcon'
        ])?>
    </a>

    <div class="leo-customHeader_title">
        <h1 class="leo-goodHeader_title"><?=$good -> name?></h1>
        <p class="leo-goodHeader_category"><?=$category -> title?></p>
    </div>

    <?=ButtonWidget::widget([
        'content'   => '<span>' . Yii::t('app', 'Share') . '</span>',
        'color'     => 'gray',
        'className' => 'leo-goodHeader_share leo-customHeader_share leo-shareBtn',
        'icon'      => IconsWidget::widget([
            'name'      => 'share',
            'className' => 'leo-goodHeader_shareIcon'
        ])
    ])?>
</div>

<div class="leo-goodTop">
    <div class="leo-goodTop_gallery">
        <div class="leo-goodTop_galleryPreviews">
            <?php
            foreach($images as $i => $image) {
                $tmp_image = str_replace('/images/', '/208x208/', $image -> url);
            ?>
            <img src="<?=$tmp_image?>" class="leo-goodTop_galleryPreview<?=$i === 0 ? ' leo-goodTop_galleryPreview__active' : ''?>" width="64" height="64" alt="">
            <?php    
            }?>
        </div>

        <div class="leo-goodTop_galleryImages">
            <?php
            foreach($images as $i => $image) {
            ?>
            <a href="<?=$image -> url?>" class="leo-goodTop_galleryImageLink<?=$i === 0 ? ' leo-goodTop_galleryImageLink__active' : ''?>" data-fancybox="gallery-m">
                <img src="<?=$image -> url?>" class="leo-goodTop_galleryImage" width="400" height="400" alt="">
            </a>
            <?php    
            }?>
        </div>
    </div>

    <div class="leo-goodTop_centerBlock">
        <?php
        if (count($group) > 1) {
        ?>
        <div class="leo-goodTop_details">
            <p class="leo-goodTop_title"><?=Yii::t('app', 'Variants')?><sup class="leo-goodTop_title__sup"><?=count($group)?></sup></p>
            
            <ul class="leo-goodTop_detailsList">
                <?php
                foreach ($group as $item) {
                ?>
                <li class="leo-goodTop_detail">
                    <?=$item -> id?>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <?php
        }
        ?>

        <div class="leo-goodTop_characteristics">
            <p class="leo-goodTop_title"><?=Yii::t('app', 'General characteristics')?></p>
            
            <div class="leo-goodTop_characteristicsList">
                
                <div class="leo-goodTop_characteristic">
                    <p class="leo-goodTop_characteristicName">Name 1</p>
                    <p class="leo-goodTop_characteristicValue">Value 1</p>
                </div>
                <div class="leo-goodTop_characteristic">
                    <p class="leo-goodTop_characteristicName">Name 2</p>
                    <p class="leo-goodTop_characteristicValue">Value 2</p>
                </div>
                <div class="leo-goodTop_characteristic">
                    <p class="leo-goodTop_characteristicName">Name 3</p>
                    <p class="leo-goodTop_characteristicValue">Value 3</p>
                </div>
            </div>

            <a href="#characteristics" class="leo-goodTop_link">
                <?=Yii::t('app', 'All characteristics')?>
            </a>
        </div>
    </div>

    <div class="leo-goodTopRight">
        <div class="leo-goodTopRight_priceNDelivery">
            <div class="leo-goodTopRight_price">
                <p class="leo-goodTopRight_priceValue">
                    <?=number_format($good -> price, 2, ',', ' ')?> ₽
                    <?php
                    if ($good -> old_price) {
                    ?>
                    <sup class="leo-goodTopRight_priceValue leo-goodTopRight_priceValue__old"><?=number_format($good -> old_price, 2, ',', ' ')?> ₽</sup>
                    <?php
                    }
                    ?>
                </p>

                <?php
                if ($good -> discount) {
                ?>
                <p class="leo-goodTopRight_discount">
                    <?=$good -> discount?>%
                </p>
                <?php
                }
                ?>
            </div>

            <div class="leo-goodTopRight_deliveryBlock">
                <div class="leo-goodTopRight_delivery">
                    <?=IconsWidget::widget([
                        'name'      => 'shop',
                        'className' => 'leo-goodTopRight_deliveryIcon'
                    ])?>

                    <div class="leo-goodTopRight_deliveryInfo">
                        <h4 class="leo-goodTopRight_deliveryName"><?=Yii::t('app', 'Pickup from store')?></h4>
                        <p class="leo-goodTopRight_deliveryDuration"><?=Yii::t('app', 'Up to')?> 14 <?=Yii::t('app', 'days')?></p>
                    </div>

                    <span class="leo-goodTopRight_deliveryCost">
                        <?=Yii::t('app', 'Free')?>
                    </span>
                </div>
                
                <div class="leo-goodTopRight_delivery">
                    <?=IconsWidget::widget([
                        'name'      => 'delivery',
                        'className' => 'leo-goodTopRight_deliveryIcon'
                    ])?>

                    <div class="leo-goodTopRight_deliveryInfo">
                        <h4 class="leo-goodTopRight_deliveryName"><?=Yii::t('app', 'Courier delivery')?></h4>
                        <p class="leo-goodTopRight_deliveryDuration"><?=Yii::t('app', 'Up to')?> 14 <?=Yii::t('app', 'days')?></p>
                    </div>

                    <span class="leo-goodTopRight_deliveryCost">
                        <?=number_format(199, 2, ',', ' ')?> ₽
                    </span>
                </div>
            </div>

            <?=ButtonWidget::widget([
                'content'   => Yii::t('app', 'Add to cart'),
                'color'     => 'violet',
                'className' => 'leo-goodTop_addToCart',
                'icon'      => IconsWidget::widget([
                    'name'      => 'cart',
                    'className' => 'leo-goodTop_addToCartIcon'
                ])
            ])?>
        </div>

        <div class="leo-goodTopRight_brand">
            <img src="<?=Url::home(true)?>uploads/brands_images/<?=$brand -> id?>.svg" class="leo-goodTopRight_brandLogo" width="80" height="80" alt="">

            <div class="leo-goodTopRight_brandInfo">
                <h3 class="leo-goodTopRight_brandName">
                    <?=$brand -> name?>
                </h3>
                <p class="leo-goodTopRight_brandDescription">
                    <?=strip_tags($brand -> description)?>
                </p>

                <a href="<?=Url::home(true) . 'catalog/brands/' . $brand -> permalink?>" class="leo-goodTopRight_brandLink">
                    <?=Yii::t('app', 'View all products')?>
                    <?=IconsWidget::widget([
                        'name'      => 'arrow',
                        'className' => 'leo-goodTopRight_brandLinkIcon'
                    ])?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
if ($good -> description) {
?>
<section class="leo-goodDescription">
    <h2 class="leo-goodDescription_title"><?=Yii::t('app', 'Product description')?></h2>
    <pre class="leo-goodDescription_text">
        <?=trim($good -> description)?>
    </pre>
</section>
<?php
}
?>

<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'Also bought'),
    'small_title' => true,
    'hideControls' => count([290095, 290100, 290102, 290112, 290123, 290126]) < 5,
    'content' => GoodCardWidget::widget([
        'view' => 'row',
        'ids' => [290095, 290100, 290102, 290112, 290123, 290126]
    ])
])?>

<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'Similar products'),
    'small_title' => true,
    'hideControls' => count([290095, 290100, 290102, 290112, 290123, 290126]) < 5,
    'content' => GoodCardWidget::widget([
        'view' => 'row',
        'ids' => [290095, 290100, 290102, 290112, 290123, 290126]
    ])
])?>

<?=CardsSliderWidget::widget([
    'title' => Yii::t('app', 'You might like it'),
    'small_title' => true,
    'hideControls' => true,
    'content' => GoodCardWidget::widget([
        'view' => 'grid',
        'ids' => [290095, 290100, 290102, 290112, 290123, 290126]
    ])
])?>