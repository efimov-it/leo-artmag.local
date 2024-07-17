<?php
use app\components\IconsWidget;

?>

<section class="leo-cardsSlider">
    <div class="leo-cardsSlider_head">
        <h2 class="leo-cardsSlider_title<?=$small_title === true ? ' leo-cardsSlider_title__small' : ''?>"><?=$title?></h2>

        <?php
        if ($hideControls !== true) {
        ?>
        <div class="leo-cardsSlider_controls">
            <button class="leo-cardsSlider_button leo-cardsSlider_button__left" type="button" aria-label="<?=Yii::t('app', 'Back')?>" title="<?=Yii::t('app', 'Back')?>">
                <?=IconsWidget::widget([
                    'name' => 'arrow',
                    'className' => 'leo-cardsSlider_icon'
                ])?>
            </button>
            <button class="leo-cardsSlider_button" type="button" aria-label="<?=Yii::t('app', 'Forward')?>" title="<?=Yii::t('app', 'Forward')?>">
                <?=IconsWidget::widget([
                    'name' => 'arrow',
                    'className' => 'leo-cardsSlider_icon'
                ])?>
            </button>
        </div>
        <?php
        }
        ?>
    </div>

    <?=$content?>
</section>