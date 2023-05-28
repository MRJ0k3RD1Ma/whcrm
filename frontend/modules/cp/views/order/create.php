<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\order $model */

$this->title = 'Буюртма қабул қилиш';
$this->params['breadcrumbs'][] = ['label' => 'Буюртмалар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

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
