<?php

namespace backend\controllers;

use common\interfaces\ModuleInterface;

/**
 * contabilidad module definition class
 */
class MainModule extends \yii\base\Module implements ModuleInterface
{

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }


    /**
     * Retorna los ítems de menú del módulo.
     * @return mixed
     */
    public static function getMenuItems()
    {
        $items = array();
        $subitems_entidad = [];

        (\Yii::$app->user->can('borrarAlumno')) ?  array_push($items, ['label' => 'Total de Inscriptos', 'url' => ['alumno/index'], 'icon' => 'fa fa-building','options' =>['class'=>'tarjetas'],  'active' => \Yii::$app->controller->id == 'alumno']):  '';
        array_push($items, ['label' => 'Asignaturas', 'url' => ['asignatura/index'], 'icon' => 'fa fa-building','options' =>['class'=>'tarjetas'],  'active' => \Yii::$app->controller->id == 'asignatura']);
        array_push($items, ['label' => 'Programas', 'url' => ['programa/index'], 'icon' => 'fa fa-building','options' =>['class'=>'tarjetas'],  'active' => \Yii::$app->controller->id == 'programa']);
        return $items;
    }


}
