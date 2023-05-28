<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\order $model */

$this->title = 'Ўзгартириш: ' . $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Буюртмалар', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->date, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ўзгартириш';
?>
<div class="order-update">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
