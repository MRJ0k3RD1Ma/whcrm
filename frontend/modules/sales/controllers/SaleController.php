<?php

namespace frontend\modules\sales\controllers;

use common\models\Order;
use yii\web\Controller;

/**
 * Default controller for the `sales` module
 */
class SaleController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($month = 0, $year = 0)
    {
        if($month == 0){
            $month = date('m');
        }
        if($year == 0){
            $year = date('Y');
        }
        $month = intval($month);
        $year = intval($year);
        if($month < 10){
            $month = '0'.$month;
        }

        $model = Order::find()->where(['MONTH(created)'=>$month,'YEAR(created)'=>$year])->all();

        return $this->render('index',[
            'month'=>$month,
            'year'=>$year
        ]);
    }
}
