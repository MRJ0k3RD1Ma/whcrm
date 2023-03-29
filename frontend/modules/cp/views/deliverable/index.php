<?php

use common\models\Deliverable;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\DeliverableSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Deliverables';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deliverable-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Create Deliverable', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product_id',
            'supplier_id',
            'retail_price',
            'wholesale_price',
            'created',
            //'updated',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Deliverable $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'product_id' => $model->product_id, 'supplier_id' => $model->supplier_id]);
                 }
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
