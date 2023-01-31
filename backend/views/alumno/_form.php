<?php

use backend\models\Pais;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'attributes' => [
                    'ci' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => ['placeholder' => 'CI del Alumno'],
                        'columnOptions' => ['colspan' => '3']
                    ],
                ]
            ],
            [
                'autoGenerateColumns' => false,
                'columns' => 6,
                'attributes' => [
                    'first_name' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => ['placeholder' => 'Nombres del Alumno'],
                        'columnOptions' => ['colspan' => '3']
                    ],
                ]
            ],
            [
                'attributes' => [
                    'last_name' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => ['placeholder' => 'Apellidos del Alumno'],
                        'columnOptions' => ['colspan' => '3']
                    ],
                ]
            ],
            [
                'attributes' => [
                    'country_id' => [
                        'type' => Form::INPUT_RAW,
                        'value' => $form->field($model->country_id == NULL ? $model : $model->country_id, 'country_id')->widget(Select2::className(), [
                            'data' => Pais::getPaisLista(true),
                            'options' => ['placeholder' => 'Seleccione un Pais ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                ]
            ],
            [
                'attributes' => [
                    'low_line_number' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => ['placeholder' => 'Numero linea baja'],
                        'columnOptions' => ['colspan' => '3']
                    ],
                ]
            ],
            [
                'attributes' => [
                    'phone' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => ['placeholder' => 'Numero de telefono'],
                        'columnOptions' => ['colspan' => '3']
                    ],
                ]
            ],
            
        ]
    ]) ?>

<?= $form->field($model, 'first_name')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'last_name')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'ci')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'country_id')->textInput() ?>

<?= $form->field($model, 'low_line_number')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'phone')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'age')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'programa_id')->textInput() ?>

<?= $form->field($model, 'campus')->textInput() ?>

<?= $form->field($model, 'subsidiary')->textInput() ?>

<?= $form->field($model, 'enrrolment_date')->textarea(['rows' => 6]) ?>

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

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

    <?php ActiveForm::end(); ?>


</div>
