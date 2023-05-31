<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\CmsNewsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cms-news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'cat_id') ?>

    <?php // echo $form->field($model, 'preview') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'show_counter') ?>

    <?php // echo $form->field($model, 'slider') ?>

    <?php // echo $form->field($model, 'vote') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <?php // echo $form->field($model, 'modify_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
