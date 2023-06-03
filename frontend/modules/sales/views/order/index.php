<?php

use common\models\order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Буюртмалар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p>
                        <?= Html::a('Буюртма қабул қилиш', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute'=>'code',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return Html::a($model->code, Url::toRoute(['order/view', 'id' => $model->id]));
                                }
                            ],
                            [
                                'attribute'=>'date',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return date('d.m.Y', strtotime($model->date));
                                }
                            ],
                            [
                                'attribute' => 'client_id',
                                'format'=>'raw',
                                'value' => function($model){
                                    return Html::a($model->client->name, Url::toRoute(['c-legal/view', 'id' => $model->client_id]));
                                }
                            ],
//            'user_id',
                            [
                                'attribute' => 'user_id',
                                'format'=>'raw',
                                'value' => function($model){
                                    return Html::a($model->user->name, Url::toRoute(['user/view', 'id' => $model->user_id]));
                                },
                                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\CLegal::find()->all(),'id','name'),
                            ],
//            'plan_id',
                            [
                                'attribute' => 'plan_id',
                                'value' => function($model){
                                    return $model->plan->name;
                                },
                                'filter' => \yii\helpers\ArrayHelper::map(\common\models\PaymentPlan::find()->all(), 'id', 'name')
                            ],
                            //'code_id',
                            'price:integer',
                            //'discount',
                            //'qqs',
                            'debt:integer',
                            [
                                'attribute'=>'is_delivery',
                                'value'=>function($model){
                                    return Yii::$app->params['is_delivery'][$model->is_delivery];
                                },
                                'filter'=>Yii::$app->params['is_delivery']
                            ],
                            [
                                'attribute' => 'status_id',
                                'value' => function($model){
                                    return $model->status->name;
                                },
                                'filter' => \yii\helpers\ArrayHelper::map(\common\models\OrderStatus::find()->all(), 'id', 'name')
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>


</div>
