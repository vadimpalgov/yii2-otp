<?php

namespace vadimpalgov\yii2otp\components;

use yii\base\Component;

class OtpAuth extends Component
{
    public $otp_length = 4;

    public $sendOtpClass = 'vadimpalgov\yii2otp\components\TestSendOtp';

    public function send_otp($phone)
    {

    }

    public function check_otp($phone, $otp_code)
    {

    }
}