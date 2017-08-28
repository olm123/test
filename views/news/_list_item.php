<?php
/**
 * Created by PhpStorm.
 * User: krm
 * Date: 28.08.2017
 * Time: 22:22
 */

use yii\helpers\Html;

/**
 * @var $model \app\models\News
 */
?>
<div>
    <h2>
    <?= Html::encode($model->name)?>
    </h2>
    <div><?= \Yii::$app->formatter->asDate($model->created_at)?></div>
    <div>
    <?php if ($model->canUpdate(\Yii::$app->user)): ?>
        <?php
        echo Html::a($model->status ? 'Disable' : 'Activate' , ['/news/change-status', 'id' => $model->id, 'value' => !$model->status], ['class' => 'btn btn-link']);
        yii\bootstrap\Modal::begin([
            'id' => "modal-update-{$model->id}",
            'header' => '<h2>Update news</h2>',
            'toggleButton' => [
                'label' => 'Update',
                'class' => 'btn btn-link',
            ]
        ]);
        echo $this->render('update', ['model' => $model]);
        yii\bootstrap\Modal::end();
        ?>
    <?php endif; ?>
    </div>
    <p>
    <?= Html::encode($model->preview_text)?>
    </p>
    <?= !\Yii::$app->user->isGuest ? Html::a('Read more', ['view', 'id' => $model->id]) : '' ?>
</div>

