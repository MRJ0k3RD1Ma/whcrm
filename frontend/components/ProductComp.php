<?php
namespace frontend\components;
use common\models\BrigadaProduct;
use common\models\Price;
use common\models\Product;
use common\models\WhProduct;
use Yii;
class ProductComp extends \yii\base\Component{
    public static function actionCreate($wh_id,$product_id){
        $wh = new WhProduct();
        $wh->product_id = $product_id;
        // 'wh_id', 'product_id', 'count', 'price_id', 'base_price', 'retail_price', 'wholesale_price'
        $wh->wh_id = $wh_id;
        $wh->count = 0;
        $wh->box = 0;
        $wh->user_id = Yii::$app->user->id;
        $price = null;
        if(!($price = Price::find()->where(['product_id'=>$product_id])->orderBy(['id'=>SORT_DESC])->one())){
            $id = Price::find()->where(['product_id'=>$product_id])->max('id');
            if(!$id){
                $id = 0;
            }
            $id++;
            $price = new Price();
            $price->id = $id;
            $price->product_id = $product_id;
            $price->base_price = Product::findOne($product_id)->basic_price;
            $price->retail_price = Product::findOne($product_id)->retail_price;
            $price->wholesale_price = Product::findOne($product_id)->wholesale_price;
            $price->user_id = Yii::$app->user->id;
            $price->date = date('Y-m-d');
            $price->save();
        }

        $wh->price_id = $price->id;
        $wh->base_price = $price->base_price;
        $wh->retail_price = $price->retail_price;
        $wh->wholesale_price = $price->wholesale_price;
        $wh->save();
    }
}