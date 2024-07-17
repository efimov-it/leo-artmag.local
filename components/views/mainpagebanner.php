<div class="leo-mainPageBanner">

    <div class="leo-mainPageBanner_progress">
    <?php
    use app\components\ButtonWidget;
    foreach ($banners as $banner) {
    ?>
        <div class="leo-mainPageBannerIndicator">
            <div class="leo-mainPageBannerIndicator_progress"></div>
        </div>
    <?php
    }
    ?>
    </div>

<?php
foreach ($banners as $key => $banner) {
?>
    <div class="leo-mainPageBanner_slide<?=$key === 0 ? ' leo-mainPageBanner_slide__active' : ''?>"<?=$key === 0 ? ' style="display: block;"' : ''?>>
        <img src="<?=$banner->image?>d.jpg" class="leo-mainPageBanner_image leo-mainPageBanner_image__desktop" width="1280" height="400" alt="">
        <img src="<?=$banner->image?>m.jpg" class="leo-mainPageBanner_image leo-mainPageBanner_image__mobile" width="288" height="400" alt="">
        <div class="leo-mainPageBanner_content">
            <h3 class="leo-mainPageBanner_title"><?=$banner->title?></h3>
            <p class="leo-mainPageBanner_text"><?=$banner->text?></p>

            <?=ButtonWidget::widget([
                'content'   => $banner->link_text,
                'href'      => $banner->link,
                'className' => 'leo-mainPageBanner_button'
            ])?>
        </div>
    </div>
<?php
}
?>
</div>