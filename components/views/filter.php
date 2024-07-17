<?php
use app\components\ButtonWidget;

?>

<div class="leo-categoryLayout_filter">
    <h3 class="leo-categoryLayout_filterTitle"><?=Yii::t('app', 'Sorting')?></h3>

    <ul class="leo-categoryLayout_filterList">
        <li class="leo-categoryLayout_filterItem">
            <?=Yii::t('app','New ones first')?>
        </li>
        <li class="leo-categoryLayout_filterItem">
            <?=Yii::t('app','Inexpensive ones at first')?>
        </li>
        <li class="leo-categoryLayout_filterItem">
            <?=Yii::t('app','Expensive ones first')?>
        </li>
        <li class="leo-categoryLayout_filterItem">
            <?=Yii::t('app','Popular ones first')?>
        </li>
    </ul>
</div>

<?php
if ($categories) {
?>
<div class="leo-categoryLayout_filter">
    <h3 class="leo-categoryLayout_filterTitle"><?=Yii::t('app', 'Product type')?></h3>

    <ul class="leo-categoryLayout_filterList">
    <?php
    foreach ($categories as $subCat) {
    ?>
        <li class="leo-categoryLayout_filterItem">
            <?=$subCat -> title?>
        </li>
    <?php
    }
    ?>
    </ul>
</div>
<?php
}
?>

<div class="">
    <?=ButtonWidget::widget([
        'content'   => Yii::t('app','Apply'),
        'className' => 'leo-categoryLayout_resetFilters leo-categoryLayout_resetFilters__mob'
    ])?>
    <?=ButtonWidget::widget([
        'content'   => Yii::t('app','Reset filters'),
        'color'     => 'gray',
        'className' => 'leo-categoryLayout_resetFilters'
    ])?>
</div>