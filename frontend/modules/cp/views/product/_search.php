<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\ProductSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'serial') ?>

    <?= $form->field($model, 'serial_num') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'box') ?>

    <?php // echo $form->field($model, 'cat_id') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'bio') ?>

    <?php // echo $form->field($model, 'is_sale') ?>

    <?php // echo $form->field($model, 'is_good') ?>

    <?php // echo $form->field($model, 'expiry_month') ?>

    <?php // echo $form->field($model, 'unit_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
