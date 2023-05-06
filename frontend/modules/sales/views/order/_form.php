<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date')->textInput(['type'=>'date']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model,'wh_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Warehouse::find()->all(),'id','name'),['prompt'=>'Омборхонани танланг'])?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'c_name')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'c_phone')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'c_type')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\CType::find()->all(),'id','name')) ?>
        </div>
        <div class="hidden" style="display: none">
            <?= $form->field($model,'c_id')->textInput(['value'=>-1])?>
        </div>
        <div class="col-md-12">
            <ul class="list-group" id="livesearch"></ul>
        </div>

        <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>


    </div>

    <div class="row">
        <div class="col-md-3">

            <?= $form->field($model, 'price')->textInput(['maxlength' => true,'disabled'=>'true']) ?>

            <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'qqs')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\OrderType::find()->all(),'id','name')) ?>
            <br>
            <?= $form->field($model, 'is_delivery')->checkbox(['value'=>1]) ?>
            <div id="address" style="display:none">
                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            </div>

        </div>
        <div class="col-md-9">

            <?php if($model->isNewRecord){?>
                <div id="products" data-key="1">
                    <div class="row">
                        <div style="display: none">
                            <?= $form->field($model,'pro[0][id]')->textInput()?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'pro[0][product_id]')->dropDownList(
                                \yii\helpers\ArrayHelper::map(\common\models\Product::find()->all(),'id','name'),
                                ['prompt'=>'','onchange'=>'productchanger(0)','class'=>'form-control productid','data-key'=>'0'])->label('Маҳсулот') ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'pro[0][cnt]')->textInput(['onkeyup' => 'pricecalc(0)',])->label('Умумий сони') ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'pro[0][price]')->textInput(['maxlength' => true,'onkeyup' => 'pricecalc(0)','disabled'=>true,])->label('Нархи') ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'pro[0][cnt_price]')->textInput(['maxlength' => true,'disabled'=>true])->label('Умумий нархи') ?>
                        </div>
                        <div class="col-md-1">
                            <button  onclick="remover(0)"  type="button" class="btn btn-danger remover"><span class="fa fa-trash"></span></button>
                        </div>
                    </div>
                </div>
            <?php }else{?>
                <div id="products" data-key="<?= count($model->products)+1?>">

                    <?php foreach ($model->orders as $key=>$item):?>

                        <div class="row">
                            <div style="display: none">
                                <?= $form->field($model,'pro['.$key.'][id]')->textInput(['value'=>$item->id])?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'pro['.$key.'][product_id]')->dropDownList(
                                    \yii\helpers\ArrayHelper::map(\common\models\Product::find()->all(),'id','name'),
                                    ['prompt'=>'','value'=>$item->product_id,'onchange'=>'productchanger('.$key.')','class'=>'form-control productid','data-key'=>''.$key.''])->label('Маҳсулот') ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'pro['.$key.'][cnt]')->textInput(['onkeyup' => 'pricecalc('.$key.')','value'=>$item->cnt])->label('Умумий сони') ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, 'pro['.$key.'][price]')->textInput(['value'=>$item->price,'maxlength' => true,'onkeyup' => 'pricecalc('.$key.')','disabled'=>true,])->label('Нархи') ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, 'pro['.$key.'][cnt_price]')->textInput(['value'=>$item->cnt_price,'maxlength' => true,'disabled'=>true])->label('Умумий нархи') ?>
                            </div>
                            <div class="col-md-1">
                                <button  onclick="remover(<?= $key?>)"  type="button" class="btn btn-danger remover"><span class="fa fa-trash"></span></button>
                            </div>
                        </div>


                    <?php endforeach;?>
                </div>

            <?php }?>

            <button type="button" class="btn btn-primary addbtn"><span class="fa fa-plus"></span></button>


            <br><br>

        </div>

    </div>


    <br>

    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php

