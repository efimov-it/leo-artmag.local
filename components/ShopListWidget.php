<?php

namespace app\components;

use Yii\base\Widget;

class ShopListWidget extends Widget {

    public $currentShop;
    public $currentCity;
    public $shopsList;
    
    public function run () {
        return $this -> render ("shop_list", [
            'currentShop' => $this -> currentShop,
            'currentCity' => $this -> currentCity,
            'shopsList'   => $this -> shopsList
        ]);
    }
}

?>