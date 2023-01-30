<?php

use common\models\LoginForm;
use kartik\checkbox\CheckboxX;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model LoginForm */
/* @var $this \yii\web\View */
/* @var $form ActiveForm */
?>

<div class="login-box">
    <div class="login-logo">
        
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><b>Control de Acceso</b></p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="form-group has-feedback">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'Usuario']); ?>
            <span style="top: 25px !important;" class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Contraseña']) ?>
            <span style="top: 25px !important;" class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group">
            <?php echo $form->field($model, 'rememberMe')->widget(CheckboxX::classname(), [
                'pluginOptions' => ['threeState' => false],
            ])->label('Recuérdame'); ?>
        </div>
        <div class="row">
            <div class="col-xs-4" style="width: 100%">
                <?= Html::submitButton('Iniciar Sesión', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script type='text/javascript'>
    document.getElementById("login-form").onsubmit = function (e) {
    };
</script>