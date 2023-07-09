<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $data array */
/* @var $totalAlumnos int */
/* @var $totalGraduados int */
/* @var $totalDesmatriculados int */
/* @var $indiceEficienciaGraduados float */
/* @var $indiceEficienciaDesmatriculados float */
/* @var $programas array */

$this->title = 'Indice de Eficiencia de Graduación y Deserción';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="stats-index">
    <br>
    <h3><?= Html::encode($this->title) ?></h3>

    <br>
    <div class="stats-form">
    <div class="row">
        <div class="col-md-4">
            <?= Html::dropDownList('programaId', Yii::$app->request->get('programaId'), $programas, [
                'class' => 'form-control',
                'prompt' => 'Selecciona un programa para filtrar',
                'onchange' => '$.pjax.reload({
                    container: "#stats-pjax-container",
                    data: {
                        programaId: $(this).val()
                    }
                });'
            ]) ?>
        </div>
    </div>
</div>
<?php
    $totalAlumnos = 0;
    foreach ($data as $row) {
        $totalAlumnos += $row['totalinscriptos'];
    }
    $total = 0;
    ?>
   
    <br>
    <?php Pjax::begin([
        'id' => 'stats-pjax-container',
    ]); ?>

    <div class="row">
        <div class="col-md-12">
            <?= GridView::widget([
                'dataProvider' => new \yii\data\ArrayDataProvider([
                    'allModels' => $data,
                    'pagination' => false,
                ]),
                'tableOptions' => [
                    'class' => 'table table-striped',
                ],
                'options' => [
                    'class' => 'table-responsive',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    
                    [
                        'attribute' => 'cohort',
                        'value' => function ($model) {
                            return $model['cohort'] . '-' . ($model['cohort'] + 2);
                        },
                        'label' => 'Cohorte',
                    ],
                    [
                        'attribute' => 'totalgraduados',
                        'value' => function ($model) use ($total) {
                            $totalEgresados = $model['totalegresados'] + $model['totalgraduados'];
                            $total = $model['totalinscriptos'] + $model['totaldesmatriculados'];
                            return ($total > 0) ? round(($totalEgresados / $total) * 100, 2) . '%' : '=';
                        },
                        'header' => 'Índice de Eficiencia de Graduados',
                    ],
                    [
                        'attribute' => 'totaldesmatriculados',
                        'value' => function ($model) use ($total) {
                            $totalDesmatriculados = $model['totaldesmatriculados'];
                            $total = $model['totalinscriptos'] + $model['totaldesmatriculados'];
                            return ($total > 0) ? round(($totalDesmatriculados / $total) * 100, 2) . '%' : '=';
                        },
                        'header' => 'Índice de Deficiencia de Desercion',
                    ],
                    [
                        'attribute' => 'totalinscriptos',
                        'label' => 'Total Inscriptos',
                    ],
                    [
                        'attribute' => 'totaldesmatriculados',
                        'label' => 'Total Desmatriculados',
                    ],
                    [
                        'attribute' => 'totalactivos',
                        'label' => 'Total Activos',
                    ],
                    [
                        'attribute' => 'totalegresados',
                        'label' => 'Total Egresados',
                    ],
                    [
                        'attribute' => 'totalgraduados',
                        'label' => 'Total Graduados',
                    ],
                    [
                        'attribute' => 'totalreinscriptos',
                        'label' => 'Total Reinscriptos',
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <?php Pjax::end(); ?>
</div>