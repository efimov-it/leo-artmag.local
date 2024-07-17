<?php

namespace app\controllers;

use app\models\Brands;
use app\models\CategoryL1;
use app\models\CategoryL2;
use app\models\CategoryL3;
use app\models\Cities;
use app\models\Goods;
use app\models\GoodsImages;
use app\models\Stores;
use app\models\StoresImages;
use stdClass;
use Yii;
use yii\base\View;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Главная страница
     *
     * @return string
     */
    public function actionIndex()
    {
        $newProductsIds = [];
        
        $tmpProducts = Yii::$app->cache->get('main_page_new_products_group');
        if ($tmpProducts === false) {
            $tmpProducts = Goods::find()
            ->select('group_id, last_update')
            ->where('price > 0')
            ->orderBy('last_update desc')
            ->groupBy('group_id, last_update')
            ->limit(12)
            ->all();

            Yii::$app->cache->set('main_page_new_products_group', $tmpProducts, 6 * 60 * 60);
        }

        foreach($tmpProducts as $i => $product) {
            $product_tmp = Yii::$app->cache->get('main_page_new_products_'.$i);
            if ($product_tmp === false) {
                $product_tmp = Goods::find()
                ->select('id')
                ->where('group_id = ' . $product -> group_id)
                ->andWhere('price > 0')->one();
                
                Yii::$app->cache->set('main_page_new_products_'.$i, $product_tmp, 6 * 60 * 60);
            }
            $newProductsIds[] = $product_tmp -> id;
        }

        $discountProductsIds = [290095, 290100, 290102, 290112, 290123, 290126];

        $creativity_ids = [76,84,87,94,96];
        $creativityProductsIds = [];

        $creativityTmp = Yii::$app->cache->get('main_page_creativity_products_group');
        if ($creativityTmp === false) {
            $creativityTmp = Goods::find()
            ->select('group_id')
            ->where('category_l1_id in('.implode(',',$creativity_ids).')')
            ->andWhere('price > 0')
            ->groupBy('group_id')
            ->asArray()
            ->all();

            Yii::$app->cache->set('main_page_creativity_products_group', $creativityTmp, 6 * 60 * 60);
        }

        $arrayPos = array_rand($creativityTmp, 12);
        
        foreach ($arrayPos as $i) {
            $product_tmp = Yii::$app->cache->get('main_page_creativity_products_'.$i);
            if ($product_tmp === false) {
                $product_tmp = Goods::find()
                ->select('id')
                ->where('group_id = ' . $creativityTmp[$i]['group_id'])
                ->one();

                Yii::$app->cache->set('main_page_creativity_products_'.$i, $product_tmp, 6 * 60 * 60);
            }
            $creativityProductsIds[] = $product_tmp -> id;
        }

        $stationery_ids = [79,85,86];
        $stationeryProductsIds = [];
        $stationeryTmp = Yii::$app->cache->get('main_page_stationery_group');
        if ($stationeryTmp === false) {
            $stationeryTmp = Goods::find()
            ->select('group_id')
            ->where('category_l1_id in('.implode(',',$stationery_ids).')')
            ->andWhere('price > 0')
            ->groupBy('group_id')
            ->asArray()
            ->all();

            Yii::$app->cache->set('main_page_stationery_group', $stationeryTmp, 6 * 60 * 60);
        }

        $arrayPos = array_rand($stationeryTmp, 12);
        
        foreach ($arrayPos as $i) {
            $product_tmp = Yii::$app->cache->get('main_page_stationery_'.$i);
            if ($product_tmp === false) {
                $product_tmp = Goods::find()
                ->select('id')
                ->where('group_id = ' . $stationeryTmp[$i]['group_id'])
                ->andWhere('price > 0')->one();

                Yii::$app->cache->set('main_page_stationery_'.$i, $product_tmp, 6 * 60 * 60);
            }
            $stationeryProductsIds[] = $product_tmp -> id;
        }


        
        $interestingProductsIds = [];
        $interestingTmp = Yii::$app->cache->get('main_page_interesting');
        if ($interestingTmp === false) {
            $interestingTmp = Goods::find()
            ->select('id')
            ->where('price > 0')
            ->asArray()
            ->all();

            Yii::$app->cache->set('main_page_interesting', $interestingTmp, 6 * 60 * 60);
        }

        $arrayPos = array_rand($interestingTmp, 20);
        
        foreach ($arrayPos as $i) {
            $interestingProductsIds[] = $interestingTmp[$i]['id'];
        }

        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('index', [
            'baseData' => self::getBaseData(),
            'newProductsIds' => $newProductsIds,
            'discountProductsIds' => $discountProductsIds,
            'creativityProductsIds' => $creativityProductsIds,
            'stationeryProductsIds' => $stationeryProductsIds,
            'interestingProductsIds' => $interestingProductsIds
        ]);
    }

    /**
     * Основная страница каталога
     *
     * @return string
     */
    public function actionCatalog()
    {
        // Yii::$app->cache->flush();
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('catalog', [

        ]);
    }

    /**
     * Страница основной категории
     *
     * @return string
     */
    public function actionCategory1($cat_1)
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        $category = Yii::$app->cache->get('category1_category_' . $cat_1);
        if ($category === false) {
            $category = CategoryL1::find()
            ->where('permalink like \''.$cat_1.'\'')
            ->one();

            Yii::$app->cache->set('category1_category_' . $cat_1, $category, 6 * 60 * 60);
        }

        $child_categories = Yii::$app->cache->get('category1_categories_'. $category -> id);
        if ($child_categories === false) {
            $child_categories = CategoryL2::find()
            ->join('left join', '{{%goods}}', '{{%category_l2}}.id = category_l2_id')
            ->join('left join', '{{%brands}}', '{{%goods}}.brand_id = {{%brands}}.id')
            ->where('{{%brands}}.active = 1')
            ->andWhere('{{%brands}}.visible = 1')
            ->andWhere('{{%category_l2}}.active = 1')
            ->andWhere('{{%category_l2}}.visible = 1')
            ->andWhere('parent_id = ' . $category -> id)
            ->groupBy('{{%category_l2}}.id')
            ->having('count({{%goods}}.id) > 0')
            ->all();

            Yii::$app->cache->set('category1_categories_'. $category -> id, $child_categories, 6 * 60 * 60);
        }

        $brands = Yii::$app->cache->get('category1_brands_'. $category -> id);
        if ($brands === false) {
            $brands = Brands::find()->join('left join', '{{%goods}}', '{{%brands}}.id = brand_id')
            ->where('active = 1 AND visible = 1 AND category_l1_id = ' . $category -> id)
            ->all();

            Yii::$app->cache->set('category1_brands_'. $category -> id, $brands, 6 * 60 * 60);
        }

        $goods_tmp = Yii::$app->cache->get('category1_goods_'. $category -> id);
        
        if ($goods_tmp === false) {
            $goods_tmp = Goods::find()->select('{{%goods}}.id')
            ->join('left join', '{{%brands}}', 'brand_id = {{%brands}}.id')
            ->where('active = 1')
            ->andWhere('visible = 1')
            ->andWhere('price > 0')
            ->andWhere('category_l1_id = ' . $category -> id)
            ->asArray()
            ->all();

            Yii::$app->cache->set('category1_goods_'. $category -> id, $goods_tmp, 6 * 60 * 60);
        }

        $goods_ids = [];
        $count = count($goods_tmp) > 32 ? 32 : count($goods_tmp);
        $rand_goods = array_rand($goods_tmp, $count);
        foreach ($rand_goods as $i) {
            $goods_ids[] = $goods_tmp[$i]['id'];
        }

        return $this->render('category1', [
            'category'         => $category,
            'child_categories' => $child_categories,
            'brands'           => $brands,
            'goods_ids'        => $goods_ids
        ]);
    }

    /**
     * Страница подкатегории
     *
     * @return string
     */
    public function actionCategory2($cat_1, $cat_2, $cat_3 = null)
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if (!is_numeric($page)) $page = 1;

        $goodsCountOnPage = 32;

        $root = Yii::$app->cache->get('category2_l1_' . $cat_1);
        if ($root === false) {
            $root = CategoryL1::find()
            ->where('permalink like \'' . $cat_1 . '\'')
            ->one();

            Yii::$app->cache->set('category2_l1_' . $cat_1, $root, 6 * 60 * 60);
        }

        $category = Yii::$app->cache->get('category2_l2_' . $cat_2);
        if ($category === false) {
            $category = CategoryL2::find()
            ->where('permalink like \'' . $cat_2 . '\'')
            ->one();

            Yii::$app->cache->set('category2_l2_' . $cat_2, $category, 6 * 60 * 60);
        }

        $subCategories = Yii::$app->cache->get('category2_l3_' . $category -> id);
        if ($subCategories === false) {
            $subCategories = CategoryL3::find()
            ->join('left join', '{{%goods}}', '{{%category_l3}}.id = category_l3_id')
            ->join('left join', '{{%brands}}', '{{%goods}}.brand_id = {{%brands}}.id')
            ->where('{{%brands}}.active = 1')
            ->andWhere('{{%brands}}.visible = 1')
            ->andWhere('parent_id = ' . $category -> id)
            ->andWhere('parent_id = ' . $category -> id)
            ->groupBy('{{%category_l3}}.id')
            ->having('count({{%goods}}.id) > 0')
            ->all();

            Yii::$app->cache->set('category2_l3_' . $category -> id, $subCategories, 6 * 60 * 60);
        }
        
        if ($cat_3) {
            $subCategory = Yii::$app->cache->get('category2_sub_category_'.$cat_3);
            if ($subCategory === false) {
                $subCategory = CategoryL3::find()
                ->join('left join', '{{%goods}}', '{{%category_l3}}.id = category_l3_id')
                ->join('left join', '{{%brands}}', '{{%goods}}.brand_id = {{%brands}}.id')
                ->where('{{%brands}}.active = 1')
                ->andWhere('{{%brands}}.visible = 1')
                ->andWhere('{{%category_l3}}.permalink like \'' . $cat_3 . '\'')
                ->groupBy('{{%category_l3}}.id')
                ->having('count({{%goods}}.id) > 0')->one();

                Yii::$app->cache->set('category2_sub_category_'.$cat_3, $subCategory, 6 * 60 * 60);
            }

            $goodsCount = Yii::$app->cache->get('category2_goods_count_l3_' . $subCategory -> id);
            if ($goodsCount === false) {
                $goodsCount = Goods::find()
                ->join('left join', '{{%brands}}', 'brand_id = {{%brands}}.id')
                ->where('active = 1')
                ->andWhere('visible = 1')
                ->andWhere('category_l3_id = ' . $subCategory -> id)
                ->count();

                Yii::$app->cache->set('category2_goods_count_l3_' . $subCategory -> id, $goodsCount, 6 * 60 * 60);
            }

            if ($goodsCount > 0) {
                $gooodsIds = Yii::$app->cache->get('category2_goods_l3_' . $subCategory -> id . '_page_' . $page);
                if ($gooodsIds === false) {
                    $gooodsIds = Goods::find()
                    ->select('{{%goods}}.id')
                    ->join('left join', '{{%brands}}', 'brand_id = {{%brands}}.id')
                    ->where('active = 1')
                    ->andWhere('visible = 1')
                    ->andWhere('category_l3_id = ' . $subCategory -> id)
                    ->andWhere('price > 0')
                    ->offset(($page - 1) * $goodsCountOnPage)
                    ->limit($goodsCountOnPage)
                    ->all();

                    Yii::$app->cache->set('category2_goods_l3_' . $subCategory -> id . '_page_' . $page, $gooodsIds, 60 * 60);
                }
            }
        }
        else {
            $subCategory = null;
            
            $goodsCount = Yii::$app->cache->get('category2_goods_count_l2_' . $category -> id);
            if ($goodsCount === false) {
                $goodsCount = Goods::find()
                ->join('left join', '{{%brands}}', 'brand_id = {{%brands}}.id')
                ->where('active = 1')
                ->andWhere('visible = 1')
                ->andWhere('category_l2_id = ' . $category -> id)
                ->andWhere('price > 0')->count();

                Yii::$app->cache->set('category2_goods_count_l2_' . $category -> id, $goodsCount, 6 * 60 * 60);
            }
            
            if ($goodsCount > 0) {
                $gooodsIds = Yii::$app -> cache -> get ('category2_goods_l2_' . $category -> id . '_page_' . $page);
                if ($gooodsIds === false) {
                    $gooodsIds = Goods::find()
                    ->select('{{%goods}}.id')
                    ->join('left join', '{{%brands}}', 'brand_id = {{%brands}}.id')
                    ->where('active = 1')
                    ->andWhere('visible = 1')
                    ->andWhere('category_l2_id = ' . $category -> id)
                    ->andWhere('price > 0')
                    ->offset(($page - 1) * $goodsCountOnPage)
                    ->limit($goodsCountOnPage)
                    ->all();

                    Yii::$app->cache->set('category2_goods_l2_' . $category -> id . '_page_' . $page, $gooodsIds, 60 * 60);
                }
            }
        }

        $gooods = [];
        
        if ($goodsCount > 0) {
            foreach ($gooodsIds as $good) {
                $gooods[] = $good -> id;
            }
        }

        $pagination = [];
        for ($i = 1; $i <= ceil($goodsCount / $goodsCountOnPage); $i++) { 
            $pagination[] = $i;
        }

        return $this->render('category2', [
            'root'          => $root,
            'category'      => $category,
            'subCategory'   => $subCategory,
            'subCategories' => $subCategories,
            'goodsCount'    => $goodsCount,
            'goods'         => $gooods,
            'currentUrl'    => '',
            'pagination'    => $pagination
        ]);
    }

    /**
     * Основная страница брендов
     *
     * @return string
     */
    public function actionBrands()
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('brands', [

        ]);
    }

    /**
     * Страница бренда
     *
     * @return string
     */
    public function actionBrand($name)
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if (!is_numeric($page)) $page = 1;

        $goodsCountOnPage = 32;

        $brand = Yii::$app->cache->get('brand_page_info_' . $name);
        if ($brand === false) {
            $brand = Brands::find()
            ->where('permalink like \'' . $name . '\'')
            ->one();

            Yii::$app->cache->set('brand_page_info_' . $name, $brand, 6 * 60 * 60);
        }
        
        $goodsCount = Yii::$app->cache->get('brand_page_goods_count_' . $brand -> id);
        if ($goodsCount === false) {
            $goodsCount = Goods::find()
            ->andWhere('brand_id = ' . $brand -> id)
            ->andWhere('price > 0')->count();

            Yii::$app->cache->set('brand_page_goods_count_' . $brand -> id, $goodsCount, 6 * 60 * 60);
        }
        
        if ($goodsCount > 0) {
            $gooodsIds = Yii::$app -> cache -> get ('brand_page_goods_' . $brand -> id . '_page_' . $page);
            if ($gooodsIds === false) {
                $gooodsIds = Goods::find()
                ->select('id')
                ->where('brand_id = ' . $brand -> id)
                ->andWhere('price > 0')
                ->offset(($page - 1) * $goodsCountOnPage)
                ->limit($goodsCountOnPage)
                ->all();

                Yii::$app->cache->set('brand_page_goods_' . $brand -> id . '_page_' . $page, $gooodsIds, 60 * 60);
            }
        }

        $gooods = [];
        
        if ($goodsCount > 0) {
            foreach ($gooodsIds as $good) {
                $gooods[] = $good -> id;
            }
        }

        $pagination = [];
        for ($i = 1; $i <= ceil($goodsCount / $goodsCountOnPage); $i++) { 
            $pagination[] = $i;
        }

        return $this->render('brand', [
            'brand'      => $brand,
            'goodsCount' => $goodsCount,
            'goods'      => $gooods,
            'currentUrl' => '',
            'pagination' => $pagination
        ]);
    }

    /**
     * Страница товара
     *
     * @return string
     */
    public function actionGood($cat_1, $cat_2, $good_id, $good_name = null)
    {
        $this -> view -> params['baseData'] = self::getBaseData();
        $this -> view -> params['hideHeaderSearchOnMob'] = true;
        // $this -> view -> params['css'] = [
        //     "https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
            
        // ];
        // $this -> view -> params['js'] = [
        //     "https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"
            
        // ];

        
        $root = Yii::$app->cache->get('category2_l1_' . $cat_1);
        if ($root === false) {
            $root = CategoryL1::find()
            ->where('permalink like \'' . $cat_1 . '\'')
            ->one();

            Yii::$app->cache->set('category2_l1_' . $cat_1, $root, 6 * 60 * 60);
        }

        $category = Yii::$app->cache->get('category2_l2_' . $cat_2);
        if ($category === false) {
            $category = CategoryL2::find()
            ->where('permalink like \'' . $cat_2 . '\'')
            ->one();

            Yii::$app->cache->set('category2_l2_' . $cat_2, $category, 6 * 60 * 60);
        }

        $good = Yii::$app->cache->get('good_page_' . $good_id);
        if ($good === false) {
            $good = Goods::find()
            ->where('id = ' . $good_id . '')
            ->one();

            Yii::$app->cache->set('good_page_' . $good_id, $good, 1 * 60 * 60);
        }
        
        $goods_group = Yii::$app->cache->get('good_page_group_' . $good_id);
        if ($goods_group === false) {
            $goods_group = Goods::find()
            ->where('group_id = ' . $good -> group_id)
            ->all();

            Yii::$app->cache->set('good_page_group_' . $good_id, $goods_group, 1 * 60 * 60);
        }
        
        $goods_images = Yii::$app->cache->get('good_page_images_' . $good_id);
        if ($goods_images === false) {
            $goods_images = GoodsImages::find()
            ->where('good_id = ' . $good_id)
            ->all();

            Yii::$app->cache->set('good_page_images_' . $good_id, $goods_images, 1 * 60 * 60);
        }
        
        $good_brand = Yii::$app->cache->get('good_page_brand_' . $good_id);
        if ($good_brand === false) {
            $good_brand = Brands::find()
            ->where('id = ' . $good -> brand_id)
            ->one();

            Yii::$app->cache->set('good_page_brand_' . $good_id, $good_brand, 1 * 60 * 60);
        }

        return $this->render('good', [
            'id'       => $good_id,
            'root'     => $root,
            'category' => $category,
            'good'     => $good,
            'group'    => $goods_group,
            'images'   => $goods_images,
            'brand'    => $good_brand
        ]);
    }

    /**
     * Страница поиска
     *
     * @return string
     */
    public function actionSearch()
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if (!is_numeric($page)) $page = 1;

        $goodsCountOnPage = 32;

        $searchText = Yii::$app->request->get('q', '');
        
        $goodsCount = Goods::find()
        ->join('left join', '{{%brands}}', 'brand_id = {{%brands}}.id')
        ->where('LOWER({{%goods}}.name) LIKE LOWER(\'%' . $searchText . '%\') OR LOWER({{%goods}}.description) LIKE LOWER(\'%' . $searchText . '%\')')
        ->andWhere('visible = 1')
        ->andWhere('active = 1')
        ->andWhere('price > 0')->count();

        if ($goodsCount > 0) {
            $gooodsIds = Goods::find()
            ->select('{{%goods}}.id')
            ->join('left join', '{{%brands}}', 'brand_id = {{%brands}}.id')
            ->where('LOWER({{%goods}}.name) LIKE LOWER(\'%' . $searchText . '%\') OR LOWER({{%goods}}.description) LIKE LOWER(\'%' . $searchText . '%\')')
            ->andWhere('visible = 1')
            ->andWhere('active = 1')
            ->andWhere('price > 0')->offset(($page - 1) * $goodsCountOnPage)
            ->limit($goodsCountOnPage)
            ->all();
        }

        $gooods = [];
        
        if ($goodsCount > 0) {
            foreach ($gooodsIds as $good) {
                $gooods[] = $good -> id;
            }
        }

        $pagination = [];
        for ($i = 1; $i <= ceil($goodsCount / $goodsCountOnPage); $i++) { 
            $pagination[] = $i;
        }

        return $this->render('search', [
            'goodsCount'  => $goodsCount,
            'goods'       => $gooods,
            'searchText' => $searchText,
            'currentUrl'  => '',
            'pagination'  => $pagination
        ]);
    }

    /**
     * Страница корзины
     *
     * @return string
     */
    public function actionCart()
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('cart', [

        ]);
    }

    /**
     * Страница оформления заказа
     *
     * @return string
     */
    public function actionCheckout()
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('checkout', [

        ]);
    }

    /**
     * Страница профиля
     *
     * @return string
     */
    // public function actionProfile()
    // {
    //     $this -> view -> params['baseData'] = self::getBaseData();

    //     return $this->render('profile', [

    //     ]);
    // }

    /**
     * Страница cмены пароля
     *
     * @return string
     */
    // public function actionNew_password($key)
    // {
    //     $this -> view -> params['baseData'] = self::getBaseData();

    //     return $this->render('newPassword', []);
    // }

    /**
     * Страница заказов
     *
     * @return string
     */
    // public function actionOrders()
    // {
    //     $this -> view -> params['baseData'] = self::getBaseData();

    //     return $this->render('orders', [

    //     ]);
    // }

    /**
     * Страница заказа
     *
     * @return string
     */
    // public function actionOrder($order_id)
    // {
    //     $this -> view -> params['baseData'] = self::getBaseData();

    //     return $this->render('order', [

    //     ]);
    // }

    /**
     * Страница избранных товаров
     *
     * @return string
     */
    // public function actionFavorites()
    // {
    //     $this -> view -> params['baseData'] = self::getBaseData();

    //     return $this->render('favorites', [

    //     ]);
    // }

    /**
     * Страница акций
     *
     * @return string
     */
    public function actionActions()
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('actions', [

        ]);
    }

    /**
     * Страница акции
     *
     * @return string
     */
    public function actionAction($action_id, $name = null)
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('action', [

        ]);
    }

    /**
     * Страница раздела информации
     *
     * @return string
     */
    public function actionInfo($name = null)
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('info', [

        ]);
    }

    /**
     * Страница приложения
     *
     * @return string
     */
    public function actionApp()
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('app', [

        ]);
    }

    /**
     * Страница контактов
     *
     * @return string
     */
    public function actionContacts()
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('contacts', [

        ]);
    }

    /**
     * Страница франшизы
     *
     * @return string
     */
    public function actionFranchise()
    {
        $this -> view -> params['baseData'] = self::getBaseData();

        return $this->render('franchise', [

        ]);
    }



    /**
     * Базовые данные для сайта
     *
     * @return array
     */
    private function getBaseData ()
    {
        // Yii::$app->cache->flush();
        // die();
        $lang = 'ru';

        $cities = Yii::$app->cache->get('cities');
        if ($cities === false) {
            $cities = Cities::find()
            ->where("lang_key like '$lang'")
            ->all();

            Yii::$app->cache->set('cities', $cities, 7 * 24 * 60 * 60);
        }

        $shopList = Yii::$app->cache->get('shopList');

        if ($shopList === false) {
            $shopsList = [];

            foreach ($cities as $city) {
                $tmpCity = new stdClass();

                $tmpCity -> id = $city -> main_id;
                $tmpCity -> name = $city -> name;
                $tmpCity -> geo = json_decode($city -> geo);
                $tmpCity -> shops = [];

                $stores = Stores::find()
                ->where("lang_key like '$lang' AND city_id = " . $city -> id)
                ->all();
                
                $tmpCity -> count = count($stores);

                foreach ($stores as $store) {
                    $shop = new stdClass();

                    $shop -> id       = $store -> main_id;
                    $shop -> name     = $store -> name;
                    $shop -> address  = $store -> address;
                    $shop -> shedule  = json_decode($store -> shedule);
                    $shop -> phone    = $store -> phone;
                    $shop -> email    = $store -> email;
                    $shop -> geo      = json_decode($store -> geo);
                    $shop -> isOpened = $store -> isOpened;
                    $shop -> cityid   = $store -> city_id;

                    $tmpCity -> shops[] = $shop;
                    
                    $images = Yii::$app->cache->get('stores_images');
                    if ($images === false) {
                        $images = StoresImages::find()
                        ->where("store_id = " . $store -> main_id)
                        ->all();

                        Yii::$app->cache->set('stores_images', $images, 24 * 60 * 60);
                    }

                    $shop -> images = [];

                    foreach ($images as $image) {
                        $shop -> images[] = $image -> url;
                    }
                }

                $shopsList[] = $tmpCity;
            }
            
            Yii::$app->cache->set('shopList', $shopList, 24 * 60 * 60);
        }

        $cityName = '';
        $shopAddress = '';
        $phone = '';
        
        $currentShop = isset($_COOKIE['shopid']) ? intval($_COOKIE['shopid']) : 1;
        $currentCity = isset($_COOKIE['cityid']) ? intval($_COOKIE['cityid']) : 1;
        
        foreach ($shopsList as $city) {
            if ($city -> id === $currentCity) $cityName = $city -> name;
        
            foreach ($city -> shops as $shop) {
                if ($shop -> id === $currentShop) {
                    $shopAddress = $shop -> address;
                    $phone = $shop -> phone;
                }
            }
        }


        // Формирование каталога
        $categories = Yii::$app->cache->get('main_catalog');
        if ($categories === false) {
            $categories = CategoryL1::find()
            ->all();

            Yii::$app->cache->set('main_catalog', $categories, 24 * 60 * 60);
        }
        
        $catalog = [];

        foreach ($categories as $category) {
            $tmpCategory = [];

            $tmpCategory['title'] = $category -> title;
            $tmpCategory['icon'] = $category -> icon;
            $tmpCategory['permalink'] = $category -> permalink;

            $tmpCategory['child'] = [];

            $categories2 = Yii::$app->cache->get('main_catalog_l2_' . $category->id);
            if ($categories2 === false) {
                $categories2 = CategoryL2::find()
                ->where('parent_id = ' . $category->id)
                ->all();

                Yii::$app->cache->set('main_catalog_l2_' . $category->id, $categories2, 24 * 60 * 60);
            }

            foreach ($categories2 as $category2) {
                $tmpCategory2 = [];

                $tmpCategory2['title'] = $category2 -> title;
                $tmpCategory2['icon'] = '';
                $tmpCategory2['permalink'] = $category2 -> permalink;
    
                $tmpCategory2['child'] = [];

                $categories3 = Yii::$app->cache->get('main_catalog_l3_' . $category2->id);
                if ($categories3 === false) {
                    $categories3 = CategoryL3::find()
                    ->where('parent_id = ' . $category2->id)
                    ->all();

                    Yii::$app->cache->set('main_catalog_l3_' . $category2->id, $categories3, 24 * 60 * 60);
                }

                foreach ($categories3 as $category3) {
                    $tmpCategory3 = [];
    
                    $tmpCategory3['title'] = $category3 -> title;
                    $tmpCategory3['icon'] = '';
                    $tmpCategory3['permalink'] = $category3 -> permalink;
                    $tmpCategory3['child'] = [];
        
                    $tmpCategory2['child'][] = $tmpCategory3;
                }

                $tmpCategory['child'][] = $tmpCategory2;
            }

            $catalog[] = $tmpCategory;
        }

        return [
            'shopsList'   => $shopsList,
            'currentShop' => $currentShop,
            'currentCity' => $currentCity,
            'cityName'    => $cityName,
            'shopAddress' => $shopAddress,
            'phone'       => $phone,
            'catalog'     => $catalog
        ];
    }
}
