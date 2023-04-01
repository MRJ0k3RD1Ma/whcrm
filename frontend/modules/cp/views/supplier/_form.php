<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Supplier $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?php
                $banks = \common\models\Bank::find()->all();
                $bankList = [];
                foreach ($banks as $bank) {
                    $bankList[$bank->id] = $bank->mfo.'-'.$bank->name;
                }
            ?>

            <?= $form->field($model, 'bank_id')->dropDownList($bankList,['prompt'=>'','class'=>'form-control select2']) ?>

            <?= $form->field($model, 'oked')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'account')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'director_phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'bux')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'bux_phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>







    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
