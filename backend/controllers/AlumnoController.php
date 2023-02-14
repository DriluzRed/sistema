<?php

namespace backend\controllers;

use Yii;
use backend\models\Alumno;
use backend\models\AlumnoPrograma;
use backend\models\search\SearchAlumnos;
use common\helpers\FlashMessageHelpers;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        if ($model->load(Yii::$app->request->post())) {
            $trans = Yii::$app->db->beginTransaction();
            try{
                $model->save(false);
                
                $programsArray= $model->programas;
                foreach($programsArray as $array){
                $model_ap = new AlumnoPrograma();
                $model_ap->programa_id = $array;
                
                $model_ap->alumno_id = $model->id;
                $model_ap->cohort = $model->cohorte;
                $model_ap->estado_programa_id = $model->estado_programa_id;
             
                $model_ap->estado_titulo_id = $model->estado_titulo_id;
                $model_ap->resolution = $model->resolution;
                $model_ap->resolution_date = $model->resolution_date;
                $model_ap->promotion_year = $model->promotion_year;
                $model_ap->seller = $model->seller;
                $model_ap->charge = $model->charge;
                $model_ap->save(false);
                if (!$model_ap->save()) {
                    throw new \Exception('Failed to save AlumnoPrograma model: ' . print_r($model_ap->errors, true));
                }
                }
                $trans->commit();
            }catch(\Exception $e){
                $trans->rollBack();
                throw new Exception($e);
                // FlashMessageHelpers::createWarningMessage($e->getMessage());
                return $this->redirect(['create']);
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,

        ]);
    }

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
