<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model \common\models\WareUser */

?>
<?php if($model->isNewRecord){ $where = "id not in (select ware_id from ware_user where user_id = {$model->user_id})";?>
    <h5>Omborxona biriktirish</h5>
<?php }else{ $where = "1";?>
    <h5>Biriktirilgan Omborxonani o`zgartirish</h5>
<?php }?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'ware_id')->dropDownList(ArrayHelper::map(\common\models\Warehouse::find()->where($where)->all(),'id','name'),['prompt'=>'']) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

<h5>Biriktirilgan omborxonalar ro`yxati</h5>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Omborxona nomi</th>
        <th>Amallar</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; foreach (\common\models\WareUser::find()->where(['user_id'=>$model->user_id])->all() as $item){?>
        <tr>
            <td><?=$i++?></td>
            <td><?=$item->ware->name?></td>
            <td>
                <?= Html::a('<span class="fa fa-pencil"></span>', ['view', 'id' => $model->user_id,'ware_id'=>$item->ware_id], [
                    'class' => 'btn btn-primary',
                ]) ?>
                <?= Html::a('<span class="fa fa-trash"></span>', ['delete-ware', 'id' => $model->user_id,'ware_id'=>$item->ware_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Omborxonani o`chirishni istaysizmi?',
                        'method' => 'post',
                    ],
                ]) ?>
            </td>
        </tr>
    <?php }?>
    </tbody>

</table>
