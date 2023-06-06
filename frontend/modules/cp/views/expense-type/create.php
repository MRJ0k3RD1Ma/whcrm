<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ExpenseType $model */

$this->title = 'Бошқа харажат тури қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Бошқа харажат турлари', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-type-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
