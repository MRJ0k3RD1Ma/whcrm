<?php

namespace frontend\modules\brigada\controllers;

use common\models\BrigadaProduct;
use common\models\Product;
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
}
