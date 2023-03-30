<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_num')->textInput() ?>

    <?= $form->field($model, 'basic_price')->textInput() ?>

    <?= $form->field($model, 'retail_price')->textInput() ?>

    <?= $form->field($model, 'wholesale_price')->textInput() ?>

    <?= $form->field($model, 'box')->textInput() ?>

    <?= $form->field($model, 'cat_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_sale')->textInput() ?>

    <?= $form->field($model, 'is_good')->textInput() ?>

    <?= $form->field($model, 'expiry_month')->textInput() ?>

    <?= $form->field($model, 'unit_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
