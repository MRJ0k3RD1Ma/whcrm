<?php
/* @var $model \common\models\Order*/


use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


$qr = function () use ($model) {
    $data = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data(Yii::$app->urlManager->createAbsoluteUrl(['/site/order', 'code' => $model->code]))
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(130)
        ->margin(3)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
//        ->logoPath(Yii::$app->basePath."/web/favicon.png")
        ->labelText('')
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
        ->build();
    return $data->getDataUri();
};


?>
<h4 style="text-align: center">Чек #<?= $model->code?></h4>
<table>
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
<hr>
<p><b>Чегирма:</b> <?= intval($model->discount)?></p>
<hr>
<p><b>ҚҚС:</b> <?= intval($model->qqs)?>%</p>
<hr>
<?php if($model->is_delivery == 1){?>
    <p><b>Етказиб бериш:</b> <?= intval($model->delivery_price)?></p>
    <hr>
    <p><b>Манзил:</b> <?= $model->address ?></p>
    <hr>
<?php }?>
<p><b>Умумий тўлов:</b> <?= intval($model->price)?></p>
<hr>
<p><b>Қарз:</b> <?= intval($model->debt)?></p>
<hr>
<p><b>Буюртма ҳолати:</b> <?= intval($model->status->name)?></p>
<hr>
<div style="text-align: center; margin-top:10px;">
    <img src="<?= $qr()?>" alt="buyurtma">
</div>




