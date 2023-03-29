<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\CLegal $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'C Legals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clegal-view">

    <div class="card">
        <div class="card-body">


            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'bank_id',
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
