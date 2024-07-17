<?php
use app\components\ButtonWidget;
use app\components\IconsWidget;
use app\components\InputWidget;

?>

<div class="leo-goodsCardsView<?=$view === 'grid' ? ' leo-goodsCardsView__grid' : ''?>">
    <?php
    foreach ($goods as $i => $good) {
        $image = '/assets/images/no_image.webp';
        if ($images[$i][0]->url) {
            $image = str_replace('/images/', '/208x208/', $images[$i][0]->url);
        }
    ?>
    <div class="leo-goodCard">
        <img class="leo-goodCard_image" src="/assets/images/lazy_loading.gif" data-src="<?=$image?>" width="208" height="208">
        <div class="leo-goodCard_priceBlock">
            <span class="leo-goodCard_curentPrice"><?=number_format($good['price'], 2, '.', ' ')?> ₽</span>
            <?php if ($good['old_price']) {?>
                <span class="leo-goodCard_oldPrice"><?=number_format($good['old_price'], 2, '.', ' ')?> ₽</span>
            <?php } ?>
            <?php if ($good['discount']) {?>
                <span class="leo-goodCard_discount">-<?=$good['discount']?>%</span>
            <?php } ?>
        </div>

        <a href="<?=$permalinks[$i]?>" class="leo-goodCard_title"><?=$good['name']?></a>
        
        <div class="leo-goodCard_buttons" data-id="<?=$good['id']?>">
            <?=ButtonWidget::widget([
                'content'   => Yii::t('app', 'Add to cart'),
                'color'     => 'violet',
                'type'      => 'button',
                'className' => 'leo-goodCard_addBtn',
                'icon'    => IconsWidget::widget([
                    'name'      => 'cart',
                    'className' => 'leo-goodCard_addBtnIcon'
                ])
            ])?>

            <div class="leo-goodCard_counter">
            <?=ButtonWidget::widget([
                'color'     => 'violet',
                'type'      => 'button',
                'className' => 'leo-goodCard_counterButton',
                'content' => IconsWidget::widget([
                    'name'      => 'minus',
                    'className' => 'leo-goodCard_counterIcon'
                ])
            ])?>
            
            <?=InputWidget::widget([
                'type'      => 'number',
                'value'     => 0,
                'className' => 'leo-goodCard_counterInput'
            ])?>

            <?=ButtonWidget::widget([
                'color'     => 'violet',
                'type'      => 'button',
                'className' => 'leo-goodCard_counterButton',
                'content' => IconsWidget::widget([
                    'name'      => 'plus',
                    'className' => 'leo-goodCard_counterIcon'
                ])
            ])?>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>