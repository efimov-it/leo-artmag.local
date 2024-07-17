<?php

namespace app\components;

use Yii;
use yii\base\Widget;

use app\models\CategoryL1;

class CategoryCardWidget extends Widget {

    public $limit;
    public $view;
    public $random;
    public $data;
    public $parent;
    public $cache_key;

    public function init () {
        parent::init();

        if ($this -> view !== 'grid' && $this -> view !== 'row') {
            $this -> view = 'grid';
        }
    }

    public function run () {
        if ($this -> data) {
            $categories = $this -> data;
        }
        else {
            $categories = false;

            if ($this -> cache_key) {
                $categories = Yii::$app->cache->get($this -> cache_key);
            }
            
            if ($categories === false) {
                $categoriesQuery = CategoryL1::find()
                ->where("active = 1")
                ->andWhere("visible = 1");

                if ($this -> random === true) {
                    $ids = CategoryL1::find()->
                    select('id')
                    ->where("active = 1 AND visible = 1")
                    ->all();
                    
                    $ids_indexes = array_rand($ids, $this -> limit ? $this -> limit : count($ids));
        
                    $ids_new = [];
                    foreach ($ids_indexes as $i) {
                        $ids_new[] = $ids[$i] -> id;
                    }
        
                    $categoriesQuery->andWhere('id in(' . implode(',',$ids_new) . ')');
                }
        
                if ($this -> limit > 0) $categoriesQuery = $categoriesQuery->limit($this -> limit);
                
                $categories = $categoriesQuery->all();

                Yii::$app->cache->set($this -> cache_key, $categories, 6 * 60 * 60);
            }
        }
        
        return $this -> render('category_card', [
            'view'       => $this -> view,
            'categories' => $categories,
            'parent'     => $this -> parent
        ]);
    }
}