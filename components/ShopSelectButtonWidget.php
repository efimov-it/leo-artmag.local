<?php

namespace app\components;

use Yii;
use Yii\base\Widget;

class ShopSelectButtonWidget extends Widget {
    public $city;
    public $address;
    public $className;

    public function init() {
        parent::init();

        if ($this -> city === null) {
            $this -> city = '';
        }

        if ($this -> address === null) {
            $this -> address = Yii::t('app', 'Select the store\'s address');
        }
    }

    public function run() {
        return $this->render('shopSelectButton', [
            'city'    => $this -> city,
            'address' => $this -> address,
            'className' => $this -> className
        ]);
    }
}