<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchAlumnos */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alumno';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir nuevo alumno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    /** @var Alumno $model */
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $t = 'index.php?r=alumno/view&id='.$model->id;
                        return Html::button('<span class="glyphicon glyphicon-eye-open"></span>', ['value'=>Url::to($t), 'class' => 'btn btn-default btn-xs custom_button']);
                    },
                    'update'=>function ($url, $model) {
                        $t = 'index.php?r=alumno/update&id='.$model->id;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value'=>Url::to($t), 'class' => 'btn btn-default btn-xs custom_button']);
                    },
                ],
            ],
            [
                'label' => 'ID',
                'headerOptions' => [
                    'width' => '5%'
                ],
                'value' => 'id',
                'attribute' => 'id',
            ],
            'first_name:ntext',
            'last_name:ntext',
            'ci:ntext',
            'country_id',
            'low_line_number:ntext',
            'phone:ntext',
            'email:ntext',
            'programa_id',
            'campus',
            'subsidiary',
            'enrrolment_date:ntext',
            'contract_number:ntext',
            'year:ntext',
            'promotion_year:ntext',
            'promotion:ntext',
            'status:ntext',
            'finded_ips:ntext',
            'finded_ruc:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
