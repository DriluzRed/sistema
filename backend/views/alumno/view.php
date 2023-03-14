<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */

$this->title = $model->first_name . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="alumno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name:ntext',
            'last_name:ntext',
            'ci:ntext',
            [
                'attribute' => 'country_id',
                'value' => function ($model){
                        return $model->pais->nombre;
                }

            ],
            'low_line_number:ntext',
            'phone:ntext',
            'email:ntext',
            'address:ntext',
            'age:ntext',
            [
                'label' => 'Programas',
                'attribute' => 'programas',
                'value' => function ($model) {
                    $programas = '';
                    foreach ($model->alumnoProgramas as $alumnoPrograma) {
                        $programas .= $alumnoPrograma->programa->nombre . '<br>';
                    }
                    return $programas;
                },
                'format' => 'raw',
            ],
            'campus',
            'subsidiary',
            'year:ntext',
            [
                'label' => 'Año de Promocion',
                'attribute' => 'promotion_year',
                'value' => function ($model) {
                    $promotion_year = '';
                    foreach ($model->alumnoProgramas as $alumnoPrograma) {
                        $promotion_year .= $alumnoPrograma->promotion_year . '<br>';
                    }
                    return $promotion_year;
                },
                'format' => 'raw',
            ],
            // 'born_at:ntext',
            // 'promotion:ntext',
            // 'document_front_file:ntext',
            // 'document_back_file:ntext',
            'status:ntext',
            // 'study_certificate_file:ntext',
            
        ],
    ]) ?>

</div>
