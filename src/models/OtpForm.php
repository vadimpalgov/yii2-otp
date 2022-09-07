<?php

namespace vadimpalgov\yii2otp\models;

use yii\base\Model;

/**
 * Class OtpForm
 * @package vadimpalgov\yii2otp\models
 */
class OtpForm extends Model
{
    public $phone;

    public $otp;

    public function rules()
    {
        return [
            ['phone','required'],
            [['phone','otp'], 'string']
        ];
    }

    public function send()
    {
        $sending = \Yii::$app->otp->send($this->phone);

        if ($sending['status']) {
            $result['status'] = true;

            if (YII_ENV_DEV) {
                $result['otp'] = $sending['otp'];
            }

        } else {
            $result['status'] = false;
        }

        return $result;
    }

    public function check()
    {
        return \Yii::$app->otp->check($this->phone, $this->otp);
    }
}