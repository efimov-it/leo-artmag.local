<?php

namespace app\components;

use Yii\base\Widget;

class FilterWidget extends Widget {
    public $filters;
    public $categories;

    public function run () {
        return $this -> render('filter', [
            'categories' => $this -> categories,
            'filters' => $this -> filters
        ]);
    }
}