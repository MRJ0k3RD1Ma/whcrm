<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OrderPaid $model */

$this->title = 'Create Order Paid';
$this->params['breadcrumbs'][] = ['label' => 'Order Paids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-paid-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
