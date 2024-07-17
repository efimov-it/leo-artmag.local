<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Cities;
use app\widgets\Alert;
use yii\base\View;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

use app\components\HeaderWidget;
use app\components\FooterWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <?php $this->head() ?>
    
    <script src="https://api-maps.yandex.ru/v3/?apikey=651e9520-22f9-40ab-87f7-7429a91f8573&lang=ru_RU"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <?php
    if (isset($this->params['css'])) {
        foreach ($this->params['css'] as $href) {
    ?>
    <link rel="stylesheet" href="<?=$href?>">
    <?php
        }
    }
    ?>

    <link rel="apple-touch-icon" sizes="180x180" href="/web/assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/web/assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/web/assets/icons/favicon-16x16.png">
    <link rel="manifest" href="/web/manifest.json">

</head>
<body>
<?php $this->beginBody() ?>

<?=HeaderWidget::widget([
    'phone'           => $this -> params['baseData']['phone'],
    'auth'            => null,
    'catalog'         => $this -> params['baseData']['catalog'],
    'shopsList'       => $this -> params['baseData']['shopsList'],
    'currentShop'     => $this -> params['baseData']['currentShop'],
    'currentCity'     => $this -> params['baseData']['currentCity'],
    'cityName'        => $this -> params['baseData']['cityName'],
    'shopAddress'     => $this -> params['baseData']['shopAddress'],
    'hideSearchOnMob' => $this -> params['hideHeaderSearchOnMob']
]);?>

<main class="leo-main">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    
    <?= $content ?>
</main>

<?=FooterWidget::widget([
    'auth'        => null,
    'phone'       => $this -> params['baseData']['phone'],
    'cityName'    => $this -> params['baseData']['cityName'],
    'shopAddress' => $this -> params['baseData']['shopAddress'],
    'catalog'     => $this -> params['baseData']['catalog'],
])?>


<?php
    if (isset($this->params['js'])) {
        foreach ($this->params['js'] as $src) {
    ?>
    <script src="<?=$src?>"></script>
    <?php
        }
    }
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
