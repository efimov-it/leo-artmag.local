<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Goods images".
 *
 * @property int $id
 * @property string $name
 * @property string $geo
 * @property string $lang_key
 * @property int $main_id
 */
class GoodsImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['good_id','url'], 'required'],
            
            [['good_id'], 'integer'],

            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'good_id' => 'Good ID'
        ];
    }
}
