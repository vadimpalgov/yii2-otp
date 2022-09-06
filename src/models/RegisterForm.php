<?php


namespace vadimpalgov\yii2otp\models;

use yii\base\Model;

class RegisterForm extends Model
{
    public $username;

    public $email;

    public $phone;

    public $otp_code;

    public function rules()
    {
        return [
            [['username', 'email', 'phone'], 'required'],
            ['email','email'],
            ['otp_code', 'string', 'length' => \Yii::$app->otpAuth->otp_length]
        ];
    }

    public function sendOtp()
    {

    }

    public function checkOtp()
    {

    }
}