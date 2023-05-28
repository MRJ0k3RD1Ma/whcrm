<?php

use common\models\order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/* @var $month integer*/
/* @var $year integer*/

$this->title = 'Ҳисоботлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 style="margin-top:25px; font-size: 18px;"><?= $year?> йил <?= Yii::$app->params['date'][$month]?> ойидаги: <b>Тушум</b>: <?= intval($tushim)?> сўм; <b>Қарз</b>: <?= intval($qarz)?> сўм</h5>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label style="width:100%">Ойни танланг
                                            <select name="month" class="form-control">
                                                <?php foreach(Yii::$app->params['date'] as $i=>$item):?>
                                                    <option value="<?=$i?>" <?= $month == $i ? 'selected' : ''?>><?=$item?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-5">
                                        <label style="width:100%">Йилни танланг
                                            <select name="year" id="year" class="form-control">
                                                <?php for($i=2023;$i<=date('Y');$i++):?>
                                                    <option value="<?=$i?>" <?= $year == date('Y') ? 'selected' : ''?>><?=$i?></option>
                                                <?php endfor;?>

                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" style="margin-top:20px;" class="btn btn-primary">OK</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">

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
                                }
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
                            //'type_id',
                            //
//            'is_delivery',
                            [
                                'attribute'=>'is_delivery',
                                'value'=>function($model){
                                    return Yii::$app->params['is_delivery'][$model->is_delivery];
                                },
                                'filter'=>Yii::$app->params['is_delivery']
                            ],
                            //'address',
                            //'localtion:ntext',
                            //'status_id',
                            [
                                'attribute' => 'status_id',
                                'value' => function($model){
                                    return $model->status->name;
                                },
                                'filter' => \yii\helpers\ArrayHelper::map(\common\models\OrderStatus::find()->all(), 'id', 'name')
                            ],
                            //'created',
                            //'updated',
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>
</div>
