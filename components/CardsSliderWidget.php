<?php

namespace app\components;

use yii\base\Widget;

class CardsSliderWidget extends Widget {

    public $title;
    public $content;
    public $small_title;
    public $hideControls;

    public function run () {
        return $this -> render('cards_slider', [
            'title' => $this -> title,
            'content' => $this -> content,
            'small_title' => $this -> small_title,
            'hideControls' => $this -> hideControls
        ]);
    }
}