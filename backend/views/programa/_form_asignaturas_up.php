<?php
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use backend\helpers\HtmlHelpers;

use backend\models\Asignatura;
use yii\helpers\ArrayHelper;
/* @var $form kartik\form\ActiveForm */
/* @var $model Alumno */
/** @var asignatura[] $asignaturas */

$asignaturas = Asignatura::find()->all();
// var_dump($asignaturas);
foreach($asignaturas as $asignatura){
    $nombres_asignatura[] = $asignatura->nombre;
}


$nombres_asignatura = [0 => 'Selecciona un asignatura'] + ArrayHelper::map(Asignatura::find()->all(), 'id', 'nombre');
?>
<!-- Formulario -->
<div class="row">
    <div class="col-md-12">
        <h3>asignaturas</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table" id="asignaturas-table">
            <thead>
                <tr>
                    <th>asignatura</th>
                   
                    <th></th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($asignatura_model as $index => $asignatura): ?>            
    <tr class="asignatura-row">
        <td><?= Html::dropDownList('asignatura[]', $asignatura->asignatura_id, $nombres_asignatura, ['class' => 'form-control asignatura-select', 'prompt' => 'Selecciona un asignatura']); ?></td>
       
        <td><?= Html::button('Eliminar', ['class' => 'btn btn-danger eliminar-asignatura']) ?></td>
    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <?= Html::button('Agregar asignatura', ['class' => 'btn btn-primary agregar-asignatura']) ?>
            <?= Html::hiddenInput('asignaturas-json', null, ['id' => 'asignaturas-json']) ?>
        </div>
    </div>
</div>

<?php
$script = <<< JS
// Agregar fila al hacer clic en el botón
$('.agregar-asignatura').on('click', function() {
    var newRow = $('.asignatura-row:first').clone();
    newRow.find('input').val('');
    newRow.find('select').val(null);
    $('#asignaturas-table tbody').append(newRow);
});

// Eliminar fila al hacer clic en el botón
$(document).on('click', '.eliminar-asignatura', function() {
    $(this).closest('.asignatura-row').remove();
});

// Actualizar el valor del input oculto al guardar el formulario
$('form').on('beforeSubmit', function() {
    var asignaturas = [];
    $('.asignatura-row').each(function() {
        var asignatura = {
            nombre: $(this).find('.asignatura-select').val(),
         
        };
        asignaturas.push(asignatura);
       
   
   
    });
    
    $('#asignaturas-json').val(JSON.stringify(asignaturas));
    console.log(JSON.stringify(asignaturas))
    return true;
});
JS;

$this->registerJs($script);