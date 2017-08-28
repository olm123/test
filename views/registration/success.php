<?php
/**
 * Created by PhpStorm.
 * User: Karim
 * Date: 28.08.2017
 * Time: 15:34
 */
use yii\bootstrap\Alert;

$this->title = 'Your account has been created';
?>

<?php echo Alert::widget([
    'options' => [
        'class' => 'alert-info',
    ],
    'body' => 'Your account has been created and a message with instructions has been sent to your email',
]);
