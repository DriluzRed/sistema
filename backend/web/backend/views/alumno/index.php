<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchAlumnos */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alumnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Alumno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name:ntext',
            'last_name:ntext',
            'ci:ntext',
            'country_id',
            //'low_line_number:ntext',
            //'phone:ntext',
            //'email:ntext',
            //'address:ntext',
            //'age:ntext',
            //'campus',
            //'subsidiary',
            //'enrollment_date:ntext',
            //'contract_number:ntext',
            //'year:ntext',
            //'promotion_year:ntext',
            //'born_at:ntext',
            //'promotion:ntext',
            //'document_front_file:ntext',
            //'document_back_file:ntext',
            //'status:ntext',
            //'study_certificate_file:ntext',
            //'finded_ips:ntext',
            //'finded_ruc:ntext',
            //'programa_id',
            //'sex:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
