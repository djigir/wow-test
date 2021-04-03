<?php

namespace app\models;

use yii\base\Model;
use Yii;

class Signup extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User'],
            ['password', 'string', 'min' => 5, 'max' => 10]
        ];
    }

    public function signUp($request_data)
    {
        $user = new User();
        $user->username = $request_data['username'];
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($request_data['password']);
        $user->save();
        Yii::$app->user->login($user);
    }
}