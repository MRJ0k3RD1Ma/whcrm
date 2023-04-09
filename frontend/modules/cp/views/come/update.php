<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Come $model */

$this->title = 'Ўзгартириш: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Киримлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->date, 'url' => ['view', 'id' => $model->date]];
$this->params['breadcrumbs'][] = 'Киримлар';
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
