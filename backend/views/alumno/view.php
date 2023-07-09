<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */

$this->title = $model->first_name . ' ' . $model->last_name;
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
                'confirm' => '¿Estás seguro de que quieres eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Información básica</div>
                <div class="panel-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'first_name:ntext',
                            'last_name:ntext',
                            'ci:ntext',
                            [
                                'attribute' => 'country_id',
                                'value' => function ($model) {
                                    return $model->pais->nombre;
                                },
                            ],
                            'low_line_number:ntext',
                            'phone:ntext',
                            'email:ntext',
                            'address:ntext',
                            'age:ntext',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Programas y Cohortes</div>
                <div class="panel-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => 'Programas',
                                'value' => function ($model) {
                                    $programas = '';
                                    foreach ($model->alumnoProgramas as $alumnoPrograma) {
                                        $programas .= '<div class="grid-item">' . $alumnoPrograma->programa->nombre . ' <strong>(Cohorte: ' . $alumnoPrograma->cohort . ')</strong>' . '</div> ';
                                    }
                                    return $programas;
                                },
                                'format' => 'raw',
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Detalles adicionales</div>
                <div class="panel-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'subsidiary',
                            'year:ntext',
                            'status:ntext',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
