<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Supplier $model */

$this->title = 'Mahsulot yetkazuvchi qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Mahsulot yetkazuvchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
