<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Bank $model */

$this->title = 'Update Bank: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bank-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
