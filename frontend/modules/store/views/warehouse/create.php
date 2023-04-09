<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Warehouse $model */

$this->title = 'Omborxona qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Omborxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
