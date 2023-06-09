<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\CmsNews $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cms News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cms-news-view">

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
            'code',
            'name',
            'image',
            'cat_id',
            'preview:ntext',
            'detail:ntext',
            'sort',
            'show_counter',
            'slider',
            'vote',
            'tags',
            'author_id',
            'modify_by',
            'created',
            'updated',
            'status',
            'active',
        ],
    ]) ?>

        </div>
    </div>
</div>
