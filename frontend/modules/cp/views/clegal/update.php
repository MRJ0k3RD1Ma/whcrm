<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CLegal $model */

$this->title = 'Update C Legal: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'C Legals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clegal-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
