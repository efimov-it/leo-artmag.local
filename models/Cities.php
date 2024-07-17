<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property string $geo
 * @property string $lang_key
 * @property int $main_id
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'geo', 'lang_key'], 'required'],
            [['main_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['geo'], 'string', 'max' => 30],
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
            'geo' => 'Geo',
            'lang_key' => 'Lang Key',
            'main_id' => 'Main ID',
        ];
    }
}
