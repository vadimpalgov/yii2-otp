<?php

namespace vadimpalgov\yii2otp\components;

use yii\base\Component;

class FakeSendOtp extends Component implements SenderInterface
{
    public function send($phone, $otp)
    {
        return true;
    }

}