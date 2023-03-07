<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * IDE controller
 */

 class IndiceEficienciaController extends Controller{
        /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class' => AccessControl::className(),
                'rules'=> [
                 
                    [
                        'allow' => false,
                        'actions' => ['index'],
                        'roles' => ['alumno'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['create'],
                        'roles' => ['alumno'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['update'],
                        'roles' => ['alumno'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['delete'],
                        'roles' => ['alumno'],
                    ],
                    [
                        'allow'=>true,
                        'roles'=>['@']
                     ],
                ]
    ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(){
        
    }
 }