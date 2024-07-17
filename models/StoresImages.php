<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stores_images".
 *
 * @property int $id
 * @property string $url
 * @property int $store_id
 */
class StoresImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stores_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id, store_id'], 'integer'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'URL',
            'store_id' => 'Store ID'
        ];
    }
}