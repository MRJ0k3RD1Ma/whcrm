<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CmsNews $model */

$this->title = 'Create Cms News';
$this->params['breadcrumbs'][] = ['label' => 'Cms News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-news-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
