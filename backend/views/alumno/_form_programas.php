<?php
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use backend\helpers\HtmlHelpers;
use backend\models\EstadoPrograma;
use backend\models\EstadoTitulo;
use backend\models\Programa;

/* @var $form kartik\form\ActiveForm */
/* @var $model Alumno */
/** @var Programa[] $programas */

$programas = Programa::find()->all();
// var_dump($programas);
foreach($programas as $programa){
    $nombres_programa[] = $programa->nombre;
}
$estado_ps = EstadoPrograma::find()->all();
// var_dump($programas);
foreach($estado_ps as $estado_p){
    $estado_pro[] = $estado_p->desc;
}
$estado_ts = EstadoTitulo::find()->all();
// var_dump($programas);
foreach($estado_ts as $estado_t){
    $estado_titu[] = $estado_t->desc;
}
// var_dump($nombres_programa);

?>
<!-- Formulario -->
<div class="row">
    <div class="col-md-12">
        <h3>Programas</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table" id="programas-table">
            <thead>
                <tr>
                    <th>Programa</th>
                    <th>Cohorte</th>
                    <th>Estado del Programa</th>
                    <th>Estado del Titulo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="programa-row">
                    <td><?= Html::dropDownList('programa[]', null, $nombres_programa, ['class' => 'form-control programa-select', 'prompt' => 'Selecciona un programa']); ?></td>
                    <td><?= Html::textInput('cohorte[]', null, ['class' => 'form-control cohorte-input', 'placeholder' => 'Cohorte']); ?></td>
                    <td><?= Html::dropDownList('estadopro[]', null, $estado_pro, ['class' => 'form-control estadopro-select', 'prompt' => 'Selecciona un estado']); ?></td>
                    <td><?= Html::dropDownList('estadotitu[]', null, $estado_titu, ['class' => 'form-control estadotitu-select', 'prompt' => 'Selecciona un estado del titulo']); ?></td>
                    <td><?= Html::textInput('resolution[]', null, ['class' => 'form-control resolution-input', 'placeholder' => 'Resolucion']); ?></td>
                    <td><?= Html::textInput('fecha_resolucion[]', null, ['class' => 'form-control fecha_resolucion-input', 'placeholder' => 'Fecha de Resolucion']); ?></td>
                    <td><?= Html::textInput('promotion_year[]', null, ['class' => 'form-control promotion_year-input', 'placeholder' => 'Promocion']); ?></td>
                    <td><?= Html::textInput('seller[]', null, ['class' => 'form-control seller-input', 'placeholder' => 'Vendedor']); ?></td>
                    <td><?= Html::textInput('charge[]', null, ['class' => 'form-control charge-input', 'placeholder' => 'Cargo']); ?></td>
                    <td><?= Html::button('Eliminar', ['class' => 'btn btn-danger eliminar-programa']) ?></td>
                </tr>
            </tbody>
        </table>
        <div>
            <?= Html::button('Agregar Programa', ['class' => 'btn btn-primary agregar-programa']) ?>
            <?= Html::hiddenInput('programas-json', null, ['id' => 'programas-json']) ?>
        </div>
    </div>
</div>

<?php
$script = <<< JS
// Agregar fila al hacer clic en el botón
$('.agregar-programa').on('click', function() {
    var newRow = $('.programa-row:first').clone();
    newRow.find('input').val('');
    newRow.find('select').val(null);
    $('#programas-table tbody').append(newRow);
});

// Eliminar fila al hacer clic en el botón
$(document).on('click', '.eliminar-programa', function() {
    $(this).closest('.programa-row').remove();
});

// Actualizar el valor del input oculto al guardar el formulario
$('form').on('beforeSubmit', function() {
    var programas = [];
    $('.programa-row').each(function() {
        var programa = {
            nombre: $(this).find('.programa-select').val(),
            cohorte: $(this).find('.cohorte-input').val(),
            estadopro: $(this).find('.estadopro-select').val(),
            estadotitu: $(this).find('.estadotitu-select').val(),
            resolution: $(this).find('.resolution-input').val(),
            fecha_resolucion: $(this).find('.fecha_resolucion-input').val(),
            promotion_year: $(this).find('.promotion_year-input').val(),
            seller: $(this).find('.seller-input').val(),
            charge: $(this).find('.charge-input').val()
        };
        programas.push(programa);
    });
    $('#programas-json').val(JSON.stringify(programas));
    return true;
});
JS;

$this->registerJs($script);