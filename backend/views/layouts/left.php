<?php

use common\helpers\PermisosHelpers;


?>
<aside class="main-sidebar side-barA">
    <section class="sidebar">
        <?php
        $menuItems[] = ['label' => 'Inicio',
            'url' => 'index.php',
            'icon' => 'fa fa-gear',
            'options' =>['class'=>'tarjetas'],
        ];
        if (class_exists('\backend\controllers\MainModule')) {
            $itemsGeneral = \backend\controllers\MainModule::getMenuItems();
            if (!empty($itemsGeneral)) {
                $menuItems[] = [
                    'icon' => 'fa fa-gear',
                    'label' => 'Administracion',
                    'items' => $itemsGeneral,
                    'url' => '#',
                    'options' =>['class'=>'borde'],
                ];
            }
        }
        try {
            echo dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu '],
                    'items' => $menuItems,
                ]
            );
        } catch (Exception $e) {
        }
        ?>
    
    </section>
</aside>

<?php

$CSS = <<<CSS
/*This is modifying the btn-primary colors but you could create your own .btn-something class as well*/
.side-barA{
    background-color: #0f172a   ;
    color: white;
}
.tarjetas  a{
    color: #64748b;
}
.tarjetas:hover{
    background-color: #94a3b8;
    transition: 0.5s;
    border-radius: 5px;
    color: #fff;
    
}
.tarjetas:hover a{
    color: #fff;
}
.borde:hover{
    border: 1px solid #94a3b8;
    }
    .borde a{
        color: #64748b;

    }
CSS;

$this->registerCss($CSS);
