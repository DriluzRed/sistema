<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SearchUser */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
$btnClass='btn btn-default btn-xs custom_button';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
       
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $url = 'index.php?r=user/view&id='.$model->id;
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,  ['class' => 'btn btn-default btn-xs custom_button']);
                    },
                    'update'=>function ($url, $model) {
                        $url = 'index.php?r=user/update&id='.$model->id;
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,  ['class' => 'btn btn-default btn-xs custom_button']);
                    },
                    'delete'=>function ($url, $model) {
                        $t = 'index.php?r=user/delete&id='.$model->id;
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,  ['class' => 'btn btn-default btn-xs custom_button',

                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'data-method'  => 'post',
                ]);
                    },
                ]
            ],
            [
                'label' => 'ID',
                'headerOptions' => [
                    'width' => '5%'
                ],
                'value' => 'id',
                'attribute' => 'id',
            ],
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            //'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',

           
        ],
    ]); ?>
</div>
