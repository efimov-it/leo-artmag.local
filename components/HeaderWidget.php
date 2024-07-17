<?php

namespace app\components;

use yii\base\Widget;

class HeaderWidget extends Widget {
    public $phone;
    public $auth;
    public $catalog;
    public $shopsList;
    public $currentShop;
    public $currentCity;
    public $cityName;
    public $shopAddress;
    public $hideSearchOnMob;

    public function init () {
        parent::init ();
    }

    public function run () {
        return $this -> render ('header', [
            'phone'           => $this -> phone,
            'auth'            => $this -> auth,
            'catalog'         => $this -> catalog,
            'shopsList'       => $this -> shopsList,
            'currentShop'     => $this -> currentShop,
            'currentCity'     => $this -> currentCity,
            'cityName'        => $this -> cityName,
            'shopAddress'     => $this -> shopAddress,
            'hideSearchOnMob' => $this -> hideSearchOnMob
        ]);
    }
}