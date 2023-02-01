<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchAsignatura */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asignaturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignatura-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asignatura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $url = 'index.php?r=user/view&id='.$model->id;
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,  ['class' => 'btn btn-default btn-xs custom_button']);
                    },
                    'update'=>function ($url, $model) {
                        $url = 'index.php?r=user/update&id='.$model->id;
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,   ['class' => 'btn btn-default btn-xs custom_button']);
                    },
                    'delete'=>function ($url, $model) {
                        $t = 'index.php?r=user/delete&id='.$model->id;
                        return (\Yii::$app->user->can('borrarAlumno')) ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,  ['class' => 'btn btn-default btn-xs custom_button',

                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'data-method'  => 'post',
                ]): '';
                    },
                ]
            ],
            [
                'label' => 'ID',
                'headerOptions' => [
                    'width' => '5%'
                ],
                'value' => 'id',
                'attribute' => 'id',
            ],

            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre:ntext',
            'desc:ntext',

            
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
