<?php

/* @var $this yii\web\View */
/* @var $model \frontend\models\SignupForm */
/* @var $form yii\widgets\ActiveForm */

use app\models\AuthAssignment;
use yii\helpers\Html;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;




$this->title = 'Registro de Usuario';
$this->params['breadcrumbs'][] = $this->title;
// Get the authorization manager
$auth = Yii::$app->authManager;
$userRoles = $auth->getRolesByUser(Yii::$app->user->id);
$allRoles = Yii::$app->authManager->getRoles();
$available_roles = $allRoles;
$roleParents = [];

// Get all parent roles
foreach ($userRoles as $userRole) {
    $role = Yii::$app->authManager->getRole($userRole->name);

    // Get all parent roles of this user role
    foreach ($allRoles as $r) {
        $children = Yii::$app->authManager->getChildren($r->name);
        foreach ($children as $child) {
            if ($child->name == $role->name) {
                $roleParents[] = $r->name;
                break;
            }
        }
    }
}

// Get all parent of parent roles
$roleParentParents = [];
foreach ($roleParents as $roleParent) {
    foreach ($allRoles as $r) {
        $children = Yii::$app->authManager->getChildren($r->name);
        foreach ($children as $child) {
            if ($child->name == $roleParent) {
                $roleParentParents[] = $r->name;
                break;
            }
        }
    }
}

// Remove all parent roles and parent of parent roles from available roles
$roleParents = array_merge($roleParents, $roleParentParents);
$roleParents = array_unique($roleParents);
foreach ($roleParents as $parentRole) {
    $index = array_search($parentRole, ArrayHelper::getColumn($available_roles, 'name'));
    if ($index !== false) {
        \yii\helpers\ArrayHelper::remove($available_roles, $index);
    }
}

// Map available roles to list data
$listData = ArrayHelper::map($available_roles, 'name', 'name');







?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [
                    [
                        'attributes' => [
                            'username' => [
                                'type' => Form::INPUT_TEXT,
                                'options' => ['placeholder' => 'Nombre del usuario'],
                                'columnOptions' => ['colspan' => '3']
                            ],
                        ]
                    ],
                    [
                        'attributes' => [
                            'rol_name' => [
                                'type' => Form::INPUT_RAW,
                                'value' => $form->field($model, 'rol_name')->widget(Select2::className(), [
                                    'data' => $listData,
                                    'options' => ['placeholder' => 'Seleccione un rol'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ]
                                ])
                            ],
                        ]
                    ],
                    [
                        'attributes' => [
                            'email' => [
                                'type' => Form::INPUT_TEXT,
                                'options' => ['placeholder' => 'Email del usuario'],
                                'columnOptions' => ['colspan' => '3']
                            ],
                        ]
                    ],
                    [
                        'attributes' => [
                            'password' => [
                                'type' => Form::INPUT_PASSWORD,
                                'options' => ['placeholder' => 'Contraseña del usuario'],
                                'columnOptions' => ['colspan' => '3']
                            ],
                        ]
                    ],
                    
                ]
            ])?>

              




                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>