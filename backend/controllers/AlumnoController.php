<?php

namespace backend\controllers;

use Yii;
use backend\models\Alumno;
use yii\data\ActiveDataProvider;
use backend\models\AlumnoPrograma;
use backend\models\EstadoPrograma;
use backend\models\EstadoTitulo;
use backend\models\Programa;
use backend\models\search\SearchAlumnos;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\helpers\FlashMessageHelpers;
use yii\web\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use kartik\export\ExportMenu;


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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [

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
                        'allow' => false,
                        'actions' => ['delete'],
                        'roles' => ['administracion'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@']
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

        Yii::$app->session->set('dataProvider', $dataProvider);
        Yii::$app->session->set('searchModel', $searchModel);

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
            try {
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
                        if (!$programa_model->save(false)) {
                            // throw new \Exception('Failed to save AlumnoPrograma model: ' . print_r($programa_model->errors, true));
                            FlashMessageHelpers::createErrorMessage("No se ha podido editar el alumno. Verifique los programas ingresados.");
                        }
                    }
                }
                $trans->commit();
                FlashMessageHelpers::createSuccessMessage("Alumno agregado correctamente.");
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $trans->rollBack();
                throw new \Exception($e);
                FlashMessageHelpers::createWarningMessage($e->getMessage());
                return $this->redirect(['create']);
            }
          
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
        $programa_models = AlumnoPrograma::findAll(['alumno_id' => $id]);

        if (empty($programa_models)) {
            $programa_models[] = new AlumnoPrograma();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

            $transaction = Yii::$app->db->beginTransaction();
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
                        FlashMessageHelpers::createErrorMessage("No se ha podido editar el alumno. Verifique los programas ingresados.");
                    }
                }

                $transaction->commit();
                FlashMessageHelpers::createSuccessMessage("Alumno actualizado correctamente.");
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw new \Exception($e);
                FlashMessageHelpers::createWarningMessage($e->getMessage());
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'programa_model' => $programa_models,
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

        FlashMessageHelpers::createInfoMessage("Alumno eliminado correctamente.");
        return $this->redirect(['index']);
    }

    public function actionGraduados()
    {
        $searchModel = new SearchAlumnos();
        $searchModel->estado_programa = "Graduado";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Add filter to search for "Egresado" state as well
        $dataProvider->query->andFilterWhere([
            'or',
            ['estado_programa.desc' => $searchModel->estado_programa],
            ['estado_programa.desc' => 'Egresado'],
        ]);

        return $this->render('graduados', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTalleres()
    {
        $searchModel = new SearchAlumnos();
        $searchModel->programas = "Taller"; // Set the programas attribute to "Taller"
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // echo '<pre>';var_dump($dataProvider);
        return $this->render('talleres', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCarreras()
    {
        $searchModel = new SearchAlumnos();
        $searchModel->programas = "Carrera"; // Set the programas attribute to "Taller"
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('carreras', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionStats($programaId = null)
    {
        $programaId = Yii::$app->request->get('programaId');
        // Select the fields to display and calculate the aggregates
        $query = AlumnoPrograma::find()
            ->leftJoin('alumno', 'alumno.id = alumno_programa.alumno_id')
            ->leftJoin('estado_programa', 'estado_programa.id = alumno_programa.estado_programa_id')
            ->select([
                'alumno_programa.cohort',
                'COUNT(alumno_programa.alumno_id) AS totalInscriptos',
                'SUM(IF(estado_programa.desc = "desmatriculado", 1, 0)) AS totalDesmatriculados',
                'SUM(IF(alumno.status = "activo", 1, 0)) AS totalActivos',
                'SUM(IF(alumno.status = "inactivo", 1, 0)) AS totalInactivos',
                'SUM(IF(estado_programa.desc = "egresado", 1, 0)) AS totalEgresados',
                
                'SUM(IF(estado_programa.desc = "graduado", 1, 0)) AS totalGraduados',
                'SUM(IF(estado_programa.desc = "reinscripto", 1, 0)) AS totalReinscriptos',
            ])
            ->groupBy(['alumno_programa.cohort']);

        if ($programaId) {
            $query->andWhere(['alumno_programa.programa_id' => $programaId]);
        }

        $data = $query->asArray()->all();

        $totalAlumnos = 0;
        $totalGraduados = 0;
        $totalDesmatriculados = 0;
        $totalActivos = 0;
        $totalInactivos = 0;
        foreach ($data as $row) {
            // var_dump($row['totalinscriptos']);

            // exit;
            $row['totalinscriptos'] = (float)$row['totalinscriptos'];
            $row['totalgraduados'] = (float)$row['totalgraduados'];
            $row['totaldesmatriculados'] = (float)$row['totaldesmatriculados'];
            $row['totalactivos'] = (float)$row['totalactivos'];
            $row['totalinactivos'] = (float)$row['totalinactivos'];
            $totalAlumnos += $row['totalinscriptos'];
            $totalGraduados += $row['totalgraduados'];
            $totalDesmatriculados += $row['totaldesmatriculados'];
            $totalActivos += $row['totalactivos'];
            $totalInactivos += $row['totalinactivos'];
        }
        unset($row);

        $indiceEficienciaGraduados = $totalAlumnos > 0 && $totalActivos > 0 ? round($totalGraduados / $totalActivos * 100, 2) : 0;
        $indiceEficienciaDesmatriculados = $totalAlumnos > 0 ? round($totalDesmatriculados / $totalAlumnos * 100, 2) : 0;


        $programas = ArrayHelper::map(Programa::find()->all(), 'id', 'nombre');

        return $this->render('stats', [
            'data' => $data,
            'totalAlumnos' => $totalAlumnos,
            'totalGraduados' => $totalGraduados,
            'totalDesmatriculados' => $totalDesmatriculados,
            'indiceEficienciaGraduados' => $indiceEficienciaGraduados,
            'indiceEficienciaDesmatriculados' => $indiceEficienciaDesmatriculados,
            'programas' => $programas,
            'programaId' => $programaId,
        ]);
    }
    public function actionExportExcel()
    {
        $searchModel = Yii::$app->session->get('searchModel');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = false; // para evitar la paginación en el Excel
        $dataProvider->setSort(false); // para evitar la ordenación en el Excel
        $data = $dataProvider->getModels();

        // Crear el objeto Spreadsheet
        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $objPHPExcel->getActiveSheet();

        // Establecer los encabezados de las columnas
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Apellido');
        $sheet->setCellValue('D1', 'Sexo');
        $sheet->setCellValue('E1', 'CI');
        $sheet->setCellValue('F1', 'Programas');
        $sheet->setCellValue('G1', 'Cohorte');
        $sheet->setCellValue('H1', 'Estado del programa');
        $sheet->setCellValue('I1', 'Estado del Titulo');

        // Recorrer los datos y agregar las filas
        $row = 2;
        foreach ($data as $model) {
            $alumnoPrograma = '';
            $extra = '';
            if (!empty($model->alumnoProgramas) && !empty($model->alumnoProgramas[0])) {
                $alumnoPrograma = $model->alumnoProgramas[0];
                foreach ($model->alumnoProgramas as $alumnoPrograma) {
                    if (!empty($alumnoPrograma->programa)) {
                        $extra .= $alumnoPrograma->programa->nombre . ", ";
                    }
                }
            }

            $sheet->setCellValue('A' . $row, strval($model->id));
            $sheet->setCellValue('B' . $row, $model->first_name);
            $sheet->setCellValue('C' . $row, $model->last_name);
            $sheet->setCellValue('D' . $row, $model->sex);
            $sheet->setCellValue('E' . $row, $model->ci);
            if (!empty($alumnoPrograma)) {
                $sheet->setCellValue('F' . $row, $extra);
                $sheet->setCellValue('G' . $row, strval($alumnoPrograma->cohort));

                if (!empty($alumnoPrograma) && !empty($alumnoPrograma->estadoPrograma)) {
                    $sheet->setCellValue('H' . $row, $alumnoPrograma->estadoPrograma['desc']);
                }
                if (!empty($alumnoPrograma) && !empty($alumnoPrograma->estadoTitulo)) {
                    $sheet->setCellValue('I' . $row, $alumnoPrograma->estadoTitulo['desc']);
                }
            }

            $row++;
        }

        // Limpiar cualquier salida que se haya enviado anteriormente
        ob_end_clean();

        // Configurar los encabezados para la descarga del archivo
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment;filename="alumnos.xlsx"');
        header('Cache-Control: max-age=0');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Fecha en el pasado
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // Última fecha de modificación a la hora actual
        header('Cache-Control: no-store, no-cache, must-revalidate'); // Control de almacenamiento en caché
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');

        // Guardar el archivo Excel en la salida
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
        $objWriter->save('php://output');

        exit();
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
