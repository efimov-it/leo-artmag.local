<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stores".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $shedule
 * @property string $phone
 * @property string $email
 * @property string $geo
 * @property string $isOpened
 * @property string $lang_key
 * @property int $main_id
 * @property int $city_id
 */
class Stores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[], 'required'],
            [['main_id, city_id', 'isOpened'], 'integer'],
            [['name', 'address', 'shedule'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 100],
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
            'address' => 'Address',
            'shedule' => 'Shedule',
            'phone' => 'Phone',
            'email' => 'Email',
            'isOpened' => 'Is opened',
            'geo' => 'Geo',
            'lang_key' => 'Lang Key',
            'main_id' => 'Main ID',
            'city_id' => 'City ID',
        ];
    }
}