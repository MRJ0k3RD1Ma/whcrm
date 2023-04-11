<?php

namespace frontend\modules\brigada\controllers;

use common\models\BrigadaProduct;
use common\models\Product;
use frontend\models\MadeForm;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `brigada` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $products = BrigadaProduct::find()->where(['user_id'=>Yii::$app->user->id])->all();

        return $this->render('index',[
            'model' => $products
        ]);
    }

    public function actionMade(){
        $model = new MadeForm();

        if($model->load($this->request->post())){
            debug($model);
        }

        return $this->render('made',[
           'model' => $model,
        ]);
    }

    public function actionTotal($cnt,$box,$price,$id){
        $model = BrigadaProduct::find()->where(['product_id'=>$id,'user_id'=>Yii::$app->user->id])->one();

        $total = $cnt + ($box*$model->product->box);
        return $total;
    }
}
