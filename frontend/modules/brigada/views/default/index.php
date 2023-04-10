<?php

$this->title = 'Бригада бошлиғи';

?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Бугун ишлаб чиқарилган маҳсулотлар</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Номи</th>
                                <th>Миқдори</th>
                                <th>Нархи</th>
                                <th>Умумий нарх</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($model as $item): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><a href="<?= Yii::$app->urlManager->createUrl(['/brigada/default/made','id'=>$item->product_id])?>"><?= $item->product->name ?></a></td>
                                    <td>0</td>
                                    <td><?= $item->price?></td>
                                    <td><?= $item->price * 0?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>