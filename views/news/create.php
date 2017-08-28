<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\News */

?>
<div class="news-create">

    <?= $this->render('_form', [
        'model' => $model,
        'url' => \yii\helpers\Url::to(['/news/create']),
    ]) ?>

</div>
