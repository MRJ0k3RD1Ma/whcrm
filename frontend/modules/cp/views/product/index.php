<?php

use common\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mahsulotlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Mahsulot qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'name',
            [
                'attribute'=>'name',
                'value'=>function($model){
                    return "<a href='".Url::toRoute(['product/view', 'id' => $model->id])."'>".$model->name."</a>";
                },
                'format'=>'raw'
            ],
//            'image',
            'serial',
//            'serial_num',
            'basic_price',
            'retail_price',
            'wholesale_price',
            //'box',
//            'cat_id',
            [
                'attribute'=>'cat_id',
                'value'=>function($model){
                    return "<a href='".Url::toRoute(['category/view', 'id' => $model->cat_id])."'>".$model->cat->name."</a>";
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Category::find()->all(), 'id', 'name'),
                'format'=>'raw'
            ],
            //'note',
            //'code',
            //'bio:ntext',
            //'is_sale',
            //'is_good',
            //'expiry_month',
//            'unit_id',
            [
                'attribute'=>'unit_id',
                'value'=>function($model){
                    return "<a href='".Url::toRoute(['unit/view', 'id' => $model->unit_id])."'>".$model->unit->name."</a>";
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Unit::find()->all(), 'id', 'name'),
                'format'=>'raw'
            ],
            //'created_at',
            //'updated_at',
        ],
    ]); ?>


        </div>
    </div>
</div>
