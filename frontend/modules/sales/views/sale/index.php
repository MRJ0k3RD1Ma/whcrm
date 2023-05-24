<?php

use common\models\order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/* @var $month integer*/
/* @var $year integer*/

$this->title = 'Ҳисоботлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label style="width:100%">Oyni tanlang
                                            <select name="month" class="form-control">
                                                <?php foreach(Yii::$app->params['date'] as $i=>$item):?>
                                                    <option value="<?=$i?>" <?= $month == $i ? 'selected' : ''?>><?=$item?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-5">
                                        <label style="width:100%">Yilni tanlang
                                            <select name="year" id="year" class="form-control">
                                                <?php for($i=2023;$i<=date('Y');$i++):?>
                                                    <option value="<?=$i?>" <?= $year == date('Y') ? 'selected' : ''?>><?=$i?></option>
                                                <?php endfor;?>

                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" style="margin-top:20px;" class="btn btn-primary">OK</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
