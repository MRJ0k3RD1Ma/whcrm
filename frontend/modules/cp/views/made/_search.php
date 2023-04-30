<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\MadeSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="made-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'cnt_price') ?>

    <?php // echo $form->field($model, 'cnt') ?>

    <?php // echo $form->field($model, 'cnt_total') ?>

    <?php // echo $form->field($model, 'box') ?>

    <?php // echo $form->field($model, 'c_cnt_total') ?>

    <?php // echo $form->field($model, 'c_cnt') ?>

    <?php // echo $form->field($model, 'c_cnt_price') ?>

    <?php // echo $form->field($model, 'c_box') ?>

    <?php // echo $form->field($model, 'consept_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
