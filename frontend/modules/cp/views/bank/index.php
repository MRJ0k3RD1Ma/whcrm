<?php

use common\models\Bank;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\BankSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Banks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-index">
    <div class="card">
        <div class="card-body">

    <p>
        <?= Html::a('Bank qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'mfo',
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
