<?php
namespace app\models;
use yii\base\Model;
use Yii;
class SignupForm extends Model
{
    public $login;
    public $password;
    
    public function rules()
    {
        return [
            [['login','password'], 'required'],
            //['login', 'unique', 'message' => Yii::t('app', 'Этот логин занят')],
        ];
    }
    
    public function signup()
    {
        if($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->create();
            return Yii::$app->user->login($user);
        }
    }
}