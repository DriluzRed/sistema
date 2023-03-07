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
        array_push($items, ['label' => 'Inicio', 'url' => ['site/index'], 'icon' => 'fa fa-bars','options' =>['class'=>'tarjetas'],  'active' => \Yii::$app->controller->id == 'site']);
        (\Yii::$app->user->can('crearAlumno')) ?  array_push($items, ['label' => 'Total de Inscriptos', 'url' => ['alumno/index'], 'icon' => 'fa fa-solid fa-user','options' =>['class'=>'tarjetas'],  'active' => \Yii::$app->controller->id == 'alumno']):  '';
        array_push($items, ['label' => 'Asignaturas', 'url' => ['asignatura/index'], 'icon' => 'fa fa-solid fa-clipboard','options' =>['class'=>'tarjetas'],  'active' => \Yii::$app->controller->id == 'asignatura']);
        array_push($items, ['label' => 'MAE - ESP - DIP', 'url' => ['programa/index'], 'icon' => 'fa fa-solid fa-book','options' =>['class'=>'tarjetas'],  'active' => \Yii::$app->controller->id == 'programa']);
        array_push($items, ['label' => 'Carrera de Grado', 'url' => ['alumno/carreras'], 'icon' => 'fa fa-solid fa-book','options' =>['class'=>'tarjetas'],  'active' => \Yii::$app->controller->id == 'alumno']);
        array_push($items, ['label' => 'Talleres', 'url' => ['alumno/talleres'], 'icon' => 'fa fa-gear','options' =>['class'=>'tarjetas'],  'active' => \Yii::$app->controller->id == 'alumno']);
        array_push($items, ['label' => 'Libro de Graduados', 'url' => ['alumno/graduados'], 'icon' => 'fa fa-book','options' =>['class'=>'tarjetas'],  'active' => \Yii::$app->controller->id == 'alumno']); 
        return $items;
    }


}
