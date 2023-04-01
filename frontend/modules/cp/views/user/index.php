<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Foydalanuvchilar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="card">
        <div class="card-body">

    <p class="text-right">
        <?= Html::a('Foydalanuvchi qo`shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'username',
//            'password',
            'phone',
            //'created',
            //'updated',
            //'role_id',
            [
                'attribute' => 'role_id',
                'value' => function (User $model) {
                    return $model->role->name;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\Role::find()->all(), 'id', 'name')
            ],
            //'status',
            [
                'attribute' => 'status',
                'value' => function (User $model) {
                    return Yii::$app->params['status'][$model->status];
                },
                'filter' => Yii::$app->params['status']
            ],
            //'auth_key',
            //'verification_token',
            //'password_reset_token',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
