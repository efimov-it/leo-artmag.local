<?php

namespace app\components;

use Yii\base\Widget;

class FooterWidget extends Widget {
    public $auth;
    public $phone;
    public $catalog;
    public $cityName;
    public $shopAddress;

    public function run() {
        return $this->render("footer", [
            'auth'        => $this -> auth,
            'phone'       => $this -> phone,
            'catalog'     => $this -> catalog,
            'cityName'    => $this -> cityName,
            'shopAddress' => $this -> shopAddress
        ]);
    }
}