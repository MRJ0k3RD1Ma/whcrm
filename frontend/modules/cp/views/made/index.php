<?php

use common\models\Made;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\MadeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ишлаб чиқарилган маҳсулотлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="made-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <a href="" class="btn btn-primary" data-method="post">Эхпорт</a>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'date',
            [
                'attribute'=>'date',
                'value'=>function($model){
                    $date = date('d.m.Y', strtotime($model->date));
                    return "<a href='".Url::to(['made/view', 'product_id'=>$model->product_id, 'user_id'=>$model->user_id,'date'=>$model->date])."'>$date</a>";
                },
                'format'=>'raw'
            ],
            [
                'attribute'=>'product_id',
                'value'=>function($model){
                    return $model->product->name;
                },
            ],
            [
                'attribute'=>'user_id',
                'value'=>function($model){
                    return $model->user->username;
                },
            ],
            'price',
            'cnt_price',
            'cnt',
            'box',
            'cnt_total',
            //'c_cnt_total',
            //'c_cnt',
            //'c_cnt_price',
            //'c_box',
            //'consept_id',
//            'status',
            [
                'attribute'=>'status',
                'value'=>function($model){
                    return Made::getStatus($model->status);
                },
            ],
            //'note:ntext',
            //'created',
            'updated',
            [
                'label'=>'Тасдиқлаш',
                'value'=>function($d){
                    if($d->status == 2){
                        return "<a href='".Url::to(['made/confirm', 'product_id'=>$d->product_id, 'user_id'=>$d->user_id,'date'=>$d->date])."' class='btn btn-success'>Тасдиқлаш</a>";
                    }else{
                        return '';
                    }
                },
                'format'=>'raw'
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
