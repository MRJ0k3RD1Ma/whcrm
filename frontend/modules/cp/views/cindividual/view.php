<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\CIndividual $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'C Individuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cindividual-view">

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
            'pnfl',
            'inn',
            'passport',
            'address',
            'gender',
            'phone',
            'created',
            'updated',
        ],
    ]) ?>

        </div>
    </div>
</div>
