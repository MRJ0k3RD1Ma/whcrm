<?php

use common\models\Warehouse;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\WarehouseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Warehouses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Create Warehouse', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Warehouse $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
