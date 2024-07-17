<?php

namespace app\components;

use Yii;
use yii\base\Widget;

class ButtonWidget extends Widget {
    public $id;
    public $content;
    public $icon;
    public $color;
    public $href;
    public $target;
    public $className;
    public $title;
    public $ariaLabel;
    public $type;

    public function init() {
        parent::init();

        if ( $this -> content === null || trim($this -> content) === '') {
            $this -> content = Yii::t('app', 'Button');
        }

        if ( $this -> color === null ) {
            $this -> color = 'orange';
        }
    }

    public function run () {
        return $this -> render('button', [
            'id'         => $this -> id,
            'content'    => $this -> content,
            'icon'       => $this -> icon,
            'color'      => $this -> color,
            'href'       => $this -> href,
            'target'     => $this -> target,
            'className'  => $this -> className,
            'title'      => $this -> title,
            'ariaLabel'  => $this -> ariaLabel,
            'type'       => $this -> type
        ]);
    }
}