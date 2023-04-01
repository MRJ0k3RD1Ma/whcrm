<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Supplier $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mahsulot yetkazuvchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="supplier-view">

    <div class="card">
        <div class="card-body">


            <p>
                <?= Html::a('O`zgartirish', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('O`chirish', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <div class="row">
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name',
                            'inn',
//            'bank_id',
                            [
                                'attribute'=>'bank_id',
                                'value'=>function($model){
                                    return $model->bank->mfo.'-'.$model->bank->name;
                                },
                            ],
                            'address',
                            'oked',
                            'account',
                            'director',
                            'director_phone',
                            'bux',
                            'bux_phone',
                            'phone',
                            'phone_name',
                            'created',
                            'updated',
                        ],
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?php $form = \yii\widgets\ActiveForm::begin(); $where = 'id not in (select product_id from deliverable where supplier_id ='.$model->id.')';?>
                    <?php if($delivery->isNewRecord){?>
                        <h5>Mahsulot qo`shish</h5>
                    <?php }else{ $where = "1";?>
                        <h5>O`zgartirish: <?= $delivery->product->name?></h5>
                    <?php }?>
                    <?= $form->field($delivery,'product_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Product::find()->where($where)->all(),'id','name'),['prompt'=>''])?>

                    <?= $form->field($delivery,'retail_price')->textInput()?>

                    <?= $form->field($delivery,'wholesale_price')->textInput()?>
                    <?= $form->field($delivery,'dtime')->textInput()?>
                    <?= $form->field($delivery,'dcondition')->textInput()?>

                    <?= Html::submitButton('Saqlash',['class'=>'btn btn-success'])?>

                    <?php \yii\widgets\ActiveForm::end()?>

                    <hr>
                    <h5>Yetkaziladigan mahsulotlar ro`yhati</h5>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Mahsulot nomi</th>
                            <th>Bitta narxi</th>
                            <th>Optom narxi</th>
                            <th>Amallar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($model->deliverables as $product):?>
                            <tr>
                                <td><?=$product->product->name?></td>
                                <td><?=$product->retail_price?></td>
                                <td><?=$product->wholesale_price?></td>
                                <td>


                                    <?= Html::a('<span class="fa fa-pencil"></span>', ['view','id'=>$model->id, 'product_id' => $product->product_id], [
                                        'class' => 'btn btn-primary',
                                    ]) ?>

                                    <?= Html::a('<span class="fa fa-trash"></span>', ['delete-delivery', 'product_id' => $product->product_id,'id'=>$product->supplier_id], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
