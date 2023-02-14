<?php

use backend\models\AlumnoPrograma;
use kartik\widgets\FileInput;
use backend\models\Pais;
use backend\models\Programa;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumno-form">
<?php

// var_dump($programas);exit;
?>
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
                        'value' => $form->field($model, 'country_id')->widget(Select2::className(), [
                            'data' => Pais::getPaisLista(true),
                            'options' => ['placeholder' => 'Seleccione un Pais ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
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
            [
                'attributes' => [
                    'phone' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => ['placeholder' => 'Numero de telefono'],
                        'columnOptions' => ['colspan' => '3']
                    ],
                ]
            ],
            [
                'attributes' => [
                    'email' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => ['placeholder' => 'email'],
                        'columnOptions' => ['colspan' => '3']
                    ],
                ]
            ],
            [
                'attributes' => [
                    'address' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => ['placeholder' => 'Direccion'],
                        'columnOptions' => ['colspan' => '3']
                    ],
                ]
            ],
            [
                'attributes' => [
                    'programas' => [
                        'type' => Form::INPUT_RAW,
                        'value' => $form->field($model, 'programas')->widget(Select2::className(), [
                            'data' => Programa::getProgramaLista(true),
                            'options' => ['placeholder' => 'Seleccione un Programa ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true,
                            ]
                        ])
                    ],
                ]
            ],
            [
                'attributes' => [
                    'campus' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => ['placeholder' => 'Sede'],
                        'columnOptions' => ['colspan' => '3']
                    ],
                ]
            ],

            [
                'attributes' => [
                    'subsidiary' => [
                        'type' => Form::INPUT_TEXT,
                        'options' => ['placeholder' => 'Filial'],
                        'columnOptions' => ['colspan' => '3']
                    ],
                ]
            ],
            ]
        ]);
        ?> 

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

    <?php ActiveForm::end(); ?>


</div>
