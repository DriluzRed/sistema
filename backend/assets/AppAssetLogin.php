<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Created by PhpStorm.
 * User: Hernan Medina
 * Date: 15/3/2017
 * Time: 10:10
 */
class AppAssetLogin extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte';
    public $css = [
        'bootstrap/css/bootstrap.min.css',
        'dist/css/AdminLTE.min.css',
        'dist/css/AdminLTE.min.css',
        'plugins/iCheck/square/blue.css',
    ];
    public $js = [
        'bootstrap/js/bootstrap.min.js',
        'plugins/iCheck/icheck.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}