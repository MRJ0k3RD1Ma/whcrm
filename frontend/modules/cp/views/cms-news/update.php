<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CmsNews $model */

$this->title = 'Update Cms News: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cms News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cms-news-update">

    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
