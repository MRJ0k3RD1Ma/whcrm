<?php
/* @var $model \common\models\OrderPaid*/
?>
<h4>Тўловлар тарихи</h4>

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>

                <th>#</th>
                <th>Санаси</th>
                <th>Суммаси</th>
                <th>Тўловчи</th>
                <th>Тўлов тури</th>
                <th>Изоҳ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $key=>$item): ?>
            <tr>
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
                <td><?=$item->note?></td>

            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>