<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CLegal $model */

$this->title = 'Create C Legal';
$this->params['breadcrumbs'][] = ['label' => 'C Legals', 'url' => ['index']];
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
