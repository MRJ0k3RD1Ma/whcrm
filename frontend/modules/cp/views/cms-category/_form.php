<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['action'=>$model->isNewRecord ? Yii::$app->urlManager->createUrl(['/cp/cms-category/create']) : Yii::$app->urlManager->createUrl(['/cp/cms-category/update','id'=>$model->id])]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\CmsCategory::find()->all(),'id','name'),[
        'class'=>'select2-list form-control'
    ]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Saqlash' : 'O`zgartirish', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
