<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Made $model */

$this->title = 'Create Made';
$this->params['breadcrumbs'][] = ['label' => 'Mades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="made-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
