<?php

namespace common\models;

use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $rol_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'rol_id', 'username', 'email', 'password_repeat'], 'required'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Este usuario ya existe'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['email', 'username'], 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Este correo ya existe'],
            [['rol_id'], 'integer'],
            ['password', 'string', 'min' => 6],
            [['rol_id'], 'in', 'range' => array_keys(User::getRolLista())],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Las contraseñas no coinciden",],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->email = $this->email;
        $user->rol_id = $this->rol_id;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

}
