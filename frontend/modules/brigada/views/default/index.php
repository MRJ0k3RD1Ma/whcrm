<?php

$this->title = 'Бригада бошлиғи';

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Бугун ишлаб чиқарилган маҳсулотлар
                <?php if($t){?><span style="float: right"> <a href="<?= Yii::$app->urlManager->createUrl(['/brigada/default/made'])?>" class="btn btn-primary">Киритиш</a></span><?php }?>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Номи</th>
                                <th>Миқдори</th>
                                <th>Коробкалари</th>
                                <th>Умумий сони</th>
                                <th>Нархи</th>
                                <th>Умумий нарх</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($model as $item): $pro = \common\models\Made::find()->where(['date'=>date('Y-m-d'),'product_id'=>$item->product_id,'user_id'=>Yii::$app->user->id])->one(); ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $item->product->name ?></td>
                                    <td><?= $pro ? $pro->cnt : 0 ?></td>
                                    <td><?= $pro ? $pro->box : 0 ?></td>
                                    <td><?= $pro ? $pro->cnt_total : 0 ?></td>
                                    <td><?= $pro ? $pro->price : $item->price ?></td>
                                    <td><?= $pro ? $pro->cnt_price : 0?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <?php if($t){?>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/brigada/default/done'])?>" class="btn btn-success">Кунни якунлаш ҳамда ишлаб чиқарилган маҳсулотларни текширувга юбориш</a>
                <?php }else{?>
                    <h4><?= date('d.m.Y')?> санадаги ишлар якунланган</h4>
                <?php }?>
            </div>
        </div>
    </div>
</div>
