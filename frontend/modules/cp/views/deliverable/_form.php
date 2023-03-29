<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Deliverable $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="deliverable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supplier_id')->textInput() ?>

    <?= $form->field($model, 'retail_price')->textInput() ?>

    <?= $form->field($model, 'wholesale_price')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
