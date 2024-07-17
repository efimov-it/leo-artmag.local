<?php
use app\components\IconsWidget;
use app\components\InputWidget;
use app\components\LogoWidget;
use app\components\ButtonWidget;
use app\components\ModalWidget;
use app\components\ShopSelectButtonWidget;

use app\helpers\PhoneFormat;

use yii\helpers\Url;

$absoluteUrl = Url::home(true);
$currentUrl = Yii::$app -> request -> absoluteUrl;

?>

<nav class="leo-mobNav">
    <ul class="leo-mobNav_list">
        <li class="leo-mobNavItem<?=$absoluteUrl === $currentUrl ? ' leo-mobNavItem__active' : ''?>">
            <?=IconsWidget::widget([
                'name' => 'logo',
                'className' => 'leo-mobNavItem_icon'
            ])?>
            <span class="leo-mobNavItem_text"><?=Yii::t('app', 'Home')?></span>
            <a
                href="<?=$absoluteUrl?>"
                class="leo-mobNavItem_link"
                aria-label="<?=Yii::t('app', 'Go to main')?>"
            > </a>
        </li>
        <li class="leo-mobNavItem<?=strpos($currentUrl, $absoluteUrl . 'catalog') === 0 ? ' leo-mobNavItem__active' : ''?>">
            <?=IconsWidget::widget([
                'name' => 'catalog',
                'className' => 'leo-mobNavItem_icon'
            ])?>
            <span class="leo-mobNavItem_text"><?=Yii::t('app', 'Catalog')?></span>
            <a
                href="<?=$currentUrl?>#catalog"
                class="leo-mobNavItem_link"
                aria-label="<?=Yii::t('app', 'Open the catalog')?>"
            > </a>
        </li>
        <li class="leo-mobNavItem<?=$absoluteUrl . 'cart' === $currentUrl ? ' leo-mobNavItem__active' : ''?>">
            <?=IconsWidget::widget([
                'name' => 'cart',
                'className' => 'leo-mobNavItem_icon'
            ])?>
            <span class="leo-mobNavItem_text"><?=Yii::t('app', 'Cart')?></span>
            <a
                href="<?=$absoluteUrl?>cart"
                class="leo-mobNavItem_link"
                aria-label="<?=Yii::t('app', 'Go to cart')?>"
            > </a>
        </li>
        <?php
            if (false) {
        ?>
        <li class="leo-mobNavItem<?=strpos($currentUrl, $absoluteUrl . 'profile') === 0 ? ' leo-mobNavItem__active' : ''?>">
            <?=IconsWidget::widget([
                'name' => 'user',
                'className' => 'leo-mobNavItem_icon'
            ])?>
            <span class="leo-mobNavItem_text"><?=Yii::t('app', 'Profile')?></span>
            <a
                href="<?=$auth ? $absoluteUrl : $currentUrl . '#login?redirect='?>profile"
                class="leo-mobNavItem_link"
                aria-label="<?=Yii::t('app', 'Go to profile')?>"
            > </a>
        </li>
        <?php
            }
        ?>
        <li class="leo-mobNavItem">
            <?=IconsWidget::widget([
                'name' => 'menu',
                'className' => 'leo-mobNavItem_icon'
            ])?>
            <span class="leo-mobNavItem_text"><?=Yii::t('app', 'Menu')?></span>
            <a
                href="<?=$currentUrl?>#menu"
                class="leo-mobNavItem_link"
                aria-label="<?=Yii::t('app', 'Open the menu')?>"
            > </a>
        </li>
    </ul>
</nav>

