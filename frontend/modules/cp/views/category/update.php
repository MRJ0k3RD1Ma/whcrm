<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Category $model */

$this->title = 'O`zgartirish: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kategoriyalar ro`yhati', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'O`zgartirish';
?>
<div class="category-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
