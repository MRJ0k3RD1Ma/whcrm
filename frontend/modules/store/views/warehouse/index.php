<?php

use common\models\Warehouse;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\WarehouseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Omborxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Omborxona qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function (Warehouse $model) {
                    return Html::a($model->name, Url::to(['view', 'id' => $model->id]));
                },
            ],

        ],
    ]); ?>


        </div>
    </div>
</div>
