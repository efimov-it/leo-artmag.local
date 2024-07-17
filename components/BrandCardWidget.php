<?php

namespace app\components;

use Yii;
use app\models\Brands;
use yii\base\Widget;

class BrandCardWidget extends Widget {

    public $data;
    public $view;
    public $limit;
    public $random;
    public $cache_key;

    public function init() {
        parent::init();

        if ($this -> view !== 'grid' && $this -> view !== 'row') {
            $this -> view = 'grid';
        }
    }

    public function run() {
        if ($this -> data) {
            $brands = $this -> data;
        }
        else {
            $brands = false;

            if ($this -> cache_key) {
                $brands = Yii::$app->cache->get($this -> cache_key);
            }

            if ($brands === false) {
                $brandsQuery = Brands::find();
                
                $brandsQuery = $brandsQuery->where(
                    "active = 1 AND visible = 1"
                );
                
                if ($this -> random === true) {
                    $ids = Brands::find()->select('id')->where("active = 1 AND visible = 1")->all();
                    $ids_indexes = array_rand($ids, $this -> limit ? $this -> limit : count($ids));

                    $ids_new = [];
                    foreach ($ids_indexes as $i) {
                        $ids_new[] = $ids[$i] -> id;
                    }

                    $brandsQuery->andWhere('id in(' . implode(',',$ids_new) . ')');
                }

                if ($this -> limit > 0) $brandsQuery = $brandsQuery->limit($this -> limit);

                $brands = $brandsQuery->all();

                Yii::$app->cache->set($this -> cache_key, $brands, 24 * 6 * 6);
            }
        }

        return $this -> render('brand_card', [
            'view'   => $this -> view,
            'brands' => $brands
        ]);
    }
}