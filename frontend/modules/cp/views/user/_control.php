<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model \common\models\ProductUser */

?>
<?php if($model->isNewRecord){ $where = "id not in (select product_id from product_user where user_id = {$model->user_id})";?>
    <h5>Nazorat biriktirish</h5>
<?php }else{ $where = "1";?>
    <h5>Biriktirilgan nazoratni o`zgartirish</h5>
<?php }?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(\common\models\Product::find()->where($where)->andWhere(['is_good'=>0])->all(),'id','name'),['prompt'=>'']) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

<h5>Biriktirilgan nazoratlar ro`yxati</h5>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Nazorat nomi</th>
        <th>Amallar</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; foreach (\common\models\ProductUser::find()->where(['user_id'=>$model->user_id])->all() as $item){?>
        <tr>
            <td><?=$i++?></td>
            <td><?=$item->product->name?></td>
            <td>
                <?= Html::a('<span class="fa fa-pencil"></span>', ['view', 'id' => $model->user_id,'product_id'=>$item->product_id], [
                    'class' => 'btn btn-primary',
                ]) ?>
                <?= Html::a('<span class="fa fa-trash"></span>', ['delete-product', 'id' => $model->user_id,'product_id'=>$item->product_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Nazoratni o`chirishni istaysizmi?',
                        'method' => 'post',
                    ],
                ]) ?>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
