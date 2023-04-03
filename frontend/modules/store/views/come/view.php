<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Come $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Киримлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="come-view">

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
            'id',
            'date',
//            'supplier_id',
            [
                'attribute' => 'supplier_id',
                'value' => function ($model) {
                    return $model->supplier->name;
                },
            ],
            'note',
//            'creator_id',
            [
                'attribute' => 'creator_id',
                'value' => function ($model) {
                    return $model->creator->name;
                },
            ],
//            'status',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Yii::$app->params['status.come'][$model->status];
                },
            ],
            'created',
            'updated',
        ],
    ]) ?>

        </div>
    </div>
</div>
