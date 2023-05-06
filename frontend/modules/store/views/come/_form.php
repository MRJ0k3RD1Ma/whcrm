<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Come $model */
/** @var yii\widgets\ActiveForm $form */
$model->scenario = 'insert';
?>

<div class="come-form">
    <script>
        var product = [];
        var productchanger = function(){};
        var pricecalc = function(){};
        var remover = function(){};
    </script>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date')->textInput(['type'=>'date']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model,'ware_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Warehouse::find()->where('id in (select ware_id from ware_user where user_id = '.Yii::$app->user->id.')')->all(),'id','name'),['prompt'=>'Омборхонани танланг'])?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'c_name')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'c_phone')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>
        </div>
        <div class="hidden" style="display: none">
            <?= $form->field($model,'c_id')->textInput(['value'=>-1])?>
        </div>
        <div class="col-md-12">
            <ul class="list-group" id="livesearch"></ul>
        </div>
    </div>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>
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
                <?= $form->field($model, 'pro[0][price]')->textInput(['maxlength' => true,'onkeyup' => 'pricecalc(0)',])->label('Нархи') ?>
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

        <?php foreach ($model->comeProducts as $key=>$item):?>

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
                        <?= $form->field($model, 'pro['.$key.'][price]')->textInput(['value'=>$item->price,'maxlength' => true,'onkeyup' => 'pricecalc('.$key.')',])->label('Нархи') ?>
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


    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$url_full_company = \yii\helpers\Url::to(['come/full-company']);
$url_company = \yii\helpers\Url::to(['come/company']);

