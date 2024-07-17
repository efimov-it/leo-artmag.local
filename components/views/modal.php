<?php
use app\components\IconsWidget;

$className = $className ? ' ' . $className : '';
$contentClassName = $contentClassName ? ' ' . $contentClassName : '';

?>

<div
    class="leo-modalWrapper<?=$showOnlyMobile ? ' leo-modalWrapper__mobile' : ''?>"
    style="display: none;" <?=$id ? 'id="' . $id . '"' : '' ?>
>
    <div class="leo-modalWrapper_background"></div>

    <div class="leo-modal<?=$className?>">

        <div class="leo-modal_mobileLine"></div>

        <?=IconsWidget::widget([
            'name' => 'cross',
            'className' => 'leo-modal_close',
            'ariaLabel' => Yii::t('app', 'Close the modal window'),
            'title' => Yii::t('app', 'Close the modal window')
        ])?>

        <div class="leo-modal_content<?=$contentClassName?>">
            <?=$content?>
        </div>
    </div>
</div>