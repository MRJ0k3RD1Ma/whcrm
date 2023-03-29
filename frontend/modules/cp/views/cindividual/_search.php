<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\CIndividualSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cindividual-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'pnfl') ?>

    <?= $form->field($model, 'inn') ?>

    <?= $form->field($model, 'passport') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
