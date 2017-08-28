<?php
/**
 * Created by PhpStorm.
 * User: Karim
 * Date: 28.08.2017
 * Time: 16:48
 */

namespace app\models;


use yii\base\Model;

class UserCreateForm extends Model
{
    public $email;
    public $password;
    public $is_confirmed;

    public function rules()
    {
        return [
            'emailTrim' => ['email', 'filter', 'filter' => 'trim'],
            'emailRequired' => ['email', 'required'],
            'emailPattern' => ['email', 'email'],
            'emailUnique' => [
                'email',
                'unique',
                'targetClass' => User::class,
            ],
            'passwordRequired' => ['password', 'required'],
            'passwordLength' => ['password', 'string', 'min' => 6, 'max' => 72],
            'isConfirmed' => ['is_confirmed', 'boolean']
        ];
    }

    public function create()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = new User();
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->confirmed_at = $this->is_confirmed ? time() : null;
        return $user->save();
    }
}