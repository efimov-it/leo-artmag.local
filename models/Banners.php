<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Banners".
 *
 * @property int $id
 * @property string $name
 * @property string $geo
 * @property string $lang_key
 * @property int $main_id
 */
class Banners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_id', 'global', 'active', 'title', 'link', 'image', 'place', 'lang_key'], 'required'],
            
            [['main_id', 'global', 'active'], 'integer'],

            [['title', 'text', 'link', 'image'], 'string', 'max' => 255],
            [['link_text'], 'string', 'max' => 100],
            [['place'], 'string', 'max' => 30],
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
            'title' => 'Title',
            'link_text' => 'Link text',
            'link' => 'Link',
            'image' => 'Image',
            'place' => 'Place',
            'global' => 'Global',
            'active' => 'Active',
            'lang_key' => 'Lang Key',
            'main_id' => 'Main ID'
        ];
    }
}
