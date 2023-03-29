<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Deliverable $model */

$this->title = $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Deliverables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="deliverable-view">

    <div class="card">
        <div class="card-body">


            <p>
                <?= Html::a('Update', ['update', 'product_id' => $model->product_id, 'supplier_id' => $model->supplier_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'product_id' => $model->product_id, 'supplier_id' => $model->supplier_id], [
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
            'product_id',
            'supplier_id',
            'retail_price',
            'wholesale_price',
            'created',
            'updated',
        ],
    ]) ?>

        </div>
    </div>
</div>
