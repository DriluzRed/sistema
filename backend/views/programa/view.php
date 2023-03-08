<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Programa */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Modulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="programa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Estas seguro de que quieres borrar este programa?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre:ntext',
            'desc:ntext',
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
        ],
    ]) ?>

</div>
