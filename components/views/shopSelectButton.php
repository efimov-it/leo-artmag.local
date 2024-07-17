<?php

use app\components\IconsWidget;

$className = $className ? ' ' . $className : '';

?>

<button
    class="leo-shopSelectButton<?=$className?>"
    title="<?=Yii::t('app', 'Choose a store')?>"
    aria-label="<?=Yii::t('app', 'Choose a store')?>"
>
    <?=IconsWidget::widget([
        'name' => 'map-marker',
        'className' => 'leo-shopSelectButton_icon'
    ])?>

    <p class="leo-shopSelectButton_placeholder">
        <?=Yii::t('app','Your city')?>
        •
        <?=Yii::t('app','Shop')?>
    </p>

    <p class="leo-shopSelectButton_value">
        <?= $city ? $city . ',' : '' ?>
        <?= $address ?>
    </p>
</button>