<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Made $model */

$this->title = 'Update Made: ' . $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Mades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->date, 'url' => ['view', 'date' => $model->date, 'product_id' => $model->product_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="made-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
