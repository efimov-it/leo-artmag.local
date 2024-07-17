<?php

namespace app\components;

use yii\base\Widget;

use app\models\Banners;

class MainPageBanner extends Widget {
    public function run() {

        $lang = 'ru';
        $currentShop = isset($_COOKIE['shopid']) ? intval($_COOKIE['shopid']) : 1;

        $banners = Banners::find()->
                            join('left join', '{{%banners_stores}}', 'banners.id = banners_stores.banner_id')->
                            where("active = 1 AND place like 'main_page' AND lang_key like '$lang' AND (global = 1 OR banners_stores.store_id = $currentShop)")->all();

        return $this->render('mainpagebanner', [
            'banners' => $banners
        ]);
    }
}