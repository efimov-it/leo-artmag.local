<?php

namespace app\components;

use Yii\base\widget;

class CatalogWidget extends Widget {
    public $catalog;

    public function run () {
        return $this -> render('catalog', [
            'catalog' => $this -> catalog
        ]);
    }
}