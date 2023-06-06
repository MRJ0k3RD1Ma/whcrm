<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Expense $model */

$this->title = 'Харажат қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Харажатлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
