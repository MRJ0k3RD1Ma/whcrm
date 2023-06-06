<?php

use common\models\ExpenseType;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ExpenseTypeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Бошқа харажат турлари';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-type-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Бошқа харажат тури қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'name',
            [
                'attribute'=>'name',
                'value'=>function($model){
                    $url = Yii::$app->urlManager->createUrl(['/cp/expense-type/update','id'=>$model->id]);
                    return Html::a($model->name,$url);
                },
                'format'=>'raw',
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
