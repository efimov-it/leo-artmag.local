<?php
use app\components\ButtonWidget;
use app\components\FilterWidget;
use app\components\GoodCardWidget;
use app\components\IconsWidget;
use yii\helpers\Url;

$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

$this->title = 'Поиск "' . $searchText . '" | ' . Yii::t('app', 'Leo-Art – products for creativity, study and work');

$this->params['breadcrumbs'][] = 'Поиск по запросу "' . $searchText . '"';

?>

<header class="leo-categoryHeader">
    <div class="leo-categoryHeader_title">
        <h1 class="leo-h1"><?='Поиск "' . $searchText . '"'?></h1>
        <p class="leo-categoryHeader_count"><?=$goodsCount?> товаров</p>
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

<div class="leo-categoryLayout">
    <aside class="leo-categoryLayout_aside">
        <?=FilterWidget::widget([
        ])?>
    </aside>

    <div class="leo-categoryLayout_grid">
        <?php
        if ($goodsCount > 0) {
        ?>
        <?=GoodCardWidget::widget([
            'view' => 'grid',
            'ids' => $goods
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