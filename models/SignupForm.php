<?php
namespace app\models;
use yii\base\Model;
class SignupForm extends Model
{
    public $login;
    public $password;
    
    public function rules()
    {
        return [
            [['login','password'], 'required'],
        ];
    }
    
    public function signup()
    {
        if($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }
}