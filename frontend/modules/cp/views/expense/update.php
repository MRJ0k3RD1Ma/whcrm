<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Expense $model */

$this->title = 'Ўзгартириш: ' . $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Харажатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->date, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ўзгартириш';
?>
<div class="expense-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
