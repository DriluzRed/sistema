<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m230202_130428_rol_alumno extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $auth->addChild('admin', 'crearAdmin');
        $auth->addChild('admin', 'crearDirector');
        $auth->addChild('director', 'crearDirector');


    }
    
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}

