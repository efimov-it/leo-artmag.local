<?php

namespace app\components;

use Yii\base\Widget;

class ModalWidget extends Widget {
    public $content;
    public $className;
    public $contentClassName;
    public $id;
    public $showOnlyMobile;
    public function run() {
        return $this->render("modal", [
            'content' => $this -> content,
            'className'=> $this -> className,
            'contentClassName'=> $this -> contentClassName,
            'id'=> $this -> id,
            'showOnlyMobile'=> $this -> showOnlyMobile
        ]);
    }
}

?>