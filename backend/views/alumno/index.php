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
            [
                'label' => 'Programas',
                'attribute' => 'programa',
                
                // 'format' => 'raw',
                'value' => function($model) {
                    return implode(',', array_map(function($programas) {
                        return $programas->nombre; // Nombre del programa
                    }, $model->programas));
                }
                
            ],
            // 'cohorte',
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