$this->registerJs("
    $('.addbtn').click(function(){
        key = $('#products').data('key');
        var str = '<div class=\"row\"><div style=\"display: none\"><div class=\"form-group field-come-pro-'+key+'-id\"><input type=\"text\" id=\"come-pro-'+key+'-id\" class=\"form-control\" name=\"Come[pro]['+key+'][id]\"></div></div><div class=\"col-md-4\"><div class=\"form-group field-come-pro-'+key+'-product_id\"><label class=\"control-label\" for=\"come-pro-'+key+'-product_id\">Маҳсулот</label><select id=\"come-pro-'+key+'-product_id\" data-key=\"'+key+'\" class=\"form-control productid\" name=\"Come[pro]['+key+'][product_id]\" onchange=\"productchanger('+key+')\"></select></div></div><div class=\"col-md-3\"><div class=\"form-group field-come-pro-'+key+'-cnt\"><label class=\"control-label\" for=\"come-pro-'+key+'-cnt\">Умумий сони</label><input type=\"text\" id=\"come-pro-'+key+'-cnt\" class=\"form-control\" name=\"Come[pro]['+key+'][cnt]\" onkeyup=\"pricecalc('+key+')\"></div>        </div><div class=\"col-md-2\"><div class=\"form-group field-come-pro-'+key+'-price\"><label class=\"control-label\" for=\"come-pro-'+key+'-price\">Нархи</label><input type=\"text\" id=\"come-pro-'+key+'-price\" class=\"form-control\" name=\"Come[pro]['+key+'][price]\" onkeyup=\"pricecalc('+key+')\"></div>            </div><div class=\"col-md-2\"><div class=\"form-group field-come-pro-'+key+'-cnt_price\"><label class=\"control-label\" for=\"come-pro-'+key+'-cnt_price\">Умумий нархи</label><input type=\"text\" id=\"come-pro-'+key+'-cnt_price\" class=\"form-control\" name=\"Come[pro]['+key+'][cnt_price]\" disabled=\"\"></div></div><div class=\"col-md-1\"><button  onclick=\"remover('+key+')\"  type=\"button\" class=\"btn btn-danger remover\"><span class=\"fa fa-trash\"></span></button></div></div>';        
        $('#products').append(str);
        $.ajax({
            url: '/store/come/get-product',
            type: 'POST',
            success: function(data){
                $('#come-pro-'+key+'-product_id').html(data);
            }
        });
        $('#products').data('key',key+1);
    });
    
    productchanger = function(key){
        var product_id = $('#come-pro-'+key+'-product_id').val();
        
//        $('.productid').each(function(){
//            if($(this).data('key') != key){
//                $(this).find('option[value='+product_id+']').remove();
//            }
//        });
        
        $.ajax({
            url: '/store/come/get-price',
            type: 'POST',
            data: {product_id:product_id},
            success: function(data){
                $('#come-pro-'+key+'-price').val(data);
            }
        });
    }
    
    pricecalc = function(key){
        var cnt = $('#come-pro-'+key+'-cnt').val();
        var box = $('#come-pro-'+key+'-box').val();
        var price = $('#come-pro-'+key+'-price').val();
        
        $.get('/store/come/get-fullprice',{
            product_id:$('#come-pro-'+key+'-product_id').val(),
            box:box,
            cnt:cnt,
            price:price,
        },function(data){
            $('#come-pro-'+key+'-cnt_price').val(data);
        });
    }
    
    remover = function(key){
        $('#come-pro-'+key+'-product_id').parent().parent().parent().remove();
    }
    
     $('#come-c_name').keyup(function(){
            $('#livesearchname').html('');
            
            var searchField = $('#come-c_name').val();
            $('#come-c_id').val(-1);
            if(searchField.length == 0){
                $('#livesearch').html('');
                return;
            }
            $.get('{$url_company}?name='+searchField).done(function(data){
                $('#livesearch').empty(data);
                $('#livesearch').append(data);
            })               
        });
        $('#come-c_name').focusout(function(){
            setTimeout(function(){
                $('#livesearch').html('');
            }, 200);
        });
        $('#livesearch').on('click', 'li', function() {
            var click_text = $(this).text();
            
            $('#come-c_name').val($.trim(click_text));
            $.get('{$url_full_company}?id='+$(this).attr('data-key')).done(function(data){
                data = JSON.parse(data);
                $('#come-c_id').val(data.id);
                $('#come-c_name').val(data.name);
                $('#come-c_phone').val(data.phone);
            })
            $(\"#livesearch\").html('');
        });
    
");

?>

<?php if(false){?>


    <div class=\"row\">
        <div style=\"display: none\"><div class=\"form-group field-come-pro-'+key+'-id\"><input type=\"text\" id=\"come-pro-'+key+'-id\" class=\"form-control\" name=\"Come[pro]['+key+'][id]\"></div></div>
        <div class=\"col-md-4\">
            <div class=\"form-group field-come-pro-'+key+'-product_id\">
            <label class=\"control-label\" for=\"come-pro-'+key+'-product_id\">Маҳсулот</label>
            <select id=\"come-pro-'+key+'-product_id\" class=\"form-control\" name=\"Come[pro]['+key+'][product_id]\" onchange=\"productchanger('+key+')\">

            </select>

            </div>
        </div>
    <div class=\"col-md-2\">
        <div class=\"form-group field-come-pro-'+key+'-cnt\">
        <label class=\"control-label\" for=\"come-pro-'+key+'-cnt\">Умумий сони</label>
        <input type=\"text\" id=\"come-pro-'+key+'-cnt\" class=\"form-control\" name=\"Come[pro]['+key+'][cnt]\" onkeyup=\"pricecalc('+key+')\">

    </div>            </div>
    <div class=\"col-md-2\">
        <div class=\"form-group field-come-pro-'+key+'-box\">
        <label class=\"control-label\" for=\"come-pro-'+key+'-box\">Коропкалар сони</label>
        <input type=\"text\" id=\"come-pro-'+key+'-box\" class=\"form-control\" name=\"Come[pro]['+key+'][box]\" onkeyup=\"pricecalc('+key+')\">

    </div>            </div>
    <div class=\"col-md-2\">
        <div class=\"form-group field-come-pro-'+key+'-price\">
        <label class=\"control-label\" for=\"come-pro-'+key+'-price\">Нархи</label>
        <input type=\"text\" id=\"come-pro-'+key+'-price\" class=\"form-control\" name=\"Come[pro]['+key+'][price]\" onkeyup=\"pricecalc('+key+')\">

    </div>            </div>
    <div class=\"col-md-2\">
        <div class=\"form-group field-come-pro-'+key+'-cnt_price\">
        <label class=\"control-label\" for=\"come-pro-'+key+'-cnt_price\">Умумий нархи</label>
        <input type=\"text\" id=\"come-pro-'+key+'-cnt_price\" class=\"form-control\" name=\"Come[pro]['+key+'][cnt_price]\" disabled=\"\">

    </div>            </div>
    </div>


<?php }?>