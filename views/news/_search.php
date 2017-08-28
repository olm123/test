<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'status')->radioList([0 => 'Disabled', 1 => 'Active']) ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'full_text') ?>

    <div class="row">
    <?= $form->field($model, 'date_from', ['options' => ['class' => 'col-lg-6']]) ?>
    <?= $form->field($model, 'date_to', ['options' => ['class' => 'col-lg-6']]) ?>
    </div>
    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'author') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