<footer class="leo-footer">
    <div class="leo-footer_top">
        <a
            href="<?=$absoluteUrl?>"
            class="leo-footerLogo"
            title="<?=Yii::t('app', 'Go to main')?>"
            aria-label="<?=Yii::t('app', 'Go to main')?>"
        >
            <?=LogoWidget::widget([
                'color' => 'dark-bg',
                'className' => 'leo-footerLogo_img'
            ])?>
        </a>

        <?=ButtonWidget::widget([
            'content'   => Yii::t('app', 'Subscribe to the newsletter'),
            'color'     => 'white',
            'className' => 'leo-footerSubscribe',
            'ariaLabel' => Yii::t('app', 'Subscribe to the newsletter'),
            'href'      => $currentUrl . '#subscribe',
            // 'title'     => Yii::t('app', 'Subscribe to the newsletter'),
            'icon'      => IconsWidget::widget([
                'name'      => 'email',
                'className' => 'leo-footerSubscribe_icon'
            ])
        ])?>
    </div>

    <div class="leo-footer_center">
        <div class="leo-footerAppBlock">
            <img src="<?=$absoluteUrl?>assets/images/app_qr.jpg" class="leo-footerAppBlock_qr">

            <div class="leo-footerAppBlock_info">
                <h2 class="leo-footerAppBlockTitle"><?=Yii::t('app', 'Leo Art in your smartphone')?></h2>
                <p class="leo-footerAppBlockText"><?=Yii::t('app', 'Point your camera at the QR code and download the free Leo Art app to your smartphone.')?></p>

                <div class="leo-footerAppBlockLinks">
                    <a href="<?=$absoluteUrl?>app" class="leo-footerAppBlockLink">
                        <?=IconsWidget::widget([
                            'name' => 'android',
                            'className' => 'leo-footerAppBlockLink_img'
                        ])?>
                    </a>
                    <a href="<?=$absoluteUrl?>app" class="leo-footerAppBlockLink">
                        <?=IconsWidget::widget([
                            'name' => 'ios',
                            'className' => 'leo-footerAppBlockLink_img'
                        ])?>
                    </a>
                </div>
            </div>
        </div>

        <div class="leo-footerLinks">
            <nav class="leo-footerLinksColumn">
                <h3 class="leo-footerLinksColumn_title"><?=Yii::t('app', 'For customers')?></h3>

                <ul class="leo-footerLinksColumn_list">
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>catalog"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'Products catalog')?>"
                        ><?=Yii::t('app', 'Products catalog')?></a>
                    </li>
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>actions"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'Actions')?>"
                        ><?=Yii::t('app', 'Actions')?></a>
                    </li>
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>info/oplata-i-dostavka"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'Payment & delivery')?>"
                        ><?=Yii::t('app', 'Payment & delivery')?></a>
                    </li>
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>app"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'Mobile application')?>"
                        ><?=Yii::t('app', 'Mobile application')?></a>
                    </li>
                </ul>
            </nav>
            
            <nav class="leo-footerLinksColumn">
                <h3 class="leo-footerLinksColumn_title"><?=Yii::t('app', 'About the company')?></h3>

                <ul class="leo-footerLinksColumn_list">
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>info/o-leo-art"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'About Leo Art')?>"
                        ><?=Yii::t('app', 'About Leo Art')?></a>
                    </li>
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>catalog/brands"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'Our brands')?>"
                        ><?=Yii::t('app', 'Our brands')?></a>
                    </li>
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>franchise"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'Franchise')?>"
                        ><?=Yii::t('app', 'Franchise')?></a>
                    </li>
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>info/juridicheskaya-informacija"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'Legal information')?>"
                        ><?=Yii::t('app', 'Legal information')?></a>
                    </li>
                </ul>
            </nav>
            
            <nav class="leo-footerLinksColumn">
                <h3 class="leo-footerLinksColumn_title"><?=Yii::t('app', 'Help')?></h3>

                <ul class="leo-footerLinksColumn_list">
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>info/kak-oformit-zakaz"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'How to place an order')?>"
                        ><?=Yii::t('app', 'How to place an order')?></a>
                    </li>
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>contacts"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'Contacts')?>"
                        ><?=Yii::t('app', 'Contacts')?></a>
                    </li>
                    <li class="leo-footerLink">
                        <a
                            href="<?=$absoluteUrl?>info/uslovija-obrabotki-dannih"
                            class="leo-footerLink_text"
                            aria-label="<?=Yii::t('app', 'Data processing conditions')?>"
                        ><?=Yii::t('app', 'Data processing conditions')?></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    <div class="leo-footer_bottom">
        <?=ShopSelectButtonWidget::widget([
            'city' => $cityName,
            'address' => $shopAddress,
            'className' => 'leo-footerShop'
        ])?>

        
        <div class="leo-footerPhone">
            <?=IconsWidget::widget([
                'name'      => 'phone',
                'className' => 'leo-footerPhone_icon'
            ])?>
            
            <a
                class="leo-footerPhone_link"
                href="tel:+<?=$phone?>"
                title="<?=Yii::t('app', 'Call')?>"
                aria-label="<?=Yii::t('app', 'Call')?>"
            >
                +<?=PhoneFormat::formatPhoneNumber($phone, 'ru')?>
            </a>
        </div>
    </div>
</footer>



<?php

// Мобильное меню

