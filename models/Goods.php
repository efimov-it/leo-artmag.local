<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Goods".
 *
 * @property int $id
 * @property string $name
 * @property string $geo
 * @property string $lang_key
 * @property int $main_id
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','permalink','description','price','category_l1_id','category_l2_id','category_l3_id','brand_id','group_id','lang_key','main_id','refs_id'], 'required'],
            
            [['category_l1_id','category_l2_id','category_l3_id','brand_id','group_id','main_id','refs_id'], 'integer'],
            [['price','old_price'], 'float'],

            [['name', 'permalink', 'description'], 'string'],
            [['lang_key'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'permalink' => 'Permalink',
            'description' => 'Description',
            'price' => 'Price',
            'discount' => 'Discount',
            'old_price' => 'Old price',
            'category_l1_id' => 'Category (l1) ID',
            'category_l2_id' => 'Category (l2) ID',
            'category_l3_id' => 'Category (l3) ID',
            'brand_id' => 'Brand ID',
            'group_id' => 'Group ID',
            'lang_key' => 'Lang Key',
            'main_id' => 'Main ID',
            'refs_id' => 'Refs ID'
        ];
    }
}
