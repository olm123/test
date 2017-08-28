<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        yii\bootstrap\Modal::begin([
            'id' => "modal-create",
            'header' => '<h2>Hello world</h2>',
            'toggleButton' => [
                'label' => 'Create User',
                'class' => 'btn btn-success'
            ]
        ]);
        echo $this->render('create', ['model' => $newUser]);
        yii\bootstrap\Modal::end();
        ?>

    </p>
    <?php
    foreach ($dataProvider->getModels() as $model) {
        yii\bootstrap\Modal::begin([
            'id' => "modal-{$model->id}",
            'header' => '<h2>Hello world</h2>',
        ]);
        echo $this->render('update', ['model' => $model]);
        yii\bootstrap\Modal::end();
    }
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter' => true,
            ],
            [
                'attribute' => 'username',
                'filter' => true,
            ],
            [
                'attribute' => 'email',
                'format' => 'email',
                'filter' => true,
            ],
            [
                'attribute' => 'last_login_at',
                'label' => 'Registration date',
                'format' => 'html',
                'value' => function ($model) {
                    return \Yii::$app->formatter->asDate($model->created_at, 'full');
                },
                'filter' => false,
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Last login date',
                'format' => 'html',
                'value' => function ($model) {
                    return \Yii::$app->formatter->asDate($model->last_login_at, 'full');
                },
                'filter' => false,
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($action, $model) {
                        return Html::button('update', ['data' => ['toggle' => 'modal', 'target' => "#modal-{$model->id}"]]);
                    }
                ],
                'template' => '{update}'
            ],
        ],
    ]); ?>
</div>
