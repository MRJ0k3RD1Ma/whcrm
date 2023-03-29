<?php

use common\models\CLegal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CLegalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'C Legals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clegal-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Create C Legal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'inn',
            'bank_id',
            'address',
            //'oked',
            //'account',
            //'director',
            //'director_phone',
            //'bux',
            //'bux_phone',
            //'phone',
            //'phone_name',
            //'created',
            //'updated',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CLegal $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
