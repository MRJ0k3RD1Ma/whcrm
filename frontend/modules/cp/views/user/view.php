<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var common\models\WareUser $wareuser */
/** @var common\models\ProductUser $productuser */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Foydalanuvchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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

            <?php if($model->role_id == 2 or $model->role_id == 7){?>
            <div class="row">
                <div class="col-md-6">
            <?php }?>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name',
                            'username',
//            'password',
                            'phone',
                            'created',
                            'updated',
//            'role_id',
                            [
                                'attribute'=>'role_id',
                                'value'=>function($model){
                                    return $model->role->name;
                                }
                            ],
//            'status',
                            [
                                'attribute'=>'status',
                                'value'=>function($model){
                                    return Yii::$app->params['status'][$model->status];
                                }
                            ]
//            'auth_key',
//            'verification_token',
//            'password_reset_token',
                        ],
                    ]) ?>
            <?php if($model->role_id == 2 or $model->role_id == 7){?>

                </div>
                <div class="col-md-6">
                    <?php if($model->role_id == 2){?>
                         <?= $this->render('_wh',['model'=>$wareuser])?>
                    <?php } ?>

                    <?php if($model->role_id == 7){?>
                        <?= $this->render('_control',['model'=>$productuser])?>
                    <?php } ?>
                </div>


            </div>
            <?php }?>

        </div>
    </div>
</div>
