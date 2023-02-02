<?php

/* @var $this yii\web\View */
/* @var $model \frontend\models\SignupForm */
/* @var $form yii\widgets\ActiveForm */

use app\models\AuthAssignment;
use yii\helpers\Html;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;




$this->title = 'Registro de Usuario';
$this->params['breadcrumbs'][] = $this->title;

$current_user_roles  = [];
$current_user_roles2  = [];
if( (\Yii::$app->user->can('coordinacion'))  ||  (\Yii::$app->user->can('administracion'))  ){
$current_user_roles = Yii::$app->authManager->getRolesByUser(11);
$current_user_roles2 = Yii::$app->authManager->getRolesByUser(15);

}else if(\Yii::$app->user->can('coordinacion')){
$current_user_roles3 = Yii::$app->authManager->getRolesByUser(15);
}
$Containt= array_merge($current_user_roles,$current_user_roles2);


$available_roles = Yii::$app->authManager->getRoles();
foreach($Containt as $role){
    if(in_array($role,$available_roles)){
        $index = array_search($role,$available_roles);
        \yii\helpers\ArrayHelper::remove($available_roles,$index);
    }
}

 $listData=ArrayHelper::map($available_roles,'name','name');
/* echo "<pre>";
var_dump($listData);
exit; */
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [
                    [
                        'attributes' => [
                            'username' => [
                                'type' => Form::INPUT_TEXT,
                                'options' => ['placeholder' => 'Nombre del usuario'],
                                'columnOptions' => ['colspan' => '3']
                            ],
                        ]
                    ],
                    [
                        'attributes' => [
                            'rol_name' => [
                                'type' => Form::INPUT_RAW,
                                'value' => $form->field($model, 'rol_name')->widget(Select2::className(), [
                                    'data' => $listData,
                                    'options' => ['placeholder' => 'Seleccione un rol'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ]
                                ])
                            ],
                        ]
                    ],
                    [
                        'attributes' => [
                            'email' => [
                                'type' => Form::INPUT_TEXT,
                                'options' => ['placeholder' => 'Email del usuario'],
                                'columnOptions' => ['colspan' => '3']
                            ],
                        ]
                    ],
                    [
                        'attributes' => [
                            'password' => [
                                'type' => Form::INPUT_PASSWORD,
                                'options' => ['placeholder' => 'Contraseña del usuario'],
                                'columnOptions' => ['colspan' => '3']
                            ],
                        ]
                    ],
                    
                ]
            ])?>

              




                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
