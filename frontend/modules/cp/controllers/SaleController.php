<?php

namespace frontend\modules\cp\controllers;

use common\models\Order;
use common\models\OrderPaid;
use common\models\search\OrderPaidSearch;
use common\models\search\OrderSearch;
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
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchMonth($this->request->queryParams,$month,$year);

        $model = Order::find()->where(['MONTH(created)'=>$month,'YEAR(created)'=>$year])->all();
        $tushim = OrderPaid::find()->where(['MONTH(date)'=>$month,'YEAR(date)'=>$year])->sum('price');
        $qarz = Order::find()->where(['MONTH(created)'=>$month,'YEAR(created)'=>$year])->sum('debt');
        return $this->render('index',[
            'month'=>$month,
            'year'=>$year,
            'qarz'=>$qarz,
            'tushim'=>$tushim,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionKassa(){

        $searchModel = new OrderPaidSearch();
        $dataProvider = $searchModel->searchKassa($this->request->queryParams);
        $total = OrderPaid::find()->where(['between','date',$searchModel->to,$searchModel->do])->sum('price');

        return $this->render('kassa', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'total'=>$total
        ]);

    }
}
