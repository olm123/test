<?php
/**
 * Created by PhpStorm.
 * User: Karim
 * Date: 28.08.2017
 * Time: 16:48
 */

namespace app\models;


use yii\base\Model;

class UserForm extends Model
{
    public $email;
    public $username;
    public $password;
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user, array $config = [])
    {
        $this->user = $user;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            'emailTrim' => ['email', 'filter', 'filter' => 'trim'],
            'emailRequired' => ['email', 'required'],
            'emailPattern' => ['email', 'email'],
            'uniqueFields' => [
                ['email', 'username'],
                'unique',
                'targetClass' => User::class,
                'when' => function($attribute) {
                    return $this->{$attribute} !== $this->getUser()->{$attribute};
                }
            ],
            'passwordRequired' => ['password', 'required'],
            'passwordLength' => ['password', 'string', 'min' => 6, 'max' => 72],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = $this->getUser();
        $user->email = $this->email;
        $user->password = $this->password;
        return $user->save();
    }

    private function getUser()
    {
        return $this->user;
    }
}