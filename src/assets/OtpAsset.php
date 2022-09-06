<?php

namespace vadimpalgov\yii2otp\assets;

use yii\web\AssetBundle;

class OtpAsset extends AssetBundle
{
    public $sourcePath = '@vendor/vadimpalgov/yii2-otp/src/public';

    public $js = [
        'js/otp.js'
    ];

    public $depends = [
      'sfmobile\vueapp\assets\axios\AxiosAsset'
    ];
}