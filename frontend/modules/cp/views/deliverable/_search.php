<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\DeliverableSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="deliverable-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'supplier_id') ?>

    <?= $form->field($model, 'retail_price') ?>

    <?= $form->field($model, 'wholesale_price') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
