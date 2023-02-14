<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'last_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ci')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'low_line_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'age')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'campus')->textInput() ?>

    <?= $form->field($model, 'subsidiary')->textInput() ?>

    <?= $form->field($model, 'enrollment_date')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contract_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'year')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'promotion_year')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'born_at')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'promotion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'document_front_file')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'document_back_file')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'study_certificate_file')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'finded_ips')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'finded_ruc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'programa_id')->textInput() ?>

    <?= $form->field($model, 'sex')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
