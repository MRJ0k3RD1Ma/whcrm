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
            [
                'attribute' => 'supplier_id',
                'value' => function ($model) {
                    return $model->supplier->name;
                },
            ],
            'note',
            [
                'attribute' => 'creator_id',
                'value' => function ($model) {
                    return $model->creator->name;
                },
            ],
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
            <br>
            <h4>Келтирилган маҳсулотлар рўйхати</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Маҳсулот</th>
                        <th>Миқдори</th>
                        <th>Коробкалари сони</th>
                        <th>Умумий сони</th>
                        <th>Нархи</th>
                        <th>Суммаси</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->comeProducts as $key => $item): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $item->product->name ?></td>
                            <td><?= number_format($item->cnt,2,'.',' ') ?></td>
                            <td><?= number_format($item->box,0,'.',' ') ?></td>
                            <td><?= number_format($item->box * $item->product->box + $item->cnt,2,'.',' ') ?></td>
                            <td><?= number_format($item->price,2,'.',' ') ?></td>
                            <td><?= number_format($item->cnt_price,2,'.',' ') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
