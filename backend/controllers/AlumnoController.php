<?php

namespace backend\controllers;

use Yii;
use backend\models\Alumno;
use backend\models\AlumnoPrograma;
use backend\models\EstadoPrograma;
use backend\models\EstadoTitulo;
use backend\models\Programa;
use backend\models\search\SearchAlumnos;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * AlumnoController implements the CRUD actions for Alumno model.
 */
class AlumnoController extends Controller
{
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

    /**
     * Lists all Alumno models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchAlumnos();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Alumno model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Alumno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
{
    $model = new Alumno();


    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        $trans = Yii::$app->db->beginTransaction();
        try{
        // Agregar programas
        $programas = Yii::$app->request->post('programa');
        $cohorte = Yii::$app->request->post('cohorte');
        $estado_pro = Yii::$app->request->post('estadopro');
        $estado_titu = Yii::$app->request->post('estadotitu');
        $resolution = Yii::$app->request->post('resolution');
        $fecha_resolucion = Yii::$app->request->post('fecha_resolucion');
        $promotion_year = Yii::$app->request->post('promotion_year');
        $seller = Yii::$app->request->post('seller');
        $charge = Yii::$app->request->post('charge');

        if (!empty($programas)) {
            foreach ($programas as $index => $programa) {
                $programa_model = new AlumnoPrograma();
                $programa_model->alumno_id = $model->id;
                $programa_model->programa_id = $programa;
                $programa_model->cohort = $cohorte[$index];
                $programa_model->estado_programa_id = $estado_pro[$index];
                $programa_model->estado_titulo_id = $estado_titu[$index];
                $programa_model->resolution = $resolution[$index];
                $programa_model->resolution_date = $fecha_resolucion[$index];
                $programa_model->promotion_year = $promotion_year[$index];
                $programa_model->seller = $seller[$index];
                $programa_model->charge = $charge[$index];
                $programa_model->save(false);
            }
            if (!$programa_model->save()) {
                throw new \Exception('Failed to save AlumnoPrograma model: ' . print_r($programa_model->errors, true));
            }
            }
            $trans->commit();
        
            }catch(\Exception $e){
            $trans->rollBack();
            throw new \Exception($e);
            // FlashMessageHelpers::createWarningMessage($e->getMessage());
            return $this->redirect(['update']);
        }
        return $this->redirect(['index']);
    }

    return $this->render('create', [
        'model' => $model,

    ]);
}
//     public function actionAgregarPrograma($alumno_id)
// {
//     $model = new AlumnoPrograma();

//     if ($model->load(Yii::$app->request->post()) && $model->save()) {
//         Yii::$app->session->setFlash('success', 'El programa se ha agregado exitosamente.');
//         return $this->redirect(['view', 'id' => $alumno_id]);
//     }

//     return $this->render('agregar_programa', [
//         'model' => $model,
//         'alumno_id' => $alumno_id,
//     ]);
// }

    /**
     * Updates an existing Alumno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $programa_model = AlumnoPrograma::findAll(['alumno_id' => $id]);
    
        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            $programa_data = json_decode(Yii::$app->request->post('programas-json'), true);
            $programa_ids = [];
            foreach ($programa_data as $programa) {
                $programa_ids[] = $programa['nombre'];
            }
    
            $existing_programas = AlumnoPrograma::findAll(['alumno_id' => $id]);
            $existing_programa_ids = ArrayHelper::getColumn($existing_programas, 'id');
            $programa_ids = array_map('intval', $programa_ids);
            $existing_programa_ids = array_map('intval', $existing_programa_ids);
            $programas_to_delete = array_diff($existing_programa_ids, $programa_ids);
    
            $trans = Yii::$app->db->beginTransaction();
            try {
                foreach ($programas_to_delete as $programa_id) {
                    $programa_model = AlumnoPrograma::findOne(['id' => $programa_id]);
                    if ($programa_model) {
                        $programa_model->delete();
                    }
                }
    
                foreach ($programa_data as $index => $programa) {
                    $programa_id = array_key_exists('id', $programa) ? $programa['id'] : null;
                    $programa_model = AlumnoPrograma::findOne(['id' => $programa_id]);
                    if (!$programa_model) {
                        $programa_model = new AlumnoPrograma();
                        $programa_model->alumno_id = $model->id;
                    }
    
                    $programa_model->programa_id = $programa['nombre'];
                    $programa_model->cohort = Yii::$app->request->post('cohorte')[$index];
                    $programa_model->estado_programa_id = Yii::$app->request->post('estadopro')[$index];
                    $programa_model->estado_titulo_id = Yii::$app->request->post('estadotitu')[$index];
                    $programa_model->resolution = Yii::$app->request->post('resolution')[$index];
                    $programa_model->resolution_date = Yii::$app->request->post('fecha_resolucion')[$index];
                    $programa_model->promotion_year = Yii::$app->request->post('promotion_year')[$index];
                    $programa_model->seller = Yii::$app->request->post('seller')[$index];
                    $programa_model->charge = Yii::$app->request->post('charge')[$index];
    
                    if (!$programa_model->save()) {
                        throw new \Exception('Failed to save AlumnoPrograma model: ' . print_r($programa_model->errors, true));
                    }
                }
    
                $trans->commit();
            } catch(\Exception $e) {
                $trans->rollBack();
                throw new \Exception($e);
                // FlashMessageHelpers::createWarningMessage($e->getMessage());
                return $this->redirect(['update']);
            }
    
            return $this->redirect(['index']);
        }
    
        return $this->render('update', [
            'model' => $model,
            'programa_model' => $programa_model,
        ]);
    }

    

    /**
     * Deletes an existing Alumno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
    
        // delete related records in AlumnoPrograma table
        AlumnoPrograma::deleteAll(['alumno_id' => $model->id]);
    
        $model->delete();
    
        return $this->redirect(['index']);
    }
    

    /**
     * Finds the Alumno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alumno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alumno::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
