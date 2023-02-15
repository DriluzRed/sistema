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
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'first_name:ntext',
            'last_name:ntext',
            'ci:ntext',
            [
                'label' => 'Pais',
                'attribute' => 'country_id',
                'value' => 'pais.nombre',
            ],
            'phone:ntext',
            'email:ntext',
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
            'campus',
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
            'subsidiary',
            'year:ntext',
            'promotion_year:ntext',
            'promotion:ntext',
            'status:ntext',

            ['class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:100px'],
                'buttonOptions' => ['class' => 'btn btn-default'],
                'header' => 'Acciones',
                'template' => $template,
            ],
        ],
        
    ]); ?>
</div>