ob_start();
?>
    <h2 class="leo-modalTitle">
        <?=Yii::t('app', 'Menu')?>
    </h2>

    <ul class="leo-list">
        <li class="leo-list_item">
            <a
                href="<?=$currentUrl?>#menu-user" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'For customers')?>"
            >
                <?=IconsWidget::widget([
                    'name' => 'user',
                    'className' => 'leo-listItem_icon'
                ])?>
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'For customers')?>
                </span>
                <?=IconsWidget::widget([
                    'name' => 'arrow',
                    'className' => 'leo-listItem_arrow'
                ])?>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$currentUrl?>#menu-about" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'About the company')?>"
            >
                <?=IconsWidget::widget([
                    'name' => 'shop',
                    'className' => 'leo-listItem_icon'
                ])?>
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'About the company')?>
                </span>
                <?=IconsWidget::widget([
                    'name' => 'arrow',
                    'className' => 'leo-listItem_arrow'
                ])?>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$currentUrl?>#menu-help" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Help')?>"
            >
                <?=IconsWidget::widget([
                    'name' => 'help',
                    'className' => 'leo-listItem_icon'
                ])?>
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Help')?>
                </span>
                <?=IconsWidget::widget([
                    'name' => 'arrow',
                    'className' => 'leo-listItem_arrow'
                ])?>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$currentUrl?>#subscribe" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Subscribe to the newsletter')?>"
            >
                <?=IconsWidget::widget([
                    'name' => 'email',
                    'className' => 'leo-listItem_icon'
                ])?>
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Subscribe to the newsletter')?>
                </span>
            </a>
        </li>
    </ul>
<?php
$modal_content = ob_get_clean();
?>
<?=ModalWidget::widget([
    'content' => $modal_content,
    'id' => 'mobileMenu',
    'showOnlyMobile' => true
]);?>



<?php

// Мобильное меню / Покупателям

ob_start();
?>
    <h2 class="leo-modalTitle">
        <?=Yii::t('app', 'For customers')?>
    </h2>

    <ul class="leo-list">
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>catalog" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Products catalog')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Products catalog')?>
                </span>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>actions" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Acctions')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Actions')?>
                </span>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>info/oplata-i-dostavka" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Payment & delivery')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Payment & delivery')?>
                </span>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>app" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Mobile application')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Mobile application')?>
                </span>
            </a>
        </li>
    </ul>
<?php
$modal_content = ob_get_clean();
?>
<?=ModalWidget::widget([
    'content' => $modal_content,
    'id' => 'mobileMenuUser',
    'showOnlyMobile' => true
]);?>



<?php

// Мобильное меню / О компании

ob_start();
?>
    <h2 class="leo-modalTitle">
        <?=Yii::t('app', 'About the company')?>
    </h2>

    <ul class="leo-list">
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>info/o-leo-art" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'About Leo Art')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'About Leo Art')?>
                </span>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>catalog/brands" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Our brands')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Our brands')?>
                </span>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>franchise" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Franchise')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Franchise')?>
                </span>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>info/juridicheskaya-informacija" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Legal information')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Legal information')?>
                </span>
            </a>
        </li>
    </ul>
<?php
$modal_content = ob_get_clean();
?>
<?=ModalWidget::widget([
    'content' => $modal_content,
    'id' => 'mobileMenuAbout',
    'showOnlyMobile' => true
]);?>



<?php

// Мобильное меню / Помощь

ob_start();
?>
    <h2 class="leo-modalTitle">
        <?=Yii::t('app', 'Help')?>
    </h2>

    <ul class="leo-list">
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>info/kak-oformit-zakaz" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'How to place an order')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'How to place an order')?>
                </span>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>contacts" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Contacts')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Contacts')?>
                </span>
            </a>
        </li>
        <li class="leo-list_item">
            <a
                href="<?=$absoluteUrl?>info/uslovija-obrabotki-dannih" class="leo-listItem"
                aria-label="<?=Yii::t('app', 'Data processing conditions')?>"
            >
                <span class="leo-listItem_text">
                    <?=Yii::t('app', 'Data processing conditions')?>
                </span>
            </a>
        </li>
    </ul>
<?php
$modal_content = ob_get_clean();
?>
<?=ModalWidget::widget([
    'content' => $modal_content,
    'id' => 'mobileMenuHelp',
    'showOnlyMobile' => true
]);?>



<?php

// Подписка на рассылку

