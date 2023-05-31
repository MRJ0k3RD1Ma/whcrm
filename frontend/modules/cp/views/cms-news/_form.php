<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CmsNews $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cms-news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_id')->textInput() ?>

    <?= $form->field($model, 'preview')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'show_counter')->textInput() ?>

    <?= $form->field($model, 'slider')->textInput() ?>

    <?= $form->field($model, 'vote')->textInput() ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modify_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
