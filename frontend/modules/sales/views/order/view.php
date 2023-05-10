<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\order $model */

$this->title = date('d.m.Y',strtotime($model->date)).' - Код:'.$model->code;
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
                        <button value="<?= Yii::$app->urlManager->createUrl(['/sales/order/paid','id'=>$model->id])?>" class="btn btn-success paid">Тўловни киритиш</button>
                        <button value="<?= Yii::$app->urlManager->createUrl(['/sales/order/send','id'=>$model->id])?>" class="btn btn-info send">Буюртмани жўнатиш</button>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/sales/order/check','id'=>$model->id])?>" target="_blank" class="btn btn-secondary">Чекни кўриш</a>

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

                            <?= $this->render('_paid_his',['model'=>$model->paid])?>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    <!-- Modal -->
    <div class="modal fade" id="paidmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Тўлов қабул қилиш</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body paidmodal">

                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="sendmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Буюртмани жўнатиш</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body sendmodal">

                </div>

            </div>
        </div>
    </div>

<?php

    $this->registerJs("
        $('.paid').click(function(){
            var url = this.value;
            $('#paidmodal').modal('show').find('.modal-body.paidmodal').load(url);
        });
        $('.send').click(function(){
            var url = this.value;
            $('#sendmodal').modal('show').find('.modal-body.sendmodal').load(url);
        });
    ")

?>