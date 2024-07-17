<?php

namespace app\components;

use yii\base\Widget;

class InputWidget extends Widget {
    public $value;
    public $placeholder;
    public $type;
    public $className;
    public $id;
    public $name;
    public $required;
    public $actionIcon;

    public function init () {
        parent::init ();

        if ($this -> value === null) {
            $this -> value = '';
        }

        if ($this -> placeholder === null) {
            $this -> placeholder = '';
        }

        if ($this -> type === null) {
            $this -> type = 'text';
        }
    }

    public function run () {
        return $this -> render ('input', [
            'value'       => $this -> value,
            'placeholder' => $this -> placeholder,
            'type'        => $this -> type,
            'className'   => $this -> className,
            'name'        => $this -> name,
            'id'          => $this -> id,
            'required'    => $this -> required,
            'actionIcon'  => $this -> actionIcon
        ]);
    }
}

?>