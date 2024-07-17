<?php

use app\components\CatalogWidget;
use app\components\IconsWidget;
use app\components\LogoWidget;
use app\components\ButtonWidget;
use app\components\InputWidget;
use app\components\ModalWidget;
use app\components\ShopListWidget;
use app\components\ShopSelectButtonWidget;

use app\helpers\PhoneFormat;

use yii\helpers\Url;

$absoluteUrl = Url::home(true);
$currentUrl = Url::canonical();

?>


<div class="leo-headerTop">
    <?=ShopSelectButtonWidget::widget([
        'city' => $cityName,
        'address' => $shopAddress,
        'className' => 'leo-headerShop'
    ])?>

    <nav class="leo-headerTopLinks">
        <ul class="leo-headerTopList">
            <li class="leo-headerTopListItem">
                <a
                    class="leo-headerTopLink"
                    href="<?=$absoluteUrl?>catalog/brands"
                    aria-label="<?=Yii::t('app', 'Our brands')?>"
                ><?=Yii::t('app', 'Our brands')?></a>
            </li>
            <li class="leo-headerTopListItem">
                <a
                    class="leo-headerTopLink"
                    href="<?=$absoluteUrl?>actions"
                    aria-label="<?=Yii::t('app', 'Actions')?>"
                ><?=Yii::t('app', 'Actions')?></a>
            </li>
            <li class="leo-headerTopListItem">
                <a
                    class="leo-headerTopLink"
                    href="<?=$absoluteUrl?>info/oplata-i-dostavka"
                    aria-label="<?=Yii::t('app', 'Payment & delivery')?>"
                ><?=Yii::t('app', 'Payment & delivery')?></a>
            </li>
            <?php /*
            <li class="leo-headerTopListItem">
                <a
                    class="leo-headerTopLink"
                    href="<?=$absoluteUrl?>schools"
                    aria-label="<?=Yii::t('app', 'Schools')?>"
                ><?=Yii::t('app', 'Schools')?></a>
            </li> */
            ?>
            <li class="leo-headerTopListItem">
                <a
                    class="leo-headerTopLink"
                    href="<?=$absoluteUrl?>contacts"
                    aria-label="<?=Yii::t('app', 'Contacts')?>"
                ><?=Yii::t('app', 'Contacts')?></a>
            </li>
        </ul>

        <div class="leo-header_phone">
                <?=IconsWidget::widget([
                    'name'      => 'phone',
                    'className' => 'leo-header_phoneIcon'
                ])?>
            
            <a
                class="leo-header_phoneLink"
                href="tel:+<?=$phone?>"
                title="<?=Yii::t('app', 'Call')?>"
                aria-label="<?=Yii::t('app', 'Call')?>"
            >
                +<?=PhoneFormat::formatPhoneNumber($phone, 'ru')?>
            </a>
        </div>
    </nav>
</div>

<header class="leo-headerBottom<?=$hideSearchOnMob ? ' leo-headerBottom__hideOnMobile' : ''?>">
    <a
        href="<?=$absoluteUrl?>"
        class="leo-headerLogo"
        title="<?=Yii::t('app', 'Go to main')?>"
        aria-label="<?=Yii::t('app', 'Go to main')?>"
    >
        <?=LogoWidget::widget([
            'className' => 'leo-headerLogoImg'
        ])?>
    </a>

    <div class="leo-headerMenuWrapper">
        <?=ButtonWidget::widget([
            'icon'      => IconsWidget::widget([
                    'name'      => 'cross',
                    'className' => 'leo-headerMenu_icon'
                ]),
            'content'   => Yii::t('app', 'Catalog'),
            'title'     => Yii::t('app', 'Open the catalog'),
            'ariaLabel' => Yii::t('app', 'Open the catalog'),
            'className' => 'leo-headerMenu',
        ])?>
        <?=ButtonWidget::widget([
            'icon'      => IconsWidget::widget([
                    'name'      => 'menu',
                    'className' => 'leo-headerMenu_icon'
                ]),
            'content'   => Yii::t('app', 'Catalog'),
            'title'     => Yii::t('app', 'Open the catalog'),
            'ariaLabel' => Yii::t('app', 'Open the catalog'),
            'className' => 'leo-headerMenu',
            'id'        => 'desktopCalatogBtn'
        ])?>
    </div>

    <form action="<?$absoluteUrl?>search" class="leo-headerSerch">
        <?=InputWidget::widget([
            'placeholder' => Yii::t('app', 'Search in Leo Art'),
            'type' => 'search',
            'value' => isset($_GET['q']) ? $_GET['q'] : '',
            'name' => 'q',
            'className' => 'leo-headerSerch_input',
            'required' => true,
            // 'actionIcon' => IconsWidget::widget([
            //     'name' => 'code-scaner',
            //     'className' => 'leo-headerSerchButton'
            // ])
        ])?>

    </form>
    
    <?php
        if (false) {
    ?>

    <a
        href="<?=$currentUrl?>#notifications"
        class="leo-headerButton leo-headerButton__mobile"
        title="<?=Yii::t('app', 'Notifications')?>"
        aria-label="<?=Yii::t('app', 'Notifications')?>"
    >
        <?=IconsWidget::widget([
            'name' => 'notification',
            'className' => 'leo-headerButton_icon'
        ])?>
    </a>

    <a
        href="<?=$auth ? $absoluteUrl : $currentUrl . '#login?redirect='?>profile"
        class="leo-headerButton"
        title="<?=Yii::t('app', 'Go to profile')?>"
        aria-label="<?=Yii::t('app', 'Profile')?>"
    >
        <?=IconsWidget::widget([
            'name' => 'user',
            'className' => 'leo-headerButton_icon'
        ])?>

        <span class="leo-headerButton_text"><?=Yii::t('app', 'Profile')?></span>
    </a>
    <a
        href="<?=$auth ? $absoluteUrl : $currentUrl . '#login?redirect='?>profile/favorites"
        class="leo-headerButton"
        title="<?=Yii::t('app', 'Go to favorites')?>"
        aria-label="<?=Yii::t('app', 'Favorites')?>"
    >
        <?=IconsWidget::widget([
            'name' => 'favorites',
            'className' => 'leo-headerButton_icon'
        ])?>

        <span class="leo-headerButton_text"><?=Yii::t('app', 'Favorites')?></span>
    </a>

    <?php } ?>

    <?=ButtonWidget::widget([
        'href' => $absoluteUrl . 'cart',
        'icon' => IconsWidget::widget([
            'name' => 'cart'
        ]),
        'content' => Yii::t('app', 'Cart'),
        'color' => 'violet',
        'title' => Yii::t('app', 'Go to cart'),
        'ariaLabel' => Yii::t('app', 'Cart'),
        'className' => 'leo-headerCart'
    ])?>
</header>

<?=CatalogWidget::widget([
    'catalog' => $catalog
])?>

<?=ModalWidget::widget([
    'content'          => ShopListWidget::widget([
        'shopsList' => $shopsList,
        'currentShop' => $currentShop,
        'currentCity' => $currentCity
    ]),
    'className'        => 'leo-shopListModal',
    'contentClassName' => 'leo-shopListModal_content',
    'id'               => 'shopsModal'
])?>