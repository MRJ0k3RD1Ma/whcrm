<?php

use common\models\Expense;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var common\models\search\ExpenseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Харажатлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Харажат қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
//            'date',
            [
                'attribute'=>'date',
                'value'=>function(Expense $model){
                    return Html::a(date('d.m.Y', strtotime($model->date)), Url::to(['view', 'id'=>$model->id]));
                },
                'format'=>'raw',
            ],
            'price',
            [
                'attribute' => 'type_id',
                'value' => function (Expense $model) {
                    return $model->type->name;
                },
                'filter' => ArrayHelper::map(\common\models\ExpenseType::find()->all(), 'id', 'name'),
            ],
//            'payment_id',
            [
                'attribute' => 'payment_id',
                'value' => function (Expense $model) {
                    return $model->payment->name;
                },
                'filter' => ArrayHelper::map(\common\models\Payment::find()->all(), 'id', 'name'),
            ],
            [
                'attribute' => 'user_id',
                'value' => function (Expense $model) {
                    return $model->user->name;
                },
                'filter' => ArrayHelper::map(\common\models\User::find()->all(), 'id', 'name'),
            ],
//            'type_id',


            'note:ntext',
            'created',
            //'updated',
        ],
    ]); ?>


        </div>
    </div>
</div>
