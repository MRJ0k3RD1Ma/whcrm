<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\CLegalSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="clegal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'inn') ?>

    <?= $form->field($model, 'bank_id') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'oked') ?>

    <?php // echo $form->field($model, 'account') ?>

    <?php // echo $form->field($model, 'director') ?>

    <?php // echo $form->field($model, 'director_phone') ?>

    <?php // echo $form->field($model, 'bux') ?>

    <?php // echo $form->field($model, 'bux_phone') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'phone_name') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
