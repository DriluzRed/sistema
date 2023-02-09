<?php

namespace common\helpers;

/**
 * Created by PhpStorm.
 * User: hdmedina
 * Date: 11/4/2017
 * Time: 08:50
 */

use Yii;

/**
 * Class FlashMessageHelpsers
 * @package common
 */
class FlashMessageHelpers
{
    /**
     * Genera un mensaje tipo growl
     * @param $message // mensaje a mostrar
     * @param $type // tipo de alerta (success, default, danger)
     * @param $title // titulo del diálogo
     */
    public static function createFlashMessage($message, $type, $title)
    {
        Yii::$app->getSession()->setFlash($type, [
            'type' => $type,
            'duration' => 5000,
            'icon' => 'fa fa-users',
            'message' => $message,
            'title' => $title,
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
    }

    public static function createSuccessMessage($message, $duration = 5000)
    {
        if(isset($_SESSION['success'])){
            $message = $_SESSION['success']['message'] . ", ".$message;
        }
        Yii::$app->getSession()->setFlash('success', [
            'type' => 'success',
            'duration' => $duration,
            'icon' => 'fa fa-users',
            'message' => $message,
            'title' => 'Éxito',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
    }

    public static function createErrorMessage($message, $duration = 5000)
    {
        Yii::$app->getSession()->setFlash('danger', [
            'type' => 'danger',
            'duration' => $duration,
            'icon' => 'fa fa-users',
            'message' => $message,
            'title' => 'Error',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
    }

    public static function createInfoMessage($message, $duration = 5000)
    {
        Yii::$app->getSession()->setFlash('info', [
            'type' => 'info',
            'duration' => $duration,
            'icon' => 'fa fa-users',
            'message' => $message,
            'title' => 'Aviso',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
    }

    public static function createWarningMessage($message, $duration = 5000)
    {
        Yii::$app->getSession()->setFlash('warning', [
            'type' => 'warning',
            'duration' => $duration,
            'icon' => 'fa fa-users',
            'message' => $message,
            'title' => 'Advertencia',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
    }
}
