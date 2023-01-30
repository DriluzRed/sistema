<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 21/09/2018
 * Time: 11:38
 */

namespace backend\assets;

use yii\web\AssetBundle;

class NumberFormatAsset extends AssetBundle
{
    public $sourcePath = '@vendor/jquery-number-master';
    public $css = [
    ];
    public $js = [
        'jquery.number.js',
    ];
    public $depends = [
    ];
}