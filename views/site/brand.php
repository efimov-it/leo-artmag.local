<?php
use app\components\ButtonWidget;
use app\components\FilterWidget;
use app\components\GoodCardWidget;
use app\components\IconsWidget;
use yii\helpers\Url;

$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

$this->title = $brand -> name . ' | ' . Yii::t('app', 'Leo-Art – products for creativity, study and work');

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Products catalog'),
    'url'   => Url::home(true).'catalog'
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Our brands'),
    'url'   => Url::home(true).'catalog/brands'
];

$this->params['breadcrumbs'][] = $brand -> name;

?>

<header class="leo-categoryHeader leo-categoryHeader__brand">
    <img src="<?=Url::home(true).'uploads/brands_images/' . $brand -> id . '.svg'?>" class="leo-categoryHeader_brandLogo" width="120" height="80" alt="">
    <div class="leo-categoryHeader_title leo-categoryHeader_title__brand">
        <h1 class="leo-h1"><?=$brand -> name?></h1>
        <p class="leo-categoryHeader_count"><?=$goodsCount?> товаров</p>
        
        <pre class="leo-categoryHeader_description">
            <?=strip_tags($brand -> description)?>
        </pre>
    </div>

    <?=ButtonWidget::widget([
        'content'   => Yii::t('app','Share'),
        'color'     => 'gray',
        'className' => 'leo-categoryHeader_share leo-shareBtn',
        'icon'    => IconsWidget::widget([
            'name'      => 'share',
            'className' => 'leo-categoryHeader_shareIcon'
        ])
    ])?>
</header>

<section class="leo-categoryBrand">
    <img src="<?=Url::home(true).'uploads/brands_images/' . $brand -> id . '.svg'?>" class="leo-categoryBrand_logo" width="248" height="100" alt="">
    <h2 class="leo-categoryBrand_name"><?=$brand -> name?></h2>
    <pre class="leo-categoryBrand_description">
        <?=strip_tags($brand -> description)?>
    </pre>
</section>

<div class="leo-categoryLayout">
    <aside class="leo-categoryLayout_aside">
        <?=FilterWidget::widget([])?>
    </aside>

    <div class="leo-categoryLayout_grid">
        <?php
        if ($goodsCount > 0) {
        ?>
        <?=GoodCardWidget::widget([
            'view' => 'grid',
            'ids' => $goods,
            'cache_key' => 'brand_page_' . $brand -> id . '_products_block_page_' . $currentPage
        ])?>
        <?php
        }

        if (count($pagination) > 1) {
        ?>
        <div class="leo-categoryLayout_gridPagination leo-pagination">
            <div class="leo-pagination_row">
            <?php
            foreach ($pagination as $page) {
                $activeClass = $page == $currentPage ? ' leo-pagination_item__active' : '';
                $previousClass = $page == $currentPage - 1 ? ' leo-pagination_item__previous' : '';

                if ($page === 1 ||
                    $page === 2 ||
                    $page === $currentPage - 2 ||
                    $page === $currentPage - 1 ||
                    $page === $currentPage ||
                    $page === $currentPage + 1 ||
                    $page === $currentPage + 2 ||
                    $page === count($pagination) - 1 ||
                    $page === count($pagination)) {
                        if ($page === $currentPage - 2 ||
                            $page === $currentPage + 2) {
            ?>
                <p class="leo-pagination_item leo-pagination_item__disabled">...</p>
            <?php
                        } else {
            ?>
                <a class="leo-pagination_item<?=$activeClass.$previousClass?>" href="<?=Url::current(['page' => $page])?>"><?=$page?></a>
            <?php
                        }
                }
            }
            ?>
            </div>
            
            <?=$currentPage + 1 <= count($pagination) ? ButtonWidget::widget([
                'href'      => Url::current(['page' => $currentPage + 1]),
                'content'   => Yii::t('app', 'Next'),
                'color'     => 'violet',
                'className' => 'leo-pagination_moreBtn'
            ]) : ''?>
        </div>
        <?php
        }
        ?>
    </div>
</div>