<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\Warehouse $model */
/** @var $searchModel \common\models\search\ProductSearch*/
/** @var $dataProvider \yii\data\ActiveDataProvider*/
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Omborxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="warehouse-view">

    <div class="card">
        <div class="card-body">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'label'=>'Mas`ullar',
                'value'=>function($data){
                    $users = $data->users;
                    $userNames = [];
                    foreach ($users as $user){
                        $userNames[] = $user->name;
                    }
                    return implode(', ', $userNames);
                },
            ],
        ],
    ]) ?>


            <br>
            <h4>Омборхонадаги маҳсулотлар рўйхати</h4>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute'=>'name',
                        'value'=>function($model){
                            return "<a href='".Url::toRoute(['product/view', 'id' => $model->id])."'>".$model->name."</a>";
                        },
                        'format'=>'raw'
                    ],
                    [
                        'attribute'=>'cat_id',
                        'value'=>function($model){
                            return "<a href='".Url::toRoute(['category/view', 'id' => $model->cat_id])."'>".$model->cat->name."</a>";
                        },
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Category::find()->all(), 'id', 'name'),
                        'format'=>'raw'
                    ],

                    [
                        'attribute'=>'unit_id',
                        'value'=>function($model){
                            return "<a href='".Url::toRoute(['unit/view', 'id' => $model->unit_id])."'>".$model->unit->name."</a>";
                        },
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Unit::find()->all(), 'id', 'name'),
                        'format'=>'raw'
                    ],
                    [
                        'label'=>'Сони',
                        'value'=>function($model){
                            return $model->getProductCount($model->id);
                        },
                    ],
                    [
                        'label'=>'Коробкалар сони',
                        'value'=>function($model){
                            return $model->getProductBoxCount($model->id);
                        },
                    ],
                    [
                        'label'=>'Умумий сони',
                        'value'=>function($model){
                            return $model->getProductCount($model->id) + $model->getProductBoxCount($model->id);
                        },
                    ],
                    'updated_at',
                ],
            ]); ?>

        </div>
    </div>
</div>
