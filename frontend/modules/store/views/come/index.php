<?php

use common\models\Come;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ComeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Comes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="come-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Кирим қилиш', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'date',
            [
                'attribute' => 'date',
                'value' => function (Come $model) {
                    $date = Yii::$app->formatter->asDate($model->date, 'php:d.m.Y');
                    return "<a href='" . Url::to(['view', 'id' => $model->id]) . "'>$date</a>";
                },
                'format' => 'raw',
            ],
//            'supplier_id',
            [
                'attribute' => 'supplier_id',
                'value' => function (Come $model) {
                    return $model->supplier->name;
                },
                'filter' => \common\models\Supplier::getSuppliers(),
            ],
            'note',
//            'creator_id',
            [
                'attribute' => 'creator_id',
                'value' => function (Come $model) {
                    return $model->creator->name;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'name')
            ],
            //'status',
            [
                'attribute' => 'status',
                'value' => function (Come $model) {
                    return Yii::$app->params['status.come'][$model->status];
                },
            ],
            'created',
            //'updated',
        ],
    ]); ?>


        </div>
    </div>
</div>
