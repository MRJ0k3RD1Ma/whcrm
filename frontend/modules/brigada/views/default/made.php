<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MadeForm */
/* @var $form ActiveForm */
$this->title = 'Бугун '. date('d.m.Y') .' санада тайёрланган маҳсулотлар';
?>

<div class="card">
    <div class="card-body">
        <?php $form = ActiveForm::begin() ?>

        <?php foreach (\common\models\BrigadaProduct::find()->where(['user_id'=>Yii::$app->user->id])->all() as $item):?>
            <?php $pro = \common\models\Made::findOne(['date'=>date('Y-m-d'),'product_id'=>$item->product_id,'user_id'=>Yii::$app->user->id])?>
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model,'pro['.$item->product_id.'][product]')->textInput(['value'=>$item->product->name,'disabled'=>true])->label('Маҳсулот номи') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model,'pro['.$item->product_id.'][cnt]')->textInput(['data-key'=>$item->product_id,'class'=>'cnts form-control','value'=>$pro ? $pro->cnt : ''])->label('Сони')?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model,'pro['.$item->product_id.'][box]')->textInput(['data-key'=>$item->product_id,'class'=>'boxs form-control','value'=>$pro ? $pro->box : ''])->label('Коробка')?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model,'pro['.$item->product_id.'][cnt_total]')->textInput(['disabled'=>true,'value'=>$pro ? $pro->cnt_total : ''])->label('Умумий сони')?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model,'pro['.$item->product_id.'][price]')->textInput(['disabled'=>true,'value'=>$item->price])->label('Нархи')?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model,'pro['.$item->product_id.'][cnt_price]')->textInput(['disabled'=>true,'value'=>$pro ? $pro->cnt_price : 0])->label('Умумий нархи')?>
                </div>
            </div>

        <?php endforeach;?>

        <div class="form-group">
            <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end()?>
    </div>
</div>

<?php
    $this->registerJs("
        $('.cnts').keyup(function(){
            var key = $(this).data('key');
            var cnt = $(this).val();
            var box = $('#madeform-pro-'+key+'-box').val();
            if(!box){
                box = 0;
            }
            if(!cnt){
                cnt = 0;
            }
            var price = $('#madeform-pro-'+key+'-price').val();
            $.get('/brigada/default/total',{cnt:cnt,box:box,price:price,id:key},function(data){
                $('#madeform-pro-'+key+'-cnt_total').val(data);
                $('#madeform-pro-'+key+'-cnt_price').val(data*price);
            })
        });
        $('.boxs').keyup(function(){
            var key = $(this).data('key');
            var box = $(this).val();
            var cnt = $('#madeform-pro-'+key+'-cnt').val();
            if(!box){
                box = 0;
            }
            if(!cnt){
                cnt = 0;
            }
            var price = $('#madeform-pro-'+key+'-price').val();
            $.get('/brigada/default/total',{cnt:cnt,box:box,price:price,id:key},function(data){
                $('#madeform-pro-'+key+'-cnt_total').val(data);
                $('#madeform-pro-'+key+'-cnt_price').val(data*price);
            })
        })
    ")
?>