<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/_all-skins.min.css',
        'css/AdminLTE.min.css', 
        'css/bootstrap.min.css', 
    ];
    public $js = [
        'js/main.js',
        'js/ajax_submit.js',
        'js/assessment.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
