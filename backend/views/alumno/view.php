<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */

$this->title = $model->first_name . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="alumno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name:ntext',
            'last_name:ntext',
            'ci:ntext',
            'country_id',
            'low_line_number:ntext',
            'phone:ntext',
            'email:ntext',
            'address:ntext',
            'age:ntext',
            'programa_id',
            'campus',
            'subsidiary',
            'enrrolment_date:ntext',
            'contract_number:ntext',
            'year:ntext',
            'promotion_year:ntext',
            'born_at:ntext',
            'promotion:ntext',
            'document_front_file:ntext',
            'document_back_file:ntext',
            'status:ntext',
            'study_certificate_file:ntext',
            'finded_ips:ntext',
            'finded_ruc:ntext',
        ],
    ]) ?>

</div>
