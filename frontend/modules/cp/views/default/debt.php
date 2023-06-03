<?php

use common\models\CLegal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CLegalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Yuridik shaxslar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clegal-index">
    <div class="card">
        <div class="card-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'name',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::a($model->name,Url::to(['view','id'=>$model->id]));
                }
            ],
            [
                'attribute'=>'debtor',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['/cp/order/index','OrderSearch[client_id]'=>$d->id]);
                    $debt = intval($d->debtor);
                    return "<a href='$url'>{$debt}</a>";
                },
                'format'=>'raw'
            ],
            [
                'attribute'=>'type_id',
                'value'=>function($d){
                    return $d->type->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\CType::find()->all(),'id','name')
            ],
            'address',
            'phone',
            'phone_name',
            //'created',
            'updated',
        ],
    ]); ?>


        </div>
    </div>
</div>
