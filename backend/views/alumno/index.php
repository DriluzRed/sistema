<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchAlumnos */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alumnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir nuevo alumno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $template = '';
    $template = $template . '{view}';
    $template = $template . '{update}';
    $template = $template . '{delete}';
    /** @var Alumno $model */
    echo GridView::widget([
        'tableOptions' => [
            'class' => 'table table-striped',
        ],
        'options' => [
            'class' => 'table-responsive',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'first_name:ntext',
            'last_name:ntext',
            'ci:ntext',
            'phone:ntext',
            // [
            //     'label' => 'Pais',
            //     'attribute' => 'programas',
            //     'value' => 'programas.nombre',
            // ],
            [
                'label' => 'Programas',
                'attribute' => 'programas',
                'value' => function ($model) {
                    $programas = '';
                    foreach ($model->alumnoProgramas as $alumnoPrograma) {
                        $programas .= $alumnoPrograma->programa->nombre . '<br>';
                    }
                    return $programas;
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Cohorte',
                'attribute' => 'cohorte',
                'value' => function ($model) {
                    $cohorte = '';
                    foreach ($model->alumnoProgramas as $alumnoPrograma) {
                        $cohorte .= $alumnoPrograma->cohort . '<br>';
                    }
                    return $cohorte;
                },
                'format' => 'raw',
            ],
            'year:ntext',
         
            [
                'label' => 'Año de Promocion',
                'attribute' => 'promotion_year',
                'value' => function ($model) {
                    $promotion_year = '';
                    foreach ($model->alumnoProgramas as $alumnoPrograma) {
                        $promotion_year .= $alumnoPrograma->promotion_year . '<br>';
                    }
                    return $promotion_year;
                },
                'format' => 'raw',
            ],
            // 'promotion:ntext',
            'status:ntext',
            [
                'label' => 'Estado del programa',
                'attribute' => 'estado_programa',
                'value' => function ($model) {
                    $estado_programa_nombre = '';
                    foreach ($model->alumnoProgramas as $alumnoPrograma) {
                        $estado_programa_nombre .= $alumnoPrograma->estadoPrograma->desc . '<br>';
                    }
                    return $estado_programa_nombre;
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Estado del titulo',
                'attribute' => 'estado_titulo',
                'value' => function ($model) {
                    $estado_titulo = '';
                   
                        foreach ($model->alumnoProgramas as $alumnoPrograma) {
                            if($alumnoPrograma->estadoTitulo){
                                $estado_titulo .= $alumnoPrograma->estadoTitulo->desc . '<br>';
                            }
                            
                        }
                      

                    return $estado_titulo;
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:100px'],
                'buttonOptions' => ['class' => 'btn btn-default'],
                'header' => 'Acciones',
                'template' => $template,
            ],
        ],
        
    ]); ?>
</div>
