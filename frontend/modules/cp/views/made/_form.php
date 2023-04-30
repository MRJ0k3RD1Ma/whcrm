<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Made $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="made-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cnt_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cnt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cnt_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'box')->textInput() ?>

    <?= $form->field($model, 'c_cnt_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_cnt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_cnt_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_box')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consept_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
