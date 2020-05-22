<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "point".
 *
 * @property int $point_id
 * @property string|null $point_name
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int|null $user_id
 *
 * @property User $user
 */
class Point extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'point';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'default', 'value' => User::getUserId()],
            [['point_name', 'latitude', 'longitude'], 'required'],
            [['point_name'], 'string'],
            [[ 'latitude'], 'double' , 'min' => -90,  'max' => 90],
            [[ 'longitude'], 'double' , 'min' => -180,  'max' => 180],
           // [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],        
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'point_id' => 'ID точки',
            'point_name' => 'Название точки',
            'latitude' => 'Широта',
            'longitude' => 'Долгота',
            'user_id' => 'Пользователь',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
    public function getAll()
    {
        $query = Point::find()->orderby(['point_id'=>SORT_DESC])->where(['user_id' => User::getUserId()]);
        $count = $query->count();
        $points = $query->all();
        $data['points'] = $points;        
        return $data;
    }
}
