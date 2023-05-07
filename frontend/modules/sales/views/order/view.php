<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\order $model */

$this->title = $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Буюртмалар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p>
                        <?= Html::a('Ўзгартириш', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <a href="#">Тўловни киритиш</a>
                        <a href="#">Статусни ўзгартириш</a>

                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
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
                                        }
                                    ],
//            'plan_id',
                                    [
                                        'attribute' => 'plan_id',
                                        'value' => function($model){
                                            return $model->plan->name;
                                        },
                                    ],
                                    'code',
                                    'price',
                                    'discount',
                                    'qqs',
                                    'debt',
//            'type_id',
                                    [
                                        'attribute'=>'type_id',
                                        'value'=>function($model){
                                            return $model->type->name;
                                        },
                                    ],
                                    //
//            'is_delivery',
                                    [
                                        'attribute'=>'is_delivery',
                                        'value'=>function($model){
                                            return Yii::$app->params['is_delivery'][$model->is_delivery];
                                        },
                                    ],
                                    //'address',
                                    //'localtion:ntext',
                                    //'status_id',
                                    [
                                        'attribute' => 'status_id',
                                        'value' => function($model){
                                            return $model->status->name;
                                        },
                                    ],
                                    //'created',
                                    //'updated',
//            'plan_id',
                                    [
                                        'attribute'=>'plan_id',
                                        'value'=>function($model){
                                            return $model->plan->name;
                                        },
                                    ],
//            'code',
//            'code_id',
//            'price',
//            'discount',
//            'qqs',
//            'debt',
//            'type_id',
//            'date',
//            'is_delivery',
                                    'address',
                                    'localtion:ntext',
//            'status_id',
                                    'created',
                                    'updated',
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-6">




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
