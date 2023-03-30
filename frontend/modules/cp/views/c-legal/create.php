<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CLegal $model */

$this->title = 'Yuridik shaxs qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Yuridik shaxslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clegal-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
