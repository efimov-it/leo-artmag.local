<?php

namespace app\components;

use yii\base\Widget;

class IconsWidget extends Widget {
    public $name;
    public $className;
    public $title;
    public $ariaLabel;

    public function init() {
        parent::init();

        if ($this -> name === null) {
            $this -> name = 'blank';
        }
    }

    public function run() {
        return $this -> render('icons', [
            'name'      => $this -> name,
            'className' => $this -> className,
            'title'=> $this -> title,
            'ariaLabel' => $this -> ariaLabel
        ]);
    }
}