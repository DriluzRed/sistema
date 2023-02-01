<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m230201_124435_roles_permisos extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // permiso para crear alumnos
        $crearAlumno = $auth->createPermission('crearAlumno');
        $crearAlumno->description = 'Permiso para añadir alumnos al sistema';
        $auth->add($crearAlumno);

        // permiso para actualizar alumnos
        $actualizarAlumno = $auth->createPermission('actualizarAlumno');
        $actualizarAlumno->description = 'Permiso para actualizar alumnos en el sistema';
        $auth->add($actualizarAlumno);

        //permiso para borrar alumnos

        $borrarAlumno = $auth->createPermission('borrarAlumno');
        $borrarAlumno->description = 'Permiso para borrar alumnos en el sistema';
        $auth->add($borrarAlumno);


        // rol de coordinacion y se le da los permisos de actualizar y crear alumnos
        $coordinacion = $auth->createRole('coordinacion');
        $auth->add($coordinacion);
        $auth->addChild($coordinacion, $crearAlumno);
        $auth->addChild($coordinacion, $actualizarAlumno);

        // rol de administracion y se le da los permisos de actualizar y crear alumnos
        $administracion = $auth->createRole('administracion');
        $auth->add($administracion);
        $auth->addChild($administracion, $crearAlumno);
        $auth->addChild($administracion, $actualizarAlumno);
        
        // rol de direccion con todos los permisos que tenga coordinacion
        $direccion = $auth->createRole('direccion');
        $auth->add($direccion);
        $auth->addChild($direccion, $coordinacion);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $direccion);
        $auth->addChild($admin, $borrarAlumno);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($administracion, 3);
        $auth->assign($coordinacion, 3);
        $auth->assign($direccion, 2);
        $auth->assign($admin, 1);
    }
    
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}