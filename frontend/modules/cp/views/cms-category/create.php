<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CmsCategory $model */

$this->title = 'Create Cms Category';
$this->params['breadcrumbs'][] = ['label' => 'Cms Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-category-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
