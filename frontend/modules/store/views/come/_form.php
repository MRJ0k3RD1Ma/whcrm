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
        var productchanger = function(){};
    </script>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model,'ware_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Warehouse::find()->all(),'id','name'),['prompt'=>'Омборхонани танланг'])?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'c_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'c_phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div id="products" data-key="1">
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'pro[0][product_id]')->dropDownList(
                        \yii\helpers\ArrayHelper::map(\common\models\Product::find()->all(),'id','name'),
                        ['prompt'=>'','onchange'=>'productchanger(0)'])->label('Маҳсулот') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'pro[0][cnt]')->textInput(['maxlength' => true,])->label('Умумий сони') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'pro[0][box]')->textInput(['maxlength' => true,])->label('Коропкалар сони') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'pro[0][price]')->textInput(['maxlength' => true,])->label('Нархи') ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'pro[0][cnt_price]')->textInput(['maxlength' => true])->label('Умумий нархи') ?>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary addbtn"><span class="fa fa-plus"></span></button>


    <br><br>



    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php

$this->registerJs("
    $('.addbtn').click(function(){
        key = $('#products').data('key');
        var str = '<div class=\"row\">    <div class=\"col-md-4\">        <div class=\"form-group field-come-pro-'+key+'-product_id\">            <label class=\"control-label\" for=\"come-pro-'+key+'-product_id\">Маҳсулот</label>            <select id=\"come-pro-'+key+'-product_id\" class=\"form-control\" name=\"Come[pro]['+key+'][product_id]\" onchange=\"productchanger('+key+')\">            </select>        </div>               </div>    <div class=\"col-md-2\">        <div class=\"form-group field-come-pro-'+key+'-cnt\">            <label class=\"control-label\" for=\"come-pro-'+key+'-cnt\">Умумий сони</label>            <input type=\"text\" id=\"come-pro-'+key+'-cnt\" class=\"form-control\" name=\"Come[pro]['+key+'][cnt]\">                </div>               </div>    <div class=\"col-md-2\">        <div class=\"form-group field-come-pro-'+key+'-box\">            <label class=\"control-label\" for=\"come-pro-'+key+'-box\">Коропкалар сони</label>            <input type=\"text\" id=\"come-pro-'+key+'-box\" class=\"form-control\" name=\"Come[pro]['+key+'][box]\">                </div>               </div>    <div class=\"col-md-2\">        <div class=\"form-group field-come-pro-'+key+'-price\">            <label class=\"control-label\" for=\"come-pro-'+key+'-price\">Нархи</label>            <input type=\"text\" id=\"come-pro-'+key+'-price\" class=\"form-control\" name=\"Come[pro]['+key+'][price]\">        </div>               </div>    <div class=\"col-md-2\">        <div class=\"form-group field-come-pro-'+key+'-cnt_price\">            <label class=\"control-label\" for=\"come-pro-'+key+'-cnt_price\">Умумий нархи</label>            <input type=\"text\" id=\"come-pro-'+key+'-cnt_price\" class=\"form-control\" name=\"Come[pro]['+key+'][cnt_price]\">        </div>    </div></div>';        
        $('#products').append(str);
        $('#come-pro-'+key+'-product_id').html($('#come-pro-0-product_id').html());
        $('#products').data('key',key+1);
    });
    
    productchanger = function(key){
        var product_id = $('#come-pro-'+key+'-product_id').val();
        $.ajax({
            url: '/store/come/get-price',
            type: 'POST',
            data: {product_id:product_id},
            success: function(data){
                $('#come-pro-'+key+'-price').val(data);
            }
        });
    }
    
    
");

?>

<?php if(false){?>

<div class=\"row\">
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
            <input type=\"text\" id=\"come-pro-'+key+'-cnt\" class=\"form-control\" name=\"Come[pro]['+key+'][cnt]\">

        </div>
    </div>
    <div class=\"col-md-2\">
        <div class=\"form-group field-come-pro-'+key+'-box\">
            <label class=\"control-label\" for=\"come-pro-'+key+'-box\">Коропкалар сони</label>
            <input type=\"text\" id=\"come-pro-'+key+'-box\" class=\"form-control\" name=\"Come[pro]['+key+'][box]\">

        </div>
    </div>
    <div class=\"col-md-2\">
        <div class=\"form-group field-come-pro-'+key+'-price\">
            <label class=\"control-label\" for=\"come-pro-'+key+'-price\">Нархи</label>
            <input type=\"text\" id=\"come-pro-'+key+'-price\" class=\"form-control\" name=\"Come[pro]['+key+'][price]\">
        </div>
    </div>
    <div class=\"col-md-2\">
        <div class=\"form-group field-come-pro-'+key+'-cnt_price\">
            <label class=\"control-label\" for=\"come-pro-'+key+'-cnt_price\">Умумий нархи</label>
            <input type=\"text\" id=\"come-pro-'+key+'-cnt_price\" class=\"form-control\" name=\"Come[pro]['+key+'][cnt_price]\">
        </div>
    </div>
</div>

<?php }?>