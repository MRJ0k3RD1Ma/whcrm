<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model \common\models\BrigadaProduct */

?>
<?php if($model->isNewRecord){ $where = "id not in (select product_id from brigada_product where user_id = {$model->user_id})";?>
    <h5>Mahsulot ishlab chiqarishni biriktirish</h5>
<?php }else{ $where = "1";?>
    <h5>Biriktirilgan mahsulotni o`zgartirish</h5>
<?php }?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(\common\models\Product::find()->where($where)->andWhere(['is_good'=>1])->all(),'id','name'),['prompt'=>'']) ?>
<?= $form->field($model, 'price')->textInput() ?>
<?= $form->field($model, 'unit_id')->dropDownList(ArrayHelper::map(\common\models\Unit::find()->all(),'id','name'),['prompt'=>'']) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

<h5>Biriktirilgan mahsulotni ro`yxati</h5>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Mahsulot nomi</th>
        <th>Narxi</th>
        <th>Birligi</th>
        <th>Amallar</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; foreach (\common\models\BrigadaProduct::find()->where(['user_id'=>$model->user_id])->all() as $item){?>
        <tr>
            <td><?=$i++?></td>
            <td><?=$item->product->name?></td>
            <td><?=$item->price ?></td>
            <td><?=$item->unit->name ?></td>
            <td>
                <?= Html::a('<span class="fa fa-pencil"></span>', ['view', 'id' => $model->user_id,'brigada_id'=>$item->product_id], [
                    'class' => 'btn btn-primary',
                ]) ?>
                <?= Html::a('<span class="fa fa-trash"></span>', ['delete-brigada', 'id' => $model->user_id,'brigada_id'=>$item->product_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Mahsulotni o`chirishni istaysizmi?',
                        'method' => 'post',
                    ],
                ]) ?>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
