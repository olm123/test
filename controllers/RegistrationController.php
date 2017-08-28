<?php

namespace app\controllers;

use app\models\User;
use app\traits\AjaxValidationTrait;
use app\models\RegistrationForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RegistrationController extends Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['register', 'confirm',], 'roles' => ['?']],
                ],
            ],
        ];
    }

    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegister()
    {
        /** @var RegistrationForm $loginModel */
        $model = \Yii::createObject(RegistrationForm::className());

        if ($model->load(\Yii::$app->request->post()) && $model->register()) {

            return $this->render('success');
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Confirms user's account. If confirmation was successful logs the user and shows success message. Otherwise
     * shows error message.
     *
     * @param int $id
     * @param string $code
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionConfirm($id, $code)
    {
        $user = User::findOne($id);

        if ($user === null) {
            throw new NotFoundHttpException();
        }


        $user->attemptConfirmation($code);

        return $this->render('/confirmed');
    }
}
