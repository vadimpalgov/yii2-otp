<?php


namespace vadimpalgov\yii2otp\components;

interface SenderInterface
{
    public function send($phone,$otp);

}