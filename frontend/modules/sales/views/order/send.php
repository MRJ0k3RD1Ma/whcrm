<?php

/* @var $model \common\models\Order*/
/* @var $form ActiveForm*/

use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin()?>

<h4 style="text-align: center">Чек #<?= $model->code?></h4>
<table class="table table-bordered table-hover">
    <tr>
        <th>Номи</th>
        <th>Сони</th>
        <th>Сумма</th>
    </tr>
    <?php $cnt = 0; foreach ($model->orderProducts as $item): $cnt += $item->total_price?>
        <tr>
            <td><?= $item->product->name?></td>
            <td><?= intval($item->count) ?></td>
            <td><?= intval($item->total_price) ?></td>
        </tr>
    <?php endforeach;?>

</table>
<p><b>Умумий нарх:</b> <?= intval($cnt)?></p>
<p><b>Чегирма:</b> <?= intval($model->discount)?></p>
<p><b>ҚҚС:</b> <?= intval($model->qqs)?>%</p>
<?php if($model->is_delivery == 1){?>
    <p><b>Етказиб бериш:</b> <?= intval($model->delivery_price)?></p>
    <p><b>Манзил:</b> <?= $model->address ?></p>
<?php }?>
<p><b>Умумий тўлов:</b> <?= intval($model->price)?></p>
<p><b>Қарз:</b> <?= intval($model->debt)?></p>
<p><b>Буюртма ҳолати:</b> <?= $model->status->name?></p>

<?= $form->field($model,'status')->radioList(\yii\helpers\ArrayHelper::map(\common\models\OrderStatus::find()->where('id in (2,3,4)')->all(),'id','name'))->label('Статусни ўзгартириш')?>



<?= $form->field($model,'note')->textarea()?>
<br>
<button class="btn btn-success">Сақлаш</button>
<?php ActiveForm::end()?>
