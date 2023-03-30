<?php

use common\models\CIndividual;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CIndividualSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Jismoniy shaxslar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cindividual-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Jismoniy shaxs qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            'pnfl',
//            'inn',
            'passport',
            'address',
            //'gender',
            [
                'attribute'=>'gender',
                'value'=>function($d){
                    return $d->gendertxt;
                }
            ],
            'phone',
//            'created',
            'updated',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CIndividual $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
