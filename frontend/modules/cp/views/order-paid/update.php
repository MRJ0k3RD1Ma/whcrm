<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OrderPaid $model */

$this->title = 'Update Order Paid: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Order Paids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'order_id' => $model->order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-paid-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
