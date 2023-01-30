<?php

use common\helpers\PermisosHelpers;


?>
<aside class="main-sidebar">
    <section class="sidebar">
        <?php
        $menuItems[] = ['label' => 'Inicio',
            'url' => 'index.php',
            'icon' => 'fa fa-gear',
        ];
        $items = [];
        array_push($items, ['label' => 'Alumnos', 'url' => ['alumno/index'], 'icon' => 'fa fa-building', 'active' => \Yii::$app->controller->id == 'alumno']);
        array_push($items, ['label' => 'Asignaturas', 'url' => ['asignatura/index'], 'icon' => 'fa fa-building', 'active' => \Yii::$app->controller->id == 'asignatura']);
        if (class_exists('\backend\controllers\MainModule')) {
            $itemsGeneral = \backend\controllers\MainModule::getMenuItems();
            if (!empty($itemsGeneral)) {
                $menuItems[] = [
                    'icon' => 'fa fa-gear',
                    'label' => 'Administracion',
                    'items' => $itemsGeneral,
                    'url' => '#'
                ];
            }
        }
        try {
            echo dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => $menuItems,
                ]
            );
        } catch (Exception $e) {
        }
        ?>
    
    </section>
</aside>
