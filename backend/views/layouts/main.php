<?php

use kartik\growl\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    dmstr\web\AdminLteAsset::register($this);

    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        backend\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-green sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?php Pjax::begin(['id' => 'flash_message_id']); ?>
        <div>
            <!--Get all flash messages and loop through them-->
            <?php
            if (Yii::$app->controller->action->id != 'error-target') {
                foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
                    <?php
                    try {
                        echo Growl::widget([
                            'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
                            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
                            'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
                            'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
                            'showSeparator' => true,
                            'delay' => 1, //This delay is how long before the message shows
                            'pluginOptions' => [
                                'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
                                'placement' => [
                                    'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                                    'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                                ],
                                'showProgressbar' => false,
                            ]
                        ]);
                    } catch (Exception $e) {
                        $e->getMessage();
                    }

                    ?>
                <?php endforeach;
            } ?>
        </div>
        <?php Pjax::end(); ?>

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>

    <!-- Modal -->
    <?php
    Modal::begin([
        'id' => 'modal',
        'options' => ['tabindex' => false],
        'header' => '<h4 style="color: white; font-family: Helvetica Neue,Helvetica,Arial,sans-serif" class="modal-title">Modal</h4>',
//        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    ]);
    echo "<div class='well'></div>";

    Modal::end();
    ?>
<?php } ?>