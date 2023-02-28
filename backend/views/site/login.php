<?php

use common\models\LoginForm;
use kartik\checkbox\CheckboxX;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model LoginForm */
/* @var $this \yii\web\View */
/* @var $form ActiveForm */
?>


<body>
    <section class="login">
    <!-- <div class="login-logo"><img src="../web/img/sede1.jpg" alt=""></div> -->
        <div class="login-box">
            <div class="login-box-body">
                <h3 class="login-box-msg"><b>Control de Acceso</b></h3>
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

            <div class="right">
                <div class="right-inductor"> <img src="../web/img/Logo Circular FOTRIEM.png" alt=""></div>
            </div>
        </div>

    </section>

    <script type='text/javascript'>
        document.getElementById("login-form").onsubmit = function(e) {};
    </script>
    <!--Script de los iconos Agregado por Nati-->
    <script src="https://kit.fontawesome.com/a24879a822.js" crossorigin="anonymous"></script>


    <style>
        img {
            width: 100%;
        }

        .login {
            height: 100%;
            width: 100%;
            position: relative;
            
        }

        .login-box {
            width: 900px;
            height: 500px;
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: whitesmoke;
            border-radius: 10px;
            box-shadow: 1px 4px 22px -8px #0004;
            display: flex;
            overflow: hidden;
            margin-top: 40%;
        }

        .login-box .login-box-body {
            width: 41%;
            height: 100%;
            padding: 25px 25px;

        }

        .login-box .right {
            width: 59%;
            height: 100%
        }

        .login-box-body h3 {
            text-align: center;
            margin-bottom: 60px;
            margin-top: 60px;
            color: #fff;
        }

        .form-group {

            color: #fff;
        }

        .login-box-body {
            background: #1f396a;
        }


        .right .right-inductor {
            position: absolute;
            width: 250px;
            height: 270px;
            background: #fff0;
            left: 70%;
            top: 80px;
            transform: translate(-50%, 0%);

        }

        .top_link img {
            width: 250px;
            padding-right: 7px;
            margin-top: -3px;
        }
    </style>