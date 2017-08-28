<?php
/**
 * Created by PhpStorm.
 * User: Karim
 * Date: 28.08.2017
 * Time: 15:48
 */

use yii\helpers\Html;

$this->title = 'Account confirmation';
?>
<div>
    <?= ($success) ? 'Thank you, registration is now complete.' . ' ' . Html::a('Sign in', \Yii::$app->user->loginUrl) : 'The confirmation link is invalid or expired. Please try requesting a new one.'; ?>
</div>
