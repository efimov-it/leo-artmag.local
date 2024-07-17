<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Brands".
 *
 * @property int $id
 * @property string $name
 * @property string $geo
 * @property string $lang_key
 * @property int $main_id
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'permalink', 'logo', 'description', 'lang_key', 'main_id', 'refs_id', 'active', 'visible'], 'required'],
            [['main_id', 'refs_id', 'active', 'visible'], 'integer'],
            [['name', 'permalink'], 'string', 'max' => 150],
            [['logo'], 'string', 'max' => 255],
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
            'logo' => 'Logo',
            'description' => 'Description',
            'lang_key' => 'Lang key',
            'main_id' => 'Main ID',
            'refs_id' => 'Refs ID',
            'active' => 'Active',
            'visible' => 'Visible'
        ];
    }
}
