<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Come $model */

$this->title = 'Update Come: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="come-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
