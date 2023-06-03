<?php

use common\models\OrderPaid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\OrderPaidSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var integer $total*/
$this->title = 'Тўловлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-paid-index">
    <div class="card">
        <div class="card-body">

            <?php  echo $this->render('_search_kassa', ['model' => $searchModel]); ?>
            <hr>
            <h4><?= 'Қидирув бўйича умумий тушум: '.intval($total). ' сўм'?></h4>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
        //        'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute'=>'order_id',
                        'value'=>function($model){
                            $url = Yii::$app->urlManager->createUrl(['/cp/order/view','id'=>$model->order_id]);
                            $order = $model->order;
                            return Html::a($order->code.'('.date('d.m.Y',strtotime($order->date)).')',$url);
                        },
                        'format'=>'raw',
                        'filter'=>false,
                    ],
                    'name',
                    [
                        'attribute'=>'user_id',
                        'value'=>function($model){
                            return $model->user->name;
                        },
                        'filter'=>false,
                    ],
                    'note:ntext',
                    'price:integer',
                    'date',
                    [
                        'attribute'=>'payment_id',
                        'value'=>function($model){
                            return $model->payment->name;
                        },
                        'filter'=>false,
                    ],
                    [
                        'attribute'=>'file',
                        'value'=>function($model){
                            return $model->file ? Html::a('Чек файли',['/uploads/'.$model->file],['target'=>'_blank']) : 'Мавжуд эмас';
                        },
                        'format'=>'raw',
                    ],
                ],
            ]); ?>


        </div>
    </div>
</div>
