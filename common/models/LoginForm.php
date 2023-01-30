<?php

namespace common\models;

use common\helpers\PermisosHelpers;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{

    public $username;
    public $password;
    public $rememberMe = false;
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Usuario'),
            'password' => Yii::t('app', 'Contraseña')
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Usuario o contraseña incorrecto.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        $this->rememberMe = ($this->rememberMe == '1') ? true : false;
        if ($this->validate()) {
            Yii::$app->session['usuario'] = $this->getUser();
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 365 * 10 : 0); // En 10 anhos
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function loginAdmin()
    {
//
        if (($this->validate()) && PermisosHelpers::requerirMinimoRol('Admin', $this->getUser()->id)) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

}
