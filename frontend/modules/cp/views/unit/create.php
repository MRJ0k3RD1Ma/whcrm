<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Unit $model */

$this->title = 'Birlik qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Birliklar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
