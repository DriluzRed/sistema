<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m230202_130428_rol_alumno extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
// permiso para crear alumnos
$crearAdmin = $auth->createPermission('crearAdmin');
$crearAdmin->description = 'Permiso para añadir admins';
$auth->add($crearAdmin);

// permiso para actualizar alumnos
$crearDirector = $auth->createPermission('crearDirector');
$crearDirector->description = 'Permiso para crear Directores';
$auth->add($crearDirector);

//permiso para borrar alumnos

$crearCoordinacion = $auth->createPermission('crearCoordinacion');
$crearCoordinacion->description = 'Permiso para crear coordinadores';
$auth->add($crearCoordinacion);


    }
    
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}

