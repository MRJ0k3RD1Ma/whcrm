<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CIndividual $model */

$this->title = 'Create C Individual';
$this->params['breadcrumbs'][] = ['label' => 'C Individuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cindividual-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
