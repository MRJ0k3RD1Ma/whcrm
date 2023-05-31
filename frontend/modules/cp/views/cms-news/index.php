<?php

use common\models\CmsNews;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CmsNewsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cms News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-news-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Create Cms News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'name',
            'image',
            'cat_id',
            //'preview:ntext',
            //'detail:ntext',
            //'sort',
            //'show_counter',
            //'slider',
            //'vote',
            //'tags',
            //'author_id',
            //'modify_by',
            //'created',
            //'updated',
            //'status',
            //'active',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CmsNews $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
