<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'serial')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'basic_price')->textInput() ?>

            <?= $form->field($model, 'retail_price')->textInput() ?>

            <?= $form->field($model, 'wholesale_price')->textInput() ?>

            <?= $form->field($model, 'box')->textInput() ?>

        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'is_sale')->dropDownList(Yii::$app->params['is_sale'],['prompt'=>'']) ?>

            <?= $form->field($model, 'is_good')->dropDownList(Yii::$app->params['is_good'],['prompt'=>'']) ?>

            <?= $form->field($model, 'cat_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Category::find()->all(),'id','name'),['prompt'=>'']) ?>

            <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'expiry_month')->textInput() ?>

            <?= $form->field($model, 'unit_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Unit::find()->all(),'id','name'),['prompt'=>'']) ?>
        </div>
        <div class="col-md-12">
            <br>
            <?= $form->field($model, 'image')->fileInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>

        </div>
    </div>








    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
