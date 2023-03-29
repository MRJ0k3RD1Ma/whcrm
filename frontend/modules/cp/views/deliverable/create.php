<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Deliverable $model */

$this->title = 'Create Deliverable';
$this->params['breadcrumbs'][] = ['label' => 'Deliverables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deliverable-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
