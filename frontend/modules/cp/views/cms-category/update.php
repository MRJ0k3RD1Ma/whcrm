<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CmsCategory $model */

$this->title = 'Update Cms Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cms Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cms-category-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
