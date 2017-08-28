<?php
/**
 * Created by PhpStorm.
 * User: krm
 * Date: 28.08.2017
 * Time: 21:42
 */

namespace app\commands;


use app\models\User;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "author" role and give this role the "createPost" permission
        $manager = $auth->createRole('manager');
        $auth->add($manager);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manager);
    }

    public function actionAssign($role, $user_id)
    {
        $auth = Yii::$app->authManager;
        $adminRole = $auth->getRole($role);
        $auth->assign($adminRole, $user_id);
    }
}