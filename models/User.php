<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string|null $login
 * @property string|null $password
 *
 * @property Point[] $points
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'string', 'max' => 255],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }
    public static function findIdentity($user_id)
    {
        return User::findOne($user_id);
    }
    public function getId()
    {
        return $this->user_id;
    }
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }
    /**
     * Gets query for [[Points]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPoints()
    {
        return $this->hasMany(Point::className(), ['user_id' => 'user_id']);
    }
    public function create()
    {
        return $this->save(false);
    }
    public static function findByLogin($login)
    {
        return User::find()->where(['login'=>$login])->one();
    }
    public function validatePassword($password)
    {
        return ($this->password == $password) ? true : false;
    }
    public static function getUserId(){
        return Yii::$app->user->identity->user_id;
    }
    
}
