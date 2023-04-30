<?php

namespace frontend\modules\brigada\controllers;

use common\models\BrigadaProduct;
use common\models\Made;
use common\models\Product;
use common\models\ProductMade;
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
            foreach ($model->pro as $key=>$item){
                $m = null;
                if(!($m = Made::find()->where(['product_id'=>$key,'user_id'=>Yii::$app->user->id,'date'=>date('Y-m-d')])->one())){
                    $m = new Made();
                }
                $m->user_id = Yii::$app->user->id;
                $m->product_id = $key;
                $m->cnt = $item['cnt'];
                $m->box = $item['box'];
                $m->price = BrigadaProduct::findOne(['product_id'=>$key,'user_id'=>$m->user_id])->price;
                $m->date = date('Y-m-d');
                $m->cnt_total = $m->cnt + $m->box * $m->product->box;
                $m->cnt_price = $m->cnt_total * $m->price;
                $m->status = 1;
                $m->save();

            }

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
