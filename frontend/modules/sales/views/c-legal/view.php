<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\CLegal $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Yuridik shaxslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clegal-view">

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
                    return $model->bank->name;
                }
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
    </div>
</div>
