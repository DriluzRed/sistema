<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchProgramas */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programas'; //Cambiado por Nati
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Programa', ['create'], ['class' => 'btn btn-success']) //Cambiado por Nati?> 
    </p>


    
    <?php
     $template = '';
     $template = $template . '{view}';
     $template = $template . '{update}';
     (\Yii::$app->user->can('borrarAlumno')) ?  $template = $template . '{delete}':  '';
    
     echo GridView::widget([
        'tableOptions' => [
            'class' => 'table table-striped',
        ],
        'options' =>[
            'class' => 'table-responsive',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'nombre:ntext',
            [
                'label' => 'Asignaturas',
                'attribute' => 'asignaturas',
                'value' => function ($model) {
                    $asignaturas = '';
                    foreach ($model->programaAsignaturas as $programaAsignatura) {
                        $asignaturas .= $programaAsignatura->asignatura->nombre . '<br>';
                    }
                    return $asignaturas;
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
    <?php Pjax::end(); ?>
</div>
