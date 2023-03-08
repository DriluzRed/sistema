<?php

namespace backend\controllers;

use Yii;
use backend\models\Programa;
use backend\models\ProgramaAsignatura;
use backend\models\search\SearchProgramas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Exception;
use yii\helpers\ArrayHelper;

/**
 * ProgramaController implements the CRUD actions for Programa model.
 */
class ProgramaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Programa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchProgramas();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Programa model.
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
     * Creates a new Programa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Programa();
    
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $trans = Yii::$app->db->beginTransaction();
            try {
                // Agregar programas
                $asignaturas = Yii::$app->request->post('asignatura');
               
        
                if (!empty($asignaturas)) {
                    foreach ($asignaturas as $index => $asignatura) {
                        $asignatura_model = new ProgramaAsignatura();
                        $asignatura_model->programa_id = $model->id;
                        $asignatura_model->asignatura_id = $asignatura;
                       
                        if (!$asignatura_model->save(false)) {
                            throw new \Exception('Failed to save PrrogramaAsignatura model: ' . print_r($asignatura_model->errors, true));
                        }
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
        
    
        return $this->render('create', [
            'model' => $model,
    
        ]);
    }





    // {
    //     $model = new Programa();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         $trans = Yii::$app->db->beginTransaction();
    //         try{
    //             $model->save(false);
                
    //             $asigArray= $model->asignaturas;
    //             foreach($asigArray as $array){
    //             $model_ap = new ProgramaAsignatura();
    //             $model_ap->asignatura_id = $array;
                
    //             $model_ap->programa_id = $model->id;
    //             $model_ap->save(false);
    //             if (!$model_ap->save()) {
    //                 throw new \Exception('Failed to save ProgramaAsignatura model: ' . print_r($model_ap->errors, true));
    //             }
    //             }
    //             $trans->commit();
    //         }catch(\Exception $e){
    //             $trans->rollBack();
    //             throw new Exception($e);
    //             // FlashMessageHelpers::createWarningMessage($e->getMessage());
    //             return $this->redirect(['create']);
    //         }
    //         return $this->redirect(['index']);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,

    //     ]);
    // }
    

    /**
     * Updates an existing Programa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
{

    $model = $this->findModel($id);
    $asignatura_model = ProgramaAsignatura::findAll(['programa_id' => $id]);

    if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
        $asignatura_data = json_decode(Yii::$app->request->post('asignaturas-json'), true);
        $asignatura_ids = [];
        foreach ($asignatura_data as $asignatura) {
            $asignatura_ids[] = $asignatura['nombre'];
        }

        $existing_asignaturas = ProgramaAsignatura::findAll(['programa_id' => $id]);
        $existing_asignatura_ids = ArrayHelper::getColumn($existing_asignaturas, 'id');
        $asignatura_ids = array_map('intval', $asignatura_ids);
        $existing_asignatura_ids = array_map('intval', $existing_asignatura_ids);
        $asignaturas_to_delete = array_diff($existing_asignatura_ids, $asignatura_ids);

        $trans = Yii::$app->db->beginTransaction();
        try {
            foreach ($asignaturas_to_delete as $asignatura_id) {
                $asignatura_model = ProgramaAsignatura::findOne(['id' => $asignatura_id]);
                if ($asignatura_model) {
                    $asignatura_model->delete();
                }
            }

            foreach ($asignatura_data as $index => $asignatura) {
                $asignatura_id = array_key_exists('id', $asignatura) ? $asignatura['id'] : null;
                $asignatura_model = ProgramaAsignatura::findOne(['id' => $asignatura_id]);
                if (!$asignatura_model) {
                    $asignatura_model = new ProgramaAsignatura();
                    $asignatura_model->programa_id = $model->id;
                }

                $asignatura_model->asignatura_id = $asignatura['nombre'];
            
                if (!$asignatura_model->save()) {
                    throw new \Exception('Failed to save ProgramaAsignatura model: ' . print_r($asignatura_model->errors, true));
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
        'asignatura_model' => $asignatura_model,
    ]);
}



    /**
     * Deletes an existing Programa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        ProgramaAsignatura::deleteAll(['programa_id' => $model->id]);
    
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Programa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Programa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Programa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
