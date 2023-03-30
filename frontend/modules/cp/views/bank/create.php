<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Bank $model */

$this->title = 'Bank qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Banklar ro`yhati', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-create">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
