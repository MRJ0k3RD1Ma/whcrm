<?php

use common\models\Unit;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\UnitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Birliklar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-index">
    <div class="card">
        <div class="card-body">

        <p class="text-right">
            <?= Html::a('Birlik qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
