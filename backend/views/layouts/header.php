<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\Pjax;


/* @var $this \yii\web\View */
/* @var $content string */
$perfil = User::find()->where(['id' => Yii::$app->user->id])->one();
?>

<header class="main-header">
<?php $nombre_sistema = 'Nora Ruoti & Asoc.' ?>
    <?= Html::a('<span class="logo-mini">Sys</span><span class="logo-lg">' . $nombre_sistema . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top" role="navigation">
    
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <?php
        Pjax::begin(['id' => 'empresa_pjax']); ?>
        

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                
            
            <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span class="hidden-xs"><?= $user =  Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php if (Yii::$app->session->get('user') == null) ?>
                                <img src="../web/img/avatar_neutro.png" class="user-image" alt="User Image"/>

    
                                
                            
                            <p>
                                <?= Yii::$app->user->identity->username ?>
                                <small>Miembro
                                    desde <?= Yii::$app->formatter->asDAte(Yii::$app->user->identity->created_at) ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer" style="background: #8aa4af">
                            
                            <div class="pull-right">
                                <?= Html::a(
                                    'Cerrar Sesion',
                                    '#',
                                    ['id' => 'logout_id', 'class' => 'btn btn-adn']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

        </div>
        <?php Pjax::end(); ?>
    </nav>
</header>
<?php
$logout = Url::to(['/site/logout']);

$script = <<<JS
$(document).on('click', '#logout_id', (function () {
    //eliminamos la empresa actual del localstorage
    localStorage.removeItem("core-empresa-actual");
    $.post(
        "$logout",
        function () {
        }
    )
}));
JS;
$this->registerJs($script);
