<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use backend\models\Alumno;
use backend\models\AlumnoPrograma;
use yii\db\Query;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $totalAlumnos = Alumno::find()->count();
        // $totalGraduados = $query = Alumno::find();
        $totalGraduados = Alumno::find();
        $totalGraduados->joinWith(['alumnoProgramas' => function($query){
            $query->andWhere(['alumno_programa.estado_programa_id' => 3]);
        }]);
        $totalGraduados = $totalGraduados->count();

        $totalDesma = Alumno::find();
        $totalDesma->joinWith(['alumnoProgramas' => function($query){
            $query->andWhere(['alumno_programa.estado_programa_id' => 4]);
        }]);
        $totalDesma = $totalDesma->count();

        $totalCulminados = Alumno::find();
        $totalCulminados->joinWith(['alumnoProgramas' => function($query){
            $query->andWhere(['OR', ['alumno_programa.estado_programa_id' => 3], ['alumno_programa.estado_programa_id' => 4]]);
        }]);
        $totalCulminados = $totalCulminados->count();

        $totalInscriptos = Alumno::find();
        $totalInscriptos->joinWith(['alumnoProgramas' => function($query){
            $query->andWhere(['alumno_programa.estado_programa_id' => 6]);
        }]);
        $totalInscriptos = $totalInscriptos->count();

        return $this->render('index', 
        ['totalAlumnos'=>$totalAlumnos,
        'totalGraduados' => $totalGraduados,
        'totalDesma' => $totalDesma,
        'totalCulminados' => $totalCulminados,
        'totalInscriptos' => $totalInscriptos
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
