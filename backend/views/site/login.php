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
    <img src="../web/img/Logo-Fotriem-Blanco.png" alt="">
        <h2 class="login-box-msg"><b>Control de Acceso</b></h2>
        
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
<!--Script de los iconos Agregado por Nati-->
<script src="https://kit.fontawesome.com/a24879a822.js" crossorigin="anonymous"></script>

<?php
$css = <<<CSS

 @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
*{
  margin:0;
  padding:0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
  color: white;
}
body{
  display:flex;
  justify-content:center;
  align-items: center;
  min-height: 100vh;
  background: #23242a;
}
.login-box{
  position: relative;
  width: 380px;
  height: 520px;
  background: #1c1c1c;
  border-radius: 8px;
  overflow: hidden;
  margin-left: 32.5%;
}
.login-box-body{
  position:absolute;
  inset: 2px;
  background: #28292d;
  border-radius: 8px;
  z-index: 10;
  padding: 50px 40px;
  display: flex;
  flex-direction: column;
}
CSS;

$this->registerCss($css);

