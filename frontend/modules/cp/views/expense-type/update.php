<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ExpenseType $model */

$this->title = 'Ўзгартириш: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Бошқа харажат турлари', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Ўзгартириш';
?>
<div class="expense-type-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
