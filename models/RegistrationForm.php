<?php

/*
 * This file is part of the EveRose project.
 *
 * (c) EveRose project <http://github.com/EveRose/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use app\models\User;
use Yii;
use yii\base\Model;
use yii\web\ServerErrorHttpException;

/**
 * Registration form collects user input on registration process, validates it and creates new User model.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationForm extends Model
{
    /**
     * @var string User email address
     */
    public $email;
    public $username;

    /**
     * @var string Password
     */
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'trimFields' => [['email', 'username'], 'filter', 'filter' => 'trim'],
            'requiredFields' => [['email', 'username', 'password'], 'required'],
            'emailPattern' => ['email', 'email'],
            'usernamePattern' => ['username', 'match', 'pattern' => '/^[a-zA-Z0-9]\w*$/i'],
            'emailUnique' => [
                'email',
                'unique',
                'targetClass' => User::class,
            ],
            'passwordLength' => ['password', 'string', 'min' => 6, 'max' => 72],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return 'register-form';
    }

    /**
     * Registers a new user account. If registration was successful it will set flash message.
     * @return bool
     * @throws ServerErrorHttpException
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = Yii::createObject(User::className());
        $this->loadAttributes($user);

        return $user->create();
    }

    /**
     * Loads attributes to the user model. You should override this method if you are going to add new fields to the
     * registration form. You can read more in special guide.
     *
     * By default this method set all attributes of this model to the attributes of User model, so you should properly
     * configure safe attributes of your User model.
     *
     * @param User $user
     */
    protected function loadAttributes(User $user)
    {
        $user->email = $this->email;
        $user->username = $this->username;
        $user->password = $this->password;
    }
}
