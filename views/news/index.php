<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $newModel app\models\News */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if (\Yii::$app->user->can('manager')) {
            yii\bootstrap\Modal::begin([
                'id' => "modal-create",
                'header' => '<h2>Create news</h2>',
                'toggleButton' => [
                    'label' => 'Create News',
                    'class' => 'btn btn-success'
                ]
            ]);
            echo $this->render('create', ['model' => $newModel]);
            yii\bootstrap\Modal::end();
        }
        ?>
    </p>
    <?php Pjax::begin(['timeout' => 3000, 'enablePushState' => false]); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_list_item', ['model' => $model]);
        },
    ]) ?>
    <?php Pjax::end(); ?></div>
