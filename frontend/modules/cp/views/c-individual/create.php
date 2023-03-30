<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CIndividual $model */

$this->title = 'Jismoniy shaxs qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Jismoniy shaxslar', 'url' => ['index']];
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
