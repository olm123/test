<?= 'Hello' ?>,


<?php if ($token !== null): ?>
    <?= 'In order to complete your registration, please click the link below' ?>.

    <?= \yii\helpers\Url::to(['//registration/confirm', 'id' => $token->user_id, 'code' => $token->code], true) ?>

    <?= 'If you cannot click the link, please try pasting the text into your browser' ?>.
<?php endif ?>

<?= 'If you did not make this request you can ignore this email' ?>.
