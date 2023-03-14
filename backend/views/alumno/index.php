<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\AlumnoPrograma;
use backend\models\EstadoPrograma;
use backend\models\EstadoTitulo;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchAlumnos */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alumnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
   
    <p>
        <?= Html::a('Añadir nuevo alumno', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('Limpiar filtros', ['class' => 'btn btn-default', 'id' => 'clear-filters-btn']) ?>

    </p>
    <?php
    $template = '';
    $template = $template . '{view}';
    $template = $template . '{update}';
    (\Yii::$app->user->can('borrarAlumno')) ?  $template = $template . '{delete}':  '';
    /** @var Alumno $model */
    echo GridView::widget([
        'tableOptions' => [
            'class' => 'table table-striped',
        ],
        'options' => [
            'class' => 'table-responsive',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           [
                'attribute' => 'first_name',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="grid-item">' . $model->first_name . '</div> ';
                },
            ],
            [
                'attribute' => 'last_name',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="grid-item">' . $model->last_name . '</div> ';
                },
            ],
            [
                'attribute' => 'sex',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="grid-item">' . $model->sex . '</div> ';
                },
            ],
            [
                'attribute' => 'ci',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="grid-item">' . $model->ci . '</div> ';
                },
            ],
            [
                'attribute' => 'phone',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="grid-item">' . $model->phone . '</div> ';
                },
            ],  
            // [
            //     'label' => 'Pais',
            //     'attribute' => 'programas',
            //     'value' => 'programas.nombre',
            // ],
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
                'contentOptions' => ['style' => 'border-bottom: solid 1px black;']
            ],
            [
                'label' => 'Cohorte',
                'attribute' => 'cohorte',
                'value' => function ($model) {
                    $cohorte = '';
                    foreach ($model->alumnoProgramas as $alumnoPrograma) {
                        $cohorte .= $alumnoPrograma->cohort . '<br>';
                    }
                    return $cohorte;
                },
                'format' => 'raw',
                'filter' => ArrayHelper::merge(['' => 'Todos los Cohortes'], ArrayHelper::map(AlumnoPrograma::find()->distinct()->select('cohort')->where(['>=', 'cohort', 2000])->orderBy('cohort')->asArray()->all(), 'cohort', 'cohort')),
                'filterInputOptions' => ['class' => 'form-control', 'prompt' => 'Selecciona Cohorte', 'style' => 'width: 100%'],
                'contentOptions' => ['style' => 'border-bottom: solid 1px black;']
            ],
            [
                'attribute' => 'year',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="grid-item">' . $model->year . '</div> ';
                },
            ], 
         
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
             
                'filter' => ArrayHelper::merge(['' => 'Todos los Años'], ArrayHelper::map(AlumnoPrograma::find()->distinct()->select('promotion_year')->where(['>=', 'promotion_year', 2000])->orderBy('promotion_year')->asArray()->all(), 'promotion_year', 'promotion_year')),
                'filterInputOptions' => ['class' => 'form-control', 'prompt' => 'Selecciona el Año', 'style' => 'width: 100%'],
                'contentOptions' => ['style' => 'border-bottom: solid 1px black;']
            ],
            // 'promotion:ntext',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="grid-item">' . $model->status . '</div> ';
                },
            ],
            [
                'label' => 'Estado del programa',
                'attribute' => 'estado_programa',
                'value' => function ($model) {
                    $estado_programa_nombre = '';
                    foreach ($model->alumnoProgramas as $alumnoPrograma) {
                        if(isset($alumnoPrograma->estadoPrograma)){
                            $estado_programa_nombre .= $alumnoPrograma->estadoPrograma['desc'] . '<br>';
                        }
                        
                    }
                    return $estado_programa_nombre;
                },
                'format' => 'raw',
                'filter' => ArrayHelper::merge(['' => 'Todos los Estados'], ArrayHelper::map(EstadoPrograma::find()->orderBy('desc')->asArray()->all(), 'desc', 'desc')),
                'filterInputOptions' => ['class' => 'form-control', 'prompt' => 'Selecciona el Estado', 'style' => 'width: 100%'],
                'contentOptions' => ['style' => 'border-bottom: solid 1px black;']
            ],
            [
                'label' => 'Estado del titulo',
                'attribute' => 'estado_titulo',
                'value' => function ($model) {
                    $estado_titulo = '';
                   
                        foreach ($model->alumnoProgramas as $alumnoPrograma) {
                            if(isset($alumnoPrograma->estadoTitulo)){
                                $estado_titulo .= $alumnoPrograma->estadoTitulo['desc'] . '<br>';
                            }
                            
                        }
                      

                    return $estado_titulo;
                },
                'format' => 'raw',
                'filter' => ArrayHelper::merge(['' => 'Todos los Estados'], ArrayHelper::map(EstadoTitulo::find()->orderBy('desc')->asArray()->all(), 'desc', 'desc')),
                'filterInputOptions' => ['class' => 'form-control', 'prompt' => 'Selecciona el Estado', 'style' => 'width: 100%']
            ],
            ['class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:100px'],
                'buttonOptions' => ['class' => 'btn btn-default'],
                'header' => 'Acciones',
                'template' => $template,
            ],
        ],
        
    ]); ?>
<?php Pjax::end(); ?>

<?php
    $clearFiltersUrl = Url::to(['index']);
    $js = <<<JS
        $('#clear-filters-btn').click(function() {
            window.location.href = '{$clearFiltersUrl}';
        });
JS;
    $this->registerJs($js);
    ?>
</div>
