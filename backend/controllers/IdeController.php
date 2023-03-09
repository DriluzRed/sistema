<?php

namespace backend\controllers;

use Yii;
use backend\models\Ide;
use backend\models\Alumno;
use backend\models\AlumnoPrograma;
use backend\models\EstadoPrograma;
use backend\models\EstadoTitulo;
use backend\models\Programa;
use backend\models\search\SearchAlumnoPrograma;
// use backend\models\searchAlumnoPrograma as ModelsSearchAlumnoPrograma;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use yii\db\Expression;
use yii\data\ActiveDataProvider;


class IdeController extends \yii\web\Controller
{
    public function actionStats()
    {
        $data = [];
        $totalAlumnos = AlumnoPrograma::find()->distinct()
        ->joinWith('Alumno');
       
        
    return $this->render('index');
    }

}
