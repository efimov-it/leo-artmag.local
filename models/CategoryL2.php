<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Category 2nd level".
 *
 * @property int $id
 * @property string $name
 * @property string $geo
 * @property string $lang_key
 * @property int $main_id
 */
class CategoryL2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_l2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_id', 'refs_id', 'title', 'permalink', 'img', 'parent_id', 'lang_key'], 'required'],
            [['main_id', 'refs_id', 'parent_id'], 'integer'],
            [['title', 'permalink'], 'string', 'max' => 150],
            [['img'], 'string', 'max' => 255],
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
            'permalink' => 'Permalink',
            'img' => 'Image',
            'parent_id' => 'Parent ID',
            'lang_key' => 'Lang Key',
            'main_id' => 'Main ID',
            'refs_id' => 'Refs ID',
        ];
    }
}