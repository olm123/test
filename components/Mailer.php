<?php

/*
 * This file is part of the EveRose project.
 *
 * (c) EveRose project <http://github.com/EveRose/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\components;

use app\models\Token;
use app\models\User;
use Yii;
use yii\base\Component;

/**
 * Mailer.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Mailer extends Component
{
    /** @var string */
    public $viewPath = '@app/views/mail';

    /** @var string|array Default: `Yii::$app->params['adminEmail']` OR `no-reply@example.com` */
    public $sender;

    /**
     * Sends an email to a user after registration.
     *
     * @param User $user
     * @param Token $token
     *
     * @return bool
     */
    public function sendWelcomeMessage(User $user, Token $token = null)
    {
        return $this->sendMessage(
            $user->email,
            'Welcome to ' . Yii::$app->name,
            'welcome',
            ['token' => $token,]
        );
    }

    /**
     * @param string $to
     * @param string $subject
     * @param string $view
     * @param array $params
     *
     * @return bool
     */
    protected function sendMessage($to, $subject, $view, $params = [])
    {
        /** @var \yii\mail\BaseMailer $mailer */
        $mailer = Yii::$app->mailer;
        $mailer->viewPath = $this->viewPath;
        $mailer->getView()->theme = Yii::$app->view->theme;

        if ($this->sender === null) {
            $this->sender = isset(Yii::$app->params['adminEmail']) ?
                Yii::$app->params['adminEmail']
                : 'no-reply@example.com';
        }

        return $mailer->compose(['html' => $view, 'text' => 'text/' . $view], $params)
            ->setTo($to)
            ->setFrom($this->sender)
            ->setSubject($subject)
            ->send();
    }
}
