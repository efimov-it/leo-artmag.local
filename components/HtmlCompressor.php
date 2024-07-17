<?php

namespace app\components;

use yii\base\ActionFilter;

class HtmlCompressor extends ActionFilter
{
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);

        if (is_string($result)) {
            $result = $this->compress($result);
        }

        return $result;
    }

    protected function compress($html)
    {
        $search = [
            '/\>[^\S ]+/s',     // удаление пробелов после тегов
            '/[^\S ]+\</s',     // удаление пробелов перед тегами
            '/(\s)+/s'          // замена множественных пробелов одним
        ];

        $replace = [
            '>',
            '<',
            '\\1'
        ];

        $html = preg_replace($search, $replace, $html);
        return $html;
    }
}