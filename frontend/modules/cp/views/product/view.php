<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var \common\models\ProductMade $granule*/
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mahsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

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
//            'id',
                            'name',
//            'image',
                            [
                                'attribute'=>'image',
                                'value'=>function($model){
                                    return "<a  href='".Yii::$app->request->baseUrl."/uploads/".$model->image."' target='_blank'><img src='".Yii::$app->request->baseUrl."/uploads/".$model->image."' width='100'></a>";
                                },
                                'format'=>'html',
                            ],
                            'serial',
//            'serial_num',
                            'basic_price',
                            'retail_price',
                            'wholesale_price',
                            'box',
//            'cat_id',
                            [
                                'attribute'=>'cat_id',
                                'value'=>function($model){
                                    return "<a href='".Url::toRoute(['category/view', 'id' => $model->cat_id])."'>".$model->cat->name."</a>";
                                },
                                'format'=>'html',
                            ],
                            'note',
//            'code',
                            'bio:ntext',
//            'is_sale',
                            [
                                'attribute'=>'is_sale',
                                'value'=>function($model){
                                    return Yii::$app->params['is_sale'][$model->is_sale];
                                },
                            ],
//            'is_good',
                            [
                                'attribute'=>'is_good',
                                'value'=>function($model){
                                    return Yii::$app->params['is_good'][$model->is_good];
                                },
                            ],
                            'expiry_month',
//            'unit_id',
                            [
                                'attribute'=>'unit_id',
                                'value'=>function($model){
                                    return $model->unit->name;
                                },
                            ],
                            'created_at',
                            'updated_at',
                        ],
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?php if($model->is_good){?>
                        <h4>Ушбу маҳсулотни ишлаб чиқариш учун керакли гранулалар</h4>
                        <?php $form = ActiveForm::begin()?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($granule, 'granule_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Product::find()->where(['is_good'=>0])->andWhere('id not in (select granule_id from product_made where product_id='.$model->id.')')->all(), 'id', 'name'), ['prompt'=>'','class'=>'form-control select2']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($granule, 'count')->textInput() ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                        </div>
                        <?php ActiveForm::end()?>

                    <br>
                    <h5>Ушбу маҳсулотни ишлаб чиқариш учун керакли гранулалар</h5>
                        <table class="table table-bordered dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Гранула</th>
                                <th>Миқдори</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($model->granules as $key => $granule): ?>
                                <tr>
                                    <td><?= $key+1 ?></td>
                                    <td><?= $granule->granule->name ?></td>
                                    <td><?= $granule->count .' '.$granule->granule->unit->name?></td>
                                    <td><a href="<?= Yii::$app->urlManager->createUrl(['/cp/product/delete-granule','id'=>$model->id,'granule_id'=>$granule->granule_id])?>" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <br>
                    <?php }?>
                    <h5>Ushbu mahsulotni yetkazib beruvchilar</h5>
                    <table class="table table-bordered dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomi</th>
                            <th>Narxi</th>
                            <th>Optom narxi</th>
                            <th>Muddat</th>
                            <th>Shartlari</th>
                            <th>Telefon</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($model->suppliers as $key => $supplier): $del = \common\models\Deliverable::findOne(['product_id'=>$model->id, 'supplier_id'=>$supplier->id]) ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $supplier->name ?></td>
                                <td><?= $del->retail_price ?></td>
                                <td><?= $del->wholesale_price ?></td>
                                <td><?= $del->dtime ?></td>
                                <td><?= $del->dcondition ?></td>
                                <td><?= $supplier->phone ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
