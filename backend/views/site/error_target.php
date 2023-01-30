<?php
//En caso de error se cierra la ventana extra que se abrió con target blank
$js = <<<JS
window.close();
JS;

$this->registerJs($js);