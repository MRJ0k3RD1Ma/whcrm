<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CIndividual $model */

$this->title = 'Update C Individual: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'C Individuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
