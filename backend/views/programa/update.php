<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Programa */

$this->title = 'Actualizar Modulo: ' . $model->nombre;


?>
<div class="programa-update">


    <?= $this->render('_form', [
        'model' => $model,
        'asignatura_model' => $asignatura_model,
    ]) ?>

</div>
