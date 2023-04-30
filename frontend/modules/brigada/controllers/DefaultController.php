<?php

namespace frontend\modules\brigada\controllers;

use common\models\BrigadaProduct;
use common\models\Made;
use common\models\Price;
use common\models\Product;
use common\models\ProductMade;
use common\models\WhProduct;
use frontend\components\ProductComp;
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
        $t = true;
        if(Made::find()->where(['user_id'=>Yii::$app->user->id,'date'=>date('Y-m-d')])->andWhere(['>','status',1])->one()){
            $t = false;
        }
        return $this->render('index',[
            'model' => $products,
            't'=>$t,
        ]);
    }

    public function actionMade(){
        $model = new MadeForm();
        if(Made::find()->where(['user_id'=>Yii::$app->user->id,'date'=>date('Y-m-d')])->andWhere(['>','status',1])->one()){
            Yii::$app->session->setFlash('error','Siz bugungi kungi ishni yakunladingiz!');
            return $this->redirect(['index']);
        }
        if($model->load($this->request->post())){
            foreach ($model->pro as $key=>$item){
                $m = null;
                if(!($m = Made::find()->where(['product_id'=>$key,'user_id'=>Yii::$app->user->id,'date'=>date('Y-m-d')])->one())){
                    $m = new Made();
                }
                // o'zgarishlarni saqlash
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

            return $this->redirect(['index']);

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

    public function actionDone(){


        $model = Made::find()->where(['user_id'=>Yii::$app->user->id,'date'=>date('Y-m-d'),'status'=>1])->all();
        foreach ($model as $item){
            $item->status = 2;
            $item->price = BrigadaProduct::findOne(['product_id'=>$item->product_id,'user_id'=>$item->user_id])->price;
            $item->cnt_price = $item->cnt_total * $item->price;
            $item->save();
        }
        Yii::$app->session->setFlash('success','Birgadaning bajargan ishlari tekshiruvga yuborildi.');
        return $this->redirect(['index']);
    }
}
