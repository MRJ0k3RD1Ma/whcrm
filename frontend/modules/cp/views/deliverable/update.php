<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Deliverable $model */

$this->title = 'Update Deliverable: ' . $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Deliverables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'product_id' => $model->product_id, 'supplier_id' => $model->supplier_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="deliverable-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
