<?php
/* @var $model \common\models\OrderPaid*/
?>
<h4>Тўловлар тарихи</h4>

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Тўловчи</th>
                <th>Суммаси</th>
                <th>Тўлов тури</th>
                <th>қабул қилди</th>
                <th>Чек</th>
                <th>Тасдиқлади</th>
                <th>Санаси</th>
                <th>Изоҳ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $key=>$item): ?>
            <tr>
                <td><?=$key+1?></td>
                <td><?=$item->name?></td>
                <td><?=$item->price?></td>
                <td><?=$item->payment->name?></td>
                <td><?=$item->user->name?></td>
                <td>
                    <?php if($item->file):?>
                    <a href="/uploads/<?=$item->file?>" target="_blank">Чек</a>
                    <?php endif;?>
                </td>
                <td><?= $item->consept? $item->consept->name.'<br>' : ''?> <?= $item->status->name?></td>
                <td><?=date('d.m.Y',strtotime($item->date))?></td>
                <td><?=$item->note?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>