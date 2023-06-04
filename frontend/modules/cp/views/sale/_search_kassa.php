<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\OrderPaidSearch $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="order-paid-search">

    <?php $form = ActiveForm::begin([
        'action' => ['kassa'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model,'to')->textInput(['type'=>'date'])->label('Санадан')?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model,'do')->textInput(['type'=>'date'])->label('Санагача')?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(),'id','name'),['prompt'=>'']) ?>
        </div>
        <div class="col-md-2">
            <?php echo $form->field($model, 'payment_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Payment::find()->all(),'id','name'),['prompt'=>'']) ?>
        </div>
        <div class="col-md-2">
            <div class="form-group" style="padding-top:29px;">
                <?= Html::submitButton('<span class="fa fa-search"></span>', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<span class="fa fa-paint-brush"></span>','/cp/sale/kassa', ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
