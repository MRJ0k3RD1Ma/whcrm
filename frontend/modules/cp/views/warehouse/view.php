<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Warehouse $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Omborxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="warehouse-view">

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

        </div>
    </div>
</div>
