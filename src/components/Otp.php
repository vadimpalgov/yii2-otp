<?php

namespace vadimpalgov\yii2otp\components;

use yii\base\Component;

class Otp extends Component
{
    /**
     * @var int
     */
    public $otp_length = 4;

    /**
     * @var string
     */
    public $otp_name_hash = 'otp_hash';

    /**
     * @var bool
     */
    public $remove_otp_after_use = true;

    /**
     * @var string
     */
    public $sendOtpClass = 'vadimpalgov\yii2otp\components\FakeSendOtp';

    /**
     * @param $phone
     * @throws \yii\base\InvalidConfigException
     */
    public function send($phone)
    {

        $otp = $this->generate();

        /** @var SenderInterface $sender */
        $sender = \Yii::createObject($this->sendOtpClass);

        $result = $sender->send($phone, $otp);

        if ($result) {
            $hash = sha1($phone . $otp);
            \Yii::$app->session->set($this->otp_name_hash, $hash);
            return ['status' => true, 'otp' => $otp];
        }

        return ['status' => false];
    }

    /**
     * @param $phone string
     * @param $otp string
     * @return bool[]|false[]
     */
    public function check($phone, $otp)
    {
        $otp_hash = \Yii::$app->session->get($this->otp_name_hash,false);

        if(!$otp_hash){
            return ['status' => false, 'error' => 'Otp is not found'];
        }

        $hash  = sha1($phone . $otp);

        if($hash === $otp_hash){
            $result = ['status'=> true];

            if($this->remove_otp_after_use) {
                \Yii::$app->session->remove($this->otp_name_hash);
            }

        } else {
            $result = ['status'=> false, 'error' => 'Otp does not match'];
        }

        return $result;
    }

    /**
     * @return string
     */
    private function generate()
    {
        $chars = array_merge(range(0,9));
        shuffle($chars);

        return implode(array_slice($chars, 0, $this->otp_length));
    }
}