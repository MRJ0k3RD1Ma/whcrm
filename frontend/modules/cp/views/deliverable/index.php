<?php

use common\models\Deliverable;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\DeliverableSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mahsulot yetkazuvchilar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deliverable-index">
    <div class="card">
        <div class="card-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'product_id',
            [
                'attribute'=>'product_id',
                'value'=>function($model){
                    return "<a href='".Url::toRoute(['product/view', 'id' => $model->product_id])."'>".$model->product->name."</a>";
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Product::find()->all(), 'id', 'name'),
                'format'=>'raw'
            ],
//            'supplier_id',
            [
                 'attribute'=>'supplier_id',
                    'value'=>function($model){
                        return "<a href='".Url::toRoute(['c-legal/view', 'id' => $model->supplier_id])."'>".$model->supplier->name."</a>";
                    },
                    'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Supplier::find()->all(), 'id', 'name'),
                    'format'=>'raw'
            ],
            'retail_price',
            'wholesale_price',
            'dtime',
            'dcondition',
//            'created',
            'updated',
            [
                'class' => ActionColumn::className(),
                'template' => ' {delete}'
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
