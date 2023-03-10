<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchAsignatura */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Módulo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignatura-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir nueva Asignatura', ['create'], ['class' => 'btn btn-success']) ?>
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
        'options' => [
            'class' => 'table-responsive',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre:ntext',

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
