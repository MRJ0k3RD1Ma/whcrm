<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\OrderPaid $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Order Paids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-paid-view">

    <div class="card">
        <div class="card-body">


            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id, 'order_id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id, 'order_id' => $model->order_id], [
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
            'order_id',
            'name',
            'user_id',
            'note:ntext',
            'file',
            'price',
            'date',
            'consept_id',
            'created',
            'updated',
            'status_id',
            'payment_id',
        ],
    ]) ?>

        </div>
    </div>
</div>
