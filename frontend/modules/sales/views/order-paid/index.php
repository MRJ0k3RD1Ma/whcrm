<?php

use common\models\OrderPaid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\OrderPaidSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Order Paids';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-paid-index">
    <div class="card">
        <div class="card-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'order_id',
                'value'=>function($model){
                    $url = Yii::$app->urlManager->createUrl(['/sales/order/view','id'=>$model->order_id]);
                    return $model->order->code;
                },
                'filter'=>false,
            ],
            'name',
            'user_id',
            'note:ntext',
            //'file',
            //'price',
            //'date',
            //'consept_id',
            //'created',
            //'updated',
            //'status_id',
            //'payment_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, OrderPaid $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'order_id' => $model->order_id]);
                 }
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
