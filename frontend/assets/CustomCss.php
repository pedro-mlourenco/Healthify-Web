<?php

namespace frontend\assets;
use yii\web\AssetBundle;

class CustomCss extends AssetBundle {
    public $sourcePath = '@frontend/web/css';
    public $css = [
        'frontend/web/css/customCss.css',
    ];
}

class CustomJs extends AssetBundle
{
    public $sourcePath = '@frontend/web/js';
    public $js = [
        'frontend/web/css/customJs.js',
    ];
}

class CustomImg extends AssetBundle
{
    public $sourcePath = '@frontend/web/img';
}