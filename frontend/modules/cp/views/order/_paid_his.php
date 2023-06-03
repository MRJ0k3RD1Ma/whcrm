<?php
/* @var $model \common\models\OrderPaid*/
?>
<h4>Тўловлар тарихи</h4>

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th></th>

                <th>#</th>
                <th>Санаси</th>
                <th>Суммаси</th>
                <th>Тўловчи</th>
                <th>Тўлов тури</th>
                <th>Тасдиқлади</th>
                <th>Изоҳ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $key=>$item): ?>
            <tr>
                <td>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/order/accept','id'=>$item->id,'order_id'=>$item->order_id])?>" class="btn btn-primary"><span class="fa fa-check"></span></a>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/order/decine','id'=>$item->id,'order_id'=>$item->order_id])?>" class="btn btn-danger mt-1"><span class="fa fa-trash"></span></a>
                </td>
                <td><?=$key+1?></td>
                <td><?=date('d.m.Y',strtotime($item->date))?></td>
                <td>

                    <?php if($item->file):?>
                        <a href="/uploads/<?=$item->file?>" target="_blank"><?=intval($item->price)?></a>
                    <?php else: ?>
                        <?=intval($item->price)?>
                    <?php endif;?>
                </td>
                <td><?=$item->name?></td>
                <td><?=$item->payment->name?>(<?= $item->user->name?>)</td>
                <td><?= $item->consept? $item->consept->name.'<br>' : ''?> <?= $item->status->name?></td>
                <td><?=$item->note?></td>

            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>