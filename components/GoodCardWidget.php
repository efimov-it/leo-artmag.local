<?php

namespace app\components;

use Yii;
use app\models\CategoryL1;
use app\models\CategoryL2;
use app\models\CategoryL3;
use app\models\Goods;
use app\models\GoodsImages;
use yii\base\Widget;
use yii\helpers\Url;

class GoodCardWidget extends Widget {
    public $ids;
    public $view;
    public $rootCategoryIds;
    public $sortColumn;
    public $sortDirection;
    public $cache_key;

    public function init() {
        parent::init();

        if ($this -> view !== 'grid' && $this -> view !== 'row') $view = 'grid';
    }

    public function run () {

        $goodsData = false;
        if ($this -> cache_key) {
            $goodsData = Yii::$app->cache->get($this -> cache_key);
        }

        if ($goodsData === false) {
            $goods = Goods::find();
            
            if (is_array($this -> ids)) {
                if (count($this -> ids) > 0) {
                    $goods = $goods->where('id in('.implode(',',$this -> ids).')');
                }
            }

            if (is_array($this -> rootCategoryIds)) {
                if (count($this -> rootCategoryIds) > 0) {
                    $goods = $goods->where('category_l1_id in('.implode(',',$this -> rootCategoryIds).')');
                }
            }

            if (isset($this -> sortColumn) && (strtolower($this -> sortDirection) === 'asc' || (strtolower($this -> sortDirection) === 'desc'))) {
                $goods = $goods->orderBy($this -> sortColumn . ' ' . $this -> sortDirection);
            }

            $goods = $goods->asArray()->all();

            $goods = array_reverse($goods);

            $images = [];
            $permalinks = [];

            foreach ($goods as $good) {
                $images[] = GoodsImages::find()->where('good_id = ' . $good['id'])->all();

                $permalink_tmp = Url::home(true) . 'catalog';
                
                $cat1 = CategoryL1::find()->where('id = ' . $good['category_l1_id'])->all();
                if(isset($cat1[0] -> permalink)) $permalink_tmp .= '/' . $cat1[0] -> permalink;

                $cat2 = CategoryL2::find()->where('id = ' . $good['category_l2_id'])->all();
                if(isset($cat2[0] -> permalink)) $permalink_tmp .= '/' . $cat2[0] -> permalink;

                $permalink_tmp .= '/' . $good['id'] . '/' . $good['permalink'];

                $permalinks[] = $permalink_tmp;
            }

            $goodsData = [
                'goods' => $goods,
                'images' => $images,
                'permalinks' => $permalinks,
                'view' => $this -> view
            ];

            Yii::$app->cache->set($this->cache_key, $goodsData, 6 * 60 * 60);
        }

        return $this -> render('good_card', $goodsData);
    }
}