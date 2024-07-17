<?php

namespace app\components;

use yii\base\Widget;

class LogoWidget extends Widget {
    public $type;
    public $color;
    public $className;

    public function init () {
        parent::init ();

        if ( $this->type === null ) {
            $this->type = "default";
        }

        if ( $this->color === null ) {
            $this->color = "colored";
        }
    }

    public function run () {
        return $this->render ("logo", [
            'type'      => $this -> type,
            'color'     => $this -> color,
            'className' => $this -> className
        ]);
    }
}