<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CIndividual $model */

$this->title = 'O`zgartirish: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Jismoniy shaxslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'O`zgartirish';
?>
<div class="cindividual-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
