<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Come $model */

$this->title = 'Create Come';
$this->params['breadcrumbs'][] = ['label' => 'Comes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="come-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
