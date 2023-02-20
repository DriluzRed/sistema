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
        $programas = Programa::find()->all();
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->save()) {
                    // Guardar los programas seleccionados en la tabla alumnoprograma
                    $programasJson = Yii::$app->request->post('programas-json');
                    $programas = Json::decode($programasJson);
                    foreach ($programas as $programa) {
                        $programaModel = Programa::findOne(['nombre' => $programa['nombre']]);
                        // $estadopModel = EstadoPrograma::findOne(['desc' => $programa['desc']]);
                        // $estadotModel = EstadoTitulo::findOne(['desc' => $programa['desc']]);
                        $alumnoPrograma = new Alumnoprograma([
                            'alumno_id' => $model->id,
                            'programa_id' => $programa['nombre'],
                            'cohort' => $programa['cohorte'],
                            'estado_programa_id' => $programa['estadopro'],
                            'estado_titulo_id' => $programa['estadotitu'],
                            'resolution' => $programa['resolution'],
                            'resolution_date' => $programa['fecha_resolucion'],
                            'promotion_year' => $programa['promotion_year'],
                            'seller' => $programa['seller'],
                            'charge' => $programa['charge']]);
                            print_r($programa); 
                            $alumnoPrograma->created_at = null;
                            $alumnoPrograma->updated_at = null;
                            $alumnoPrograma->deleted_at = null;

                        if (!$alumnoPrograma->save()) {
                            throw new \Exception('Failed to save AlumnoPrograma model: ' . print_r($alumnoPrograma->errors, true));
                        }
                    }
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw new \Exception($e);
                // Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
    
        return $this->render('create', [
            'model' => $model,
            'programas' => $programas,
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
        $model = Alumno::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("Alumno not found: $id");
        }
    
        $programas = Programa::find()->all();
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->save()) {
                    // Delete existing Alumnoprograma records
                    Alumnoprograma::deleteAll(['alumno_id' => $model->id]);
    
                    // Save new Alumnoprograma records
                    $programasJson = Yii::$app->request->post('programas-json');
                    $programas = Json::decode($programasJson);
                    foreach ($programas as $programa) {
                        $programaModel = Programa::findOne(['nombre' => $programa['nombre']]);
                        $alumnoPrograma = new Alumnoprograma([
                            'alumno_id' => $model->id,
                            'programa_id' => $programa['nombre'],
                            'cohort' => $programa['cohorte'],
                            'estado_programa_id' => $programa['estadopro'],
                            'estado_titulo_id' => $programa['estadotitu'],
                            'resolution' => $programa['resolution'],
                            'resolution_date' => $programa['fecha_resolucion'],
                            'promotion_year' => $programa['promotion_year'],
                            'seller' => $programa['seller'],
                            'charge' => $programa['charge']
                        ]);
    
                        if (!$alumnoPrograma->save()) {
                            throw new \Exception('Failed to save AlumnoPrograma model: ' . print_r($alumnoPrograma->errors, true));
                        }
                    }
    
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw new \Exception($e);
                // Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
    
        return $this->render('update', [
            'model' => $model,
            'programas' => $programas,
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
        $this->findModel($id)->delete();

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
