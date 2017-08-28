<?php
/**
 * Created by PhpStorm.
 * User: krm
 * Date: 28.08.2017
 * Time: 19:58
 */

namespace app\components;


use yii\web\IdentityInterface;

class User extends \yii\web\User
{
    public function login(IdentityInterface $identity, $duration = 0)
    {
        if (parent::login($identity, $duration)) {
            $identity->updateAttributes(['last_login_at' => time()]);
            return true;
        }
        return false;
    }
}