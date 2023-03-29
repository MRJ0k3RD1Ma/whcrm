<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CLegal $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="clegal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_id')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oked')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'director_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bux')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bux_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