$this->registerJs("
    $('#order-is_delivery').on('change',function(){
        if($(this).prop('checked')){
            $('#address').css('display','block');
        }else{
            $('#address').css('display','none');
        }
    })
")

?>



<?php

$url_full_company = \yii\helpers\Url::to(['come/full-company']);
$url_company = \yii\helpers\Url::to(['come/company']);

$this->registerJs("
    $('.addbtn').click(function(){
        key = $('#products').data('key');
        var str = '<div class=\"row\"><div style=\"display: none\"><div class=\"form-group field-order-pro-'+key+'-id\"><label class=\"control-label\" for=\"order-pro-'+key+'-id\">Pro</label><input type=\"text\" id=\"order-pro-'+key+'-id\" class=\"form-control\" name=\"Order[pro]['+key+'][id]\"></div></div><div class=\"col-md-4\"><div class=\"form-group field-order-pro-'+key+'-product_id\"><label class=\"control-label\" for=\"order-pro-'+key+'-product_id\">Маҳсулот</label><select id=\"order-pro-'+key+'-product_id\" class=\"form-control productid\" name=\"Order[pro]['+key+'][product_id]\" onchange=\"productchanger('+key+')\" data-key=\"'+key+'\"></select></div></div><div class=\"col-md-3\"><div class=\"form-group field-order-pro-'+key+'-cnt\"><label class=\"control-label\" for=\"order-pro-'+key+'-cnt\">Умумий сони</label><input type=\"text\" id=\"order-pro-'+key+'-cnt\" class=\"form-control\" name=\"Order[pro]['+key+'][cnt]\" onkeyup=\"pricecalc('+key+')\"></div>                        </div><div class=\"col-md-2\"><div class=\"form-group field-order-pro-'+key+'-price\"><label class=\"control-label\" for=\"order-pro-'+key+'-price\">Нархи</label><input type=\"text\" id=\"order-pro-'+key+'-price\" class=\"form-control\" name=\"Order[pro]['+key+'][price]\" disabled=\"\" onkeyup=\"pricecalc('+key+')\"></div>                        </div><div class=\"col-md-2\"><div class=\"form-group field-order-pro-'+key+'-cnt_price\"><label class=\"control-label\" for=\"order-pro-'+key+'-cnt_price\">Умумий нархи</label><input type=\"text\" id=\"order-pro-'+key+'-cnt_price\" class=\"form-control\" name=\"Order[pro]['+key+'][cnt_price]\" disabled=\"\"></div></div><div class=\"col-md-1\"><button onclick=\"remover('+key+')\" type=\"button\" class=\"btn btn-danger remover\"><span class=\"fa fa-trash\"></span></button></div></div>';        
        $('#products').append(str);
        $.ajax({
            url: '/sales/order/get-product',
            type: 'POST',
            success: function(data){
                $('#order-pro-'+key+'-product_id').html(data);
            }
        });
        $('#products').data('key',key+1);
    });
    
    productchanger = function(key){
        var product_id = $('#order-pro-'+key+'-product_id').val();
        
//        $('.productid').each(function(){
//            if($(this).data('key') != key){
//                $(this).find('option[value='+product_id+']').remove();
//            }
//        });
        
        $.ajax({
            url: '/sales/order/get-price',
            type: 'POST',
            data: {product_id:product_id},
            success: function(data){
                $('#order-pro-'+key+'-price').val(data);
            }
        });

    }
    
    pricecalc = function(key){
        var cnt = $('#order-pro-'+key+'-cnt').val();
        var box = $('#order-pro-'+key+'-box').val();
        var price = $('#order-pro-'+key+'-price').val();
        
        $.get('/sales/order/get-fullprice',{
            product_id:$('#order-pro-'+key+'-product_id').val(),
            box:box,
            cnt:cnt,
            price:price,
        },function(data){
            $('#order-pro-'+key+'-cnt_price').val(data);
            var id = $('#products').data('key');
            window.cnt = 0;
            for(i = 0; i < id; i++){
               $.get('/sales/order/get-fullprice',{
                    product_id:$('#order-pro-'+i+'-product_id').val(),
                    box:$('#order-pro-'+i+'-box').val(),
                    cnt:$('#order-pro-'+i+'-cnt').val(),
                    price:$('#order-pro-'+i+'-price').val(),
                },function(data){
                    window.cnt += data;
                }); 
            }
            $('#order-price').val(window.cnt);
        });
    }
    
    remover = function(key){
        $('#order-pro-'+key+'-product_id').parent().parent().parent().remove();
    }
    
     $('#order-c_name').keyup(function(){
            $('#livesearchname').html('');
            
            var searchField = $('#come-c_name').val();
            $('#order-c_id').val(-1);
            if(searchField.length == 0){
                $('#livesearch').html('');
                return;
            }
            $.get('{$url_company}?name='+searchField).done(function(data){
                $('#livesearch').empty(data);
                $('#livesearch').append(data);
            })               
        });
        $('#order-c_name').focusout(function(){
            setTimeout(function(){
                $('#livesearch').html('');
            }, 200);
        });
        $('#livesearch').on('click', 'li', function() {
            var click_text = $(this).text();
            
            $('#order-c_name').val($.trim(click_text));
            $.get('{$url_full_company}?id='+$(this).attr('data-key')).done(function(data){
                data = JSON.parse(data);
                $('#come-c_id').val(data.id);
                $('#come-c_name').val(data.name);
                $('#come-c_phone').val(data.phone);
                $('#come-c_type').val(data.type_id);
            })
            $(\"#livesearch\").html('');
        });
    
");

?>

<?php if(false){?>


    <div class=\"row\">
        <div style=\"display: none\">
            <div class=\"form-group field-order-pro-'+key+'-id\">
                <label class=\"control-label\" for=\"order-pro-'+key+'-id\">Pro</label>
                <input type=\"text\" id=\"order-pro-'+key+'-id\" class=\"form-control\" name=\"Order[pro]['+key+'][id]\">

            </div></div>
        <div class=\"col-md-4\">
            <div class=\"form-group field-order-pro-'+key+'-product_id\">
                <label class=\"control-label\" for=\"order-pro-'+key+'-product_id\">Маҳсулот</label>
                <select id=\"order-pro-'+key+'-product_id\" class=\"form-control productid\" name=\"Order[pro]['+key+'][product_id]\" onchange=\"productchanger('+key+')\" data-key=\"'+key+'\">

                </select>

            </div></div>
        <div class=\"col-md-3\">
            <div class=\"form-group field-order-pro-'+key+'-cnt\">
                <label class=\"control-label\" for=\"order-pro-'+key+'-cnt\">Умумий сони</label>
                <input type=\"text\" id=\"order-pro-'+key+'-cnt\" class=\"form-control\" name=\"Order[pro]['+key+'][cnt]\" onkeyup=\"pricecalc('+key+')\">

            </div>                        </div>
        <div class=\"col-md-2\">
            <div class=\"form-group field-order-pro-'+key+'-price\">
                <label class=\"control-label\" for=\"order-pro-'+key+'-price\">Нархи</label>
                <input type=\"text\" id=\"order-pro-'+key+'-price\" class=\"form-control\" name=\"Order[pro]['+key+'][price]\" disabled=\"\" onkeyup=\"pricecalc('+key+')\">

            </div>                        </div>
        <div class=\"col-md-2\">
            <div class=\"form-group field-order-pro-'+key+'-cnt_price\">
                <label class=\"control-label\" for=\"order-pro-'+key+'-cnt_price\">Умумий нархи</label>
                <input type=\"text\" id=\"order-pro-'+key+'-cnt_price\" class=\"form-control\" name=\"Order[pro]['+key+'][cnt_price]\" disabled=\"\">

            </div>                        </div>
        <div class=\"col-md-1\">
            <button onclick=\"remover('+key+')\" type=\"button\" class=\"btn btn-danger remover\"><span class=\"fa fa-trash\"></span></button>
        </div>
    </div>

<?php }?>
