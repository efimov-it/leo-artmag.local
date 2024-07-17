<?php
use app\components\ButtonWidget;
use app\components\IconsWidget;
use app\components\InputWidget;
use app\components\ModalWidget;

$currentShopData = $shopsList[0] -> shops[0];

foreach ($shopsList as $i => $city) {
    foreach ($city -> shops as $i => $shop) {
        if ($city -> id === $currentCity && $shop -> id === $currentShop) {
            $currentShopData = $shop;
        }
    }
}
?>
<script type="application/json" id="currentShopData"><?=json_encode($currentShopData)?></script>

<h3 class="leo-shopListHeader">
    <?=Yii::t('app', 'Choosing a store')?>
</h3>
<p class="leo-shopListText">
    <?=Yii::t('app', 'The selected store affects the prices in the catalog')?>
</p>

<div class="leo-shopListContent">
    <div class="leo-shopListCities">
        <div class="leo-shopListCities_search">
            <?=InputWidget::widget([
                'placeholder' => Yii::t('app', 'Search by city'),
                'id'          => 'shopListCitySearch',
                'className'   => 'leo-shopListCities_searchInput',
                'type'        => 'search'
            ])?>
        </div>

        <ul class="leo-shopListCities_list">
        <?php
        foreach ($shopsList as $i => $city) {
        ?>
            <li class="leo-shopListCitiesItem<?=$currentCity == $city -> id ? ' leo-shopListCitiesItem__active' : ''?>" data-cityid="<?=$city -> id?>" data-citygeo="<?=json_encode($city -> geo)?>" aria-label="<?=Yii::t('app', 'Choose a city') . ' – ' . $city -> name?>" title="<?=Yii::t('app', 'Choose a city')?>">
                <h4 class="leo-shopListCitiesItem_name"><?=$city -> name?></h4>
                <p class="leo-shopListCitiesItem_count">
                    <?=Yii::t('app', 'Stores') . ': ' . $city -> count?>
                </p>
                <?=IconsWidget::widget([
                    'name' => 'arrow',
                    'className' => 'leo-shopListCitiesItem_icon'
                ])?>
            </li>
        <?php
        }
        ?>
        </ul>
    </div>

    <div class="leo-shopListBlock">
    <?php
    foreach ($shopsList as $i => $city) {
    ?>
        <ul class="leo-shopListBlock_list<?=$currentCity == $city -> id ? ' leo-shopListBlock_list__active' : ''?>" data-id="<?=$city -> id?>">
        <?php
        foreach ($city -> shops as $i => $shop) {
            $shop -> cityid = $city -> id;
        ?>
            <li class="leo-shopListBlockItem <?=$currentShop == $shop -> id ? ' leo-shopListBlockItem__active' : ''?>" data-shopid="<?=$shop -> id?>">
            <script type="application/json"><?=json_encode($shop)?></script>
                <div class="leo-shopListBlockItem_text">
                    <h4 class="leo-shopListBlockItem_textName"><?=$shop -> name?></h4>
                    <p class="leo-shopListBlockItem_textAddress"><?=$shop -> address?></p>
                </div>

                <div class="leo-shopListBlockItem_icon">
                    <?=IconsWidget::widget([
                        'name'      => 'arrow',
                        'className' => 'leo-shopListBlockItem_iconArrow'
                    ])?>
                    <?=IconsWidget::widget([
                        'name'      => 'check',
                        'className' => 'leo-shopListBlockItem_iconCheck'
                    ])?>
                </div>
            </li>
        <?php
        }
        ?>
        </ul>
    <?php
    }
    ?>
    </div>

    <div class="leo-shopListMap">
        <div class="leo-shopListMap_wrapper">
            <div class="leo-shopListMap_yamap" id="yamapShopList"></div>
            <?=ButtonWidget::widget([
                'id'        => 'getClosetShopBtn',
                'content'   => Yii::t('app', 'Find the nearest one'),
                'icon'      => IconsWidget::widget([
                    'name'      => 'map-marker',
                    'className' => 'leo-shopListNearestBtn_icon'
                ]),
                'className' => 'leo-shopListNearestBtn',
                'ariaLabel' => Yii::t('app', 'Find the nearest one'),
                'type'      => 'button'
            ])?>
        </div>

<?php
ob_start();
?>
<h3 class="leo-shopListHeader leo-shopListHeader__shopModal" id="shopModal-shopName"></h3>
<p class="leo-shopListText leo-shopListText__shopModal" id="shopModal-shopAddress"></p>
<div class="leo-shopListImages">
    <a target="_blank" rel="noopener noreferrer" class="leo-shopListImages_map">
        <img class="leo-shopListImages_mapImage" id="shopModal-staticMap" alt="" width="75" height="125">
        <img src="/assets/images/map-marker.svg" class="leo-shopListImages_mapMarker" alt="" width="28" height="37">
    </a>
</div>

<h4 class="leo-shopModalSheduleHeader"><?=Yii::t('app', 'Opening hours')?></h4>
<script type="application/json" id="shopShaduleTitles">
    {
        "Closed": "<?=Yii::t('app', 'Closed')?>",
        "Mon": "<?=Yii::t('app', 'Mon')?>",
        "Tue": "<?=Yii::t('app', 'Tue')?>",
        "Wed": "<?=Yii::t('app', 'Wed')?>",
        "Thu": "<?=Yii::t('app', 'Thu')?>",
        "Fri": "<?=Yii::t('app', 'Fri')?>",
        "Sut": "<?=Yii::t('app', 'Sut')?>",
        "Sun": "<?=Yii::t('app', 'Sun')?>",
        "Everyday": "<?=Yii::t('app', 'Everyday')?>",
        "Weekday": "<?=Yii::t('app', 'Weekday')?>",
        "Weekend": "<?=Yii::t('app', 'Weekend')?>",
        "Opening": "<?=Yii::t('app', 'Opening soon')?>",
        "Choose this store": "<?=Yii::t('app', 'Choose this store')?>"
    }
</script>
<div class="leo-shopModalShedule"></div>
<?=ButtonWidget::widget([
    'content'   => Yii::t('app', 'Choose this store'),
    'className' => 'leo-shopModalButton',
    'id'        => 'shopModalButton'
])?>
<?php
$shopModal = ob_get_clean();
?>
        <?=ModalWidget::widget([
            'content'          => $shopModal,
            'className'        => 'leo-shopDataModal',
            'contentClassName' => 'leo-shopDataModal_content',
            'id'               => 'shopsDataModal'
        ])?>
    </div>
</div>