<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\SearchAlumnos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumno-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'ci') ?>

    <?= $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'low_line_number') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'campus') ?>

    <?php // echo $form->field($model, 'subsidiary') ?>

    <?php // echo $form->field($model, 'enrollment_date') ?>

    <?php // echo $form->field($model, 'contract_number') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'promotion_year') ?>

    <?php // echo $form->field($model, 'born_at') ?>

    <?php // echo $form->field($model, 'promotion') ?>

    <?php // echo $form->field($model, 'document_front_file') ?>

    <?php // echo $form->field($model, 'document_back_file') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'study_certificate_file') ?>

    <?php // echo $form->field($model, 'finded_ips') ?>

    <?php // echo $form->field($model, 'finded_ruc') ?>

    <?php // echo $form->field($model, 'programa_id') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
