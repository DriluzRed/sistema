<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Programa */

$this->title = 'Actualizar Modulo: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Programas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="programa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'asignatura_model' => $asignatura_model,
    ]) ?>

</div>
