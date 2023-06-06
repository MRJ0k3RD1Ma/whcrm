<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\models\Expense;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var common\models\Expense $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Харажатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="expense-view">

    <div class="card">
        <div class="card-body">


            <p>
                <?= Html::a('Ўзгартириш', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Ўчириш', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

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
            'updated',
        ],
    ]) ?>

        </div>
    </div>
</div>
