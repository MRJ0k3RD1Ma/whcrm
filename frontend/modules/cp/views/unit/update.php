<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Unit $model */

$this->title = 'O`zgartirish: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Birliklar', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'O`zgartirish';
?>
<div class="unit-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
