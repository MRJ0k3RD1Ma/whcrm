<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Made $model */

$this->title = $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Mades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="made-view">

    <div class="card">
        <div class="card-body">


            <p>
                <?= Html::a('Update', ['update', 'date' => $model->date, 'product_id' => $model->product_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'date' => $model->date, 'product_id' => $model->product_id, 'user_id' => $model->user_id], [
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
            'date',
            'product_id',
            'user_id',
            'price',
            'cnt_price',
            'cnt',
            'cnt_total',
            'box',
            'c_cnt_total',
            'c_cnt',
            'c_cnt_price',
            'c_box',
            'consept_id',
            'status',
            'note:ntext',
            'created',
            'updated',
        ],
    ]) ?>

        </div>
    </div>
</div>
