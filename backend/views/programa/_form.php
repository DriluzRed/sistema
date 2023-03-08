<?php


use backend\models\AlumnoPrograma;
use backend\models\Asignatura;
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
/* @var $model backend\models\Programa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="programa-form">
<?php $form = ActiveForm::begin(); ?>

    <?php
               
                    echo FormGrid::widget([
                        'model' => $model,
                        'form' => $form,
                        'autoGenerateColumns' => true,
                        'rows' => [
                            [
                                'attributes' => [
                                    'nombre' => [
                                        'type' => Form::INPUT_TEXT,
                                        'options' => ['placeholder' => 'Nombre del programa'],
                                        'columnOptions' => ['colspan' => '3']
                                    ],
                                ]
                            ],
                            [
                                'autoGenerateColumns' => false,
                                'columns' => 6,
                                'attributes' => [
                                    'desc' => [
                                        'type' => Form::INPUT_TEXT,
                                        'options' => ['placeholder' => 'Descripcion del programa'],
                                        'columnOptions' => ['colspan' => '3']
                                    ],
                                ]
                            ],
                          
                        ]
                        ]);
                        if ($model->isNewRecord){
                            echo $this->render('_form_asignaturas_cre', ['model' => $model]);
                         }else{
                            echo $this->render('_form_asignaturas_up',[
                                'model' => $model,
                                'asignatura_model' => $asignatura_model,
                                'form' => $form,
                            ]);
                         }
    ?> 
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
