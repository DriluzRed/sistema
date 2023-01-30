<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\helpers\PermisosHelpers;

//use backend\assets\FontAwesomeAsset;
/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
//FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" 
              content="width=device-width, 
              initial-scale=1">
              <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            if (!Yii::$app->user->isGuest) {
                
                NavBar::begin([
                    'brandLabel' => 'Administracion de Sistema <i class="fa fa-plug"></i>',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);
            } else {
                NavBar::begin([
                    'brandLabel' => 'Administracion <i class="fa fa-plug"></i>',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);
            }
            $menuItems[] = ['label' => 'Volver', 'url' => ['../frontend/']];
            $menuItems [] = ['label' => 'Inicio',
                'url' => 'index.php',
                'icon' => 'fa-list-alt',
                'template' => '<a href="{url}>Sistema</a>',
            ];
            if (!Yii::$app->user->isGuest && $es_admin) {
                $menuItems[] = ['label' => 'Usuarios', 'items' => [
                        ['label' => 'Usuarios', 'url' => ['usuario/index']],
                        ['label' => 'Roles', 'url' => ['rol/index']],
                        ['label' => 'Tipos de Usuario', 'url' => ['tipo-usuario/index']],
                        ['label' => 'Estados', 'url' => ['estado/index']],
                ]];
            }
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Iniciar', 'url' => ['site/login']];
            } else {
                $menuItems[] = ['label' => '|  Hola ' . Yii::$app->user->identity->username, 'items' => [
                        ['label' => 'Perfil', 'url' => ['perfil/view']],
//                        ['label' => 'Sistema', 'url' => ['/site/index']],
                        ['label' => 'Cerrar sesion', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ]];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>
            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ?
                            $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Copyrigth <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>