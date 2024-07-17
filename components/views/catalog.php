<?php
use app\components\IconsWidget;

use yii\helpers\Url;

$absoluteUrl = Url::home(true);
$currentUrl = Yii::$app -> request -> absoluteUrl;


?>

<div class="leo-catalogPopup">
    <div class="leo-catalogPopup_aside">
    <?php
        foreach ($catalog as $key => $category) {
    ?>

        <label class="leo-catalogPopupItem<?=$key === 0 ? ' leo-catalogPopupItem__active' : ''?> leo-listItem" for="catalogList_<?=$category['permalink']?>">
            <?= !$category['icon'] ? '' :
                IconsWidget::widget([
                    'name' => $category['icon'],
                    'className' => 'leo-listItem_icon leo-catalogPopupItem_icon'
                ])
            ?>

            <span class="leo-listItem_text leo-catalogPopupItem_text"><?=$category['title']?></span>

            <?= IconsWidget::widget([
                'name'      => 'arrow',
                'className' => 'leo-listItem_arrow'
            ])?>
        </label>
    <?php
        }
    ?>
    </div>

    <div class="leo-catalogPopup_view">

    <?php
        foreach ($catalog as $key => $category) {
    ?>
        <input type="radio" <?=$key === 0 ? 'checked' : ''?> class="leo-catalogPopup_check" id="catalogList_<?=$category['permalink']?>" name="catalogListChecker">
        <div class="leo-catalogView">
            <?php
                foreach ($category['child'] as $subCategory) {
            ?>
            <div class="leo-catalogView_block leo-catalogBlock">
                <h3 class="leo-catalogBlock_title">
                    <a
                        href="<?=$absoluteUrl . 'catalog/' . $category['permalink'] . '/' . $subCategory['permalink']?>"
                        class="leo-catalogBlockLink"
                    >
                        <?=$subCategory['title']?>
                    </a>
                </h3>

                <ul class="leo-catalogBlock_list">
                    <?php
                        foreach ($subCategory['child'] as $lastCategory) {
                    ?>
                    <li class="leo-catalogListItem">
                        <a
                            href="<?=$absoluteUrl . 'catalog/' . $category['permalink'] . '/' . $subCategory['permalink'] . '/' . $lastCategory['permalink']?>"
                            class="leo-catalogListItem_link"
                        >
                            <?=$lastCategory['title']?>
                        </a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <?php
                }
            ?>
        </div>
    <?php
    }
    ?>
    </div>
</div>