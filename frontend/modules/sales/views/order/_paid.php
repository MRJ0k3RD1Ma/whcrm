<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\OrderPaid $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'name')->textInput()?>
    <?= $form->field($model,'date')->textInput(['type'=>'date'])?>
    <?= $form->field($model,'payment_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Payment::find()->all(),'id','name'),['prompt'=>''])?>
    <?= $form->field($model,'price')->textInput()?>
    <?= $form->field($model,'file')->fileInput()?>
    <?= $form->field($model,'note')->textarea()?>

    <br>

    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