ob_start();
?>
    <h2 class="leo-modalTitle">
        <?=Yii::t('app', 'Subscribe to the newsletter')?>
    </h2>

    <form
        class="leo-subscribeModal"
        action="<?=$absoluteUrl?>api/v1/subscribe"
        method="POST"
        id="subscribeForm"
    >
        <p class="leo-subscribeModal_text">
            <?=Yii::t('app', 'Subscribe to the newsletter and stay up to date with Leo Art events and promotions.')?>
        </p>

        <?=InputWidget::widget([
            'type'        => 'email',
            'name'        => 'email',
            'className'   => 'leo-subscribeModal_input',
            'required'    => true,
            'placeholder' => Yii::t('app','Your email address'),
        ])?>

        <p class="leo-subscribeModal_privacyText">
            <?=Yii::t('app','By subscribing to the newsletter, you agree to')?>
            <a
                href="<?=$absoluteUrl?>info/uslovija-obrabotki-dannih"
            >
            <?=Yii::t('app','the terms of data processing')?>
            </a>
            <?=Yii::t('app','and receipt of newsletters from Leo-Art.')?>
        </p>
        
        <?=ButtonWidget::widget([
            'content'   => Yii::t('app','Subscribe'),
            'type'      => 'submit',
            'className' => 'leo-subscribeModal_submit'
        ])?>
    </form>
<?php
$modal_content = ob_get_clean();
?>
<?=ModalWidget::widget([
    'content' => $modal_content,
    'id' => 'subscribeModal'
]);?>



<?php

// Подписка на рассылку / Ответ

ob_start();
?>
    <div class="leo-subscribeModal leo-subscribeModal__result">

        <?=IconsWidget::widget([
            'name' => 'check',
            'className' => 'leo-subscribeModal_resultIcon'
        ])?>
        
        <h2 class="leo-modalTitle leo-modalTitle__result">
            <?=Yii::t('app', 'You have subscribed to the newsletter')?>
        </h2>

        <p class="leo-subscribeModal_text leo-subscribeModal_text__result">
            <?=Yii::t('app', 'Now you can get up-to-date information about Leo Art events and promotions.')?>
        </p>
        
        <?=ButtonWidget::widget([
            'content'   => Yii::t('app','OK'),
            'className' => 'leo-subscribeModal_submit',
            'id'        => 'subscribeFormDoneBtn'
        ])?>
    </div>
<?php
$modal_content = ob_get_clean();
?>
<?=ModalWidget::widget([
    'content' => $modal_content,
    'id' => 'subscribeModalResult'
]);?>



<?php

// Мобильное меню каталога

function printCatalog ($catalog, $id, $title = null) {
    
    global $currentUrl;
    global $absoluteUrl;
    
    $subCategories = [];

    ob_start();
    ?>
            
        <h2 class="leo-modalTitle">
            <?=$title ? $title : Yii::t('app', 'Catalog') ?>
        </h2>
        
        <ul class="leo-list">
        <?php
        
        foreach ($catalog as $category) {

            if (isset($category['parentPath'])) {
                $category['permalink'] = $category['parentPath'] . '/' . $category['permalink'];
            }

            $parentPath = $category['permalink'];

            $tmpSubCategories = [
                'title'  => $category['title'],
                'id'  => 'catalog_' . $category['permalink'],
                'child' => []
            ];
        
            foreach ($category['child'] as $subCategory) {
                $subCategory['parentPath'] = $parentPath;
                $tmpSubCategories['child'][] = $subCategory;
            }

            $subCategories[] = $tmpSubCategories;

        ?>
            <li class="leo-list_item">
                <a
                    href="<?= count($category['child']) === 0 ? Url::home(true) . 'catalog/' . $category['permalink'] : $currentUrl . '#catalog_' . $category['permalink']?>"
                    class="leo-listItem"
                >
                    <?=!$category['icon'] ? '' :
                        IconsWidget::widget([
                            'name' => $category['icon'],
                            'className' => 'leo-listItem_icon'
                        ])
                    ?>
                    <span class="leo-listItem_text">
                        <?=$category['title']?>
                    </span>
                    <?= count($category['child']) === 0 ? '' :
                        IconsWidget::widget([
                            'name' => 'arrow',
                            'className' => 'leo-listItem_arrow'
                        ])
                    ?>
                </a>
            </li>
        <?php
        }
        ?>
        </ul>
    <?php
    $modal_content = ob_get_clean();
    
    echo ModalWidget::widget([
        'content'        => $modal_content,
        'id'             => $id,
        'showOnlyMobile' => true
    ]);

    foreach ($subCategories as $category) {
        printCatalog($category['child'], $category['id'], $category['title']);
    }
}

printCatalog($catalog, 'catalog');