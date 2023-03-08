<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchAlumnos */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carrera de grado';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir nuevo alumno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $template = '';
    $template = $template . '{view}';
    $template = $template . '{update}';
    $template = $template . '{delete}';
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
        'rowOptions' => function ($model) {
            return ['class' => 'grid-row'];
        },
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
            //     'value' => 'programas.nombre',
            // ],
            [
                'label' => 'Programas',
                'attribute' => 'programas',
                'value' => function ($model) {
    $programas = '';
    foreach ($model->alumnoProgramas as $alumnoPrograma) {
        if (strpos($alumnoPrograma->programa->nombre, 'Carrera') !== false) {
            $programas .= '<div class="grid-item">' . $alumnoPrograma->programa->nombre . '</div> ';
        }
    }
    return $programas;
},

                'format' => 'raw',
            ],
            [
                'label' => 'Cohorte',
                'attribute' => 'cohorte',
                'value' => function ($model) {
                    $cohorte = '';
                    foreach ($model->alumnoProgramas as $alumnoPrograma) 
                    {
                        if (strpos($alumnoPrograma->programa->nombre, 'Carrera') !== false) {
                        $cohorte .= '<div class="grid-item">' . $alumnoPrograma->cohort . '</div> ';
                        }
                    }
                    return $cohorte;
                },
                'format' => 'raw',
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
                        if (strpos($alumnoPrograma->programa->nombre, 'Carrera') !== false) {
                        $promotion_year .= '<div class="grid-item">' . $alumnoPrograma->promotion_year . '</div> ';
                        }
                    }
                    return $promotion_year;
                },
                'format' => 'raw',
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
                        if(isset($alumnoPrograma->estadoPrograma) && strpos($alumnoPrograma->programa->nombre, 'Carrera') !== false){
                            $estado_programa_nombre .= '<div class="grid-item">' . $alumnoPrograma->estadoPrograma['desc'] . '</div> ';
                        }
                    }
                    return $estado_programa_nombre;
                },
                'format' => 'raw',
            ],
            
            [
                'label' => 'Estado del titulo',
                'attribute' => 'estado_titulo',
                'value' => function ($model) {
                    $estado_titulo = '';
                   
                        foreach ($model->alumnoProgramas as $alumnoPrograma) {
                            if(isset($alumnoPrograma->estadoTitulo)){
                                $estado_titulo .= '<div class="grid-item">' . $alumnoPrograma->estadoTitulo['desc'] . '</div> ';
                            }
                            
                        }
                      

                    return $estado_titulo;
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:100px'],
                'buttonOptions' => ['class' => 'btn btn-default'],
                'header' => 'Acciones',
                'template' => $template,
            ],
        ],
        
    ]); 
    
    
    $CSS = <<<CSS
/*This is modifying the btn-primary colors but you could create your own .btn-something class as well*/

.grid-item {
        height: 60px; // set a fixed height for the divs
        padding: 5px 10px;
        margin-top: 10px;
        overflow: hidden; // hide any overflow text
        text-overflow: ellipsis; // add ellipsis if the text overflows
        white-space: nowrap; // prevent text from wrapping
        position: absolute;
    }
    grid-view tbody tr td {
  position: relative; /* make the td element positioned relatively */
}

.grid-item hr.ache {
  position: absolute; /* make the hr element positioned absolutely */
  bottom: 0; /* position the hr element at the bottom of the container */
  left: 0; /* position the hr element at the left of the container */
  width: 100%; /* set the width of the hr element to 100% of the container */
  margin: 0; /* remove any margins */
}

.ache {
  border: none;
  border-top: 1px solid #d7d8d9;
  height: 1px;
  margin: 0;
  padding: 0;
}


CSS;

$this->registerCss($CSS);

    
    ?>
</div>


