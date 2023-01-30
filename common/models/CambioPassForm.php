<?php
namespace common\models;
use yii\base\Model;

/**
 * Signup form
 */
class CambioPassForm extends Model {

    public $username;
    public $password_old;
    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['password', 'required'],
            ['password_repeat', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Las contraseñas no coinciden", ],  
        ];
    }

    /**
     * Signs user up.
     *
     * @param bool $oldPass
     * @return false|true true o false dependiendo si cambio o no el password
     */
    public function cambiarPass($oldPass=false) {
        if (!$this->validate()) {
            return false;
        }
        $user = User::findByUsername($this->username);
        if($oldPass!=false and !$user->validatePassword($oldPass)){
            $this->addError('$password_old', "Contraseña actual erronea");
            return false;
        }
        $user->setPassword($this->password);
        return $user->save() ? true : false;
    }

}
