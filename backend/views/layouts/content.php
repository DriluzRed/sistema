<?php

use yii\widgets\Breadcrumbs;

?>
    <div class="content-wrapper">
        <section class="content-header" style="color:#00177C;">
            <?php if (isset($this->blocks['content-header'])) { ?>
                <h1><?= $this->blocks['content-header'] ?></h1>
            <?php } else { ?>
                <h1>
                    <?php
                    if ($this->title !== null) {
                        echo \yii\helpers\Html::encode($this->title);
                    } else {
                        echo \yii\helpers\Inflector::camel2words(
                            \yii\helpers\Inflector::id2camel($this->context->module->id)
                        );
                        echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                    } ?>
                </h1>
            <?php } ?>

            <?=
            Breadcrumbs::widget(
                [
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]
            ) ?>
        </section>

        <section class="content">
            <!--        --><? //= Alert::widget() ?>
            <?= $content ?>
        </section>
    </div>

<?php
$version = '1.0';
$anho = date('Y');
?>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> <?= $version ?>
        </div>
        <strong>Copyright <?= $anho ?> <a href="http://www.driluzred.com/">DriluzRed </a></strong> Todos los derechos
        reservados
        | Desarrollado para <a href="http://www.driluzred.com/">FOTRIEM</a>
    </footer>

    <!-- Control Sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class='control-sidebar-bg'></div>


<?php

$CSS = <<<CSS

.content{
   background:#ffffff;
    min-height:805px;
    margin-top:1%;

    /* background-image: url('../web/img/Logo-Fotriem-Blanco.png');
   background-attachment: fixed;
   background-position: center center;
   background-size: cover; 
    */

}
/*This is modifying the btn-primary colors but you could create your own .btn-something class as well*/
.content-wrapper{
    background-color:#f1f5f9;

}
.btn-primary{
    color: #000000;
    background-color: #e3e3e3;
    border-color: #357ebd; /*set the color you want here*/
}
.btn-primary:focus {
    color: #000000;
    background-color: #fafafa;
    border-color: #357ebd; /*set the color you want here*/
}
.btn-primary:hover, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
    color: #fff;
    background-color: #3c8dbc;
    border-color: #357ebd; /*set the color you want here*/
}

.btn-success {
    color: #000000;
    background-color: #e3e3e3;
    border-color: #1F396A; /*set the color you want here*/
}

.btn-success:focus {
    color: #000000;
    background-color: #fafafa;
    border-color: #1F396A   ; /*set the color you want here*/
}
.btn-success:hover, .btn-success:active, .btn-success.active, .open > .dropdown-toggle.btn-success {
    color: #fff;
    background-color: #1F396A;
    border-color: #1F396A; /*set the color you want here*/
}

.btn-danger {
    color: #000000;
    background-color: #e3e3e3;
    border-color: #d73925; /*set the color you want here*/
}
.btn-danger:focus {
    color: #000000;
    background-color: #fafafa;
    border-color: #d73925; /*set the color you want here*/
}
.btn-danger:hover, .btn-danger:active, .btn-danger.active, .open > .dropdown-toggle.btn-danger {
    color: #fff;
    background-color: #dd4b39;
    border-color: #d73925; /*set the color you want here*/
}
/*.btn-danger:focus {*/
    /*color: #fff;*/
    /*font-weight: bold;*/
    /*background-color: #ff6653;*/
    /*border-color: #e53e22; !*set the color you want here*!*/
/*}*/

.btn-info {
    color: #000000;
    background-color: #e3e3e3;
    border-color: #00acd6; /*set the color you want here*/
}
.btn-info:focus {
    color: #000000;
    background-color: #fafafa;
    border-color: #00acd6; /*set the color you want here*/
}
.btn-info:hover, .btn-info:active, .btn-info.active, .open > .dropdown-toggle.btn-info {
    color: #fff;
    background-color: #00c0ef;
    border-color: #00acd6; /*set the color you want here*/
}

.btn-warning {
    color: #000000;
    background-color: #e3e3e3;
    border-color: #e08e0b; /*set the color you want here*/
}
.btn-warning:focus {
    color: #000000;
    background-color: #fafafa;
    border-color: #e08e0b; /*set the color you want here*/
}
.btn-warning:hover, .btn-warning:active, .btn-warning.active, .open > .dropdown-toggle.btn-warning {
    color: #fff;
    background-color: #f39c12;
    border-color: #e08e0b; /*set the color you want here*/
}

/* Para mouseover sobre las tablas */

.kv-grid-table tbody tr:hover {
    background-color: #D4EBFF;
}

.table tbody tr:hover {
    background-color: #D4EBFF;
}

CSS;

$this->registerCss($CSS);

?>