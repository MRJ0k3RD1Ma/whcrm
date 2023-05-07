<?php

namespace frontend\modules\sales\controllers;

use common\models\CLegal;
use common\models\Order;
use common\models\OrderProduct;
use common\models\Price;
use common\models\Product;
use common\models\search\OrderSearch;
use common\models\Supplier;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * OrderController implements the CRUD actions for order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Order();
        $model->date = date('Y-m-d');
        $model->plan_id = 1;
        $model->discount = 0;
        $model->qqs = 0;
        $model->user_id = Yii::$app->user->id;
        $model->status_id = 1;
        $model->delivery_price = 0;
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $code = Order::find()->where(['like','date','%'.date('Y').'%'])->max('code_id');
                if(!$code){
                    $code = 0;
                }
                $code ++;
                $model->code_id = $code;
                $model->code = date('Y').'-'.$code;
                if($model->c_id != -1){
                    $model->client_id = $model->c_id;
                }else{
                    $client = new CLegal();
                    $client->name = $model->c_name;
                    $client->phone = $model->c_phone;
                    $client->type_id = $model->c_type;
                    if($client->save()){
                        $model->client_id = $client->id;
                    }else{
                        Yii::$app->session->setFlash('error', 'Мижоз маълумотларини сақлашда хатолик');
                    }
                }
                if($model->is_delivery != 1){
                    $model->delivery_price = 0;
                }

                if($model->save()){
                    foreach ($model->pro as $key=>$item){
                        if($product = OrderProduct::findOne(['order_id'=>$model->id,'product_id'=>$item['product_id']])){
                            $product->count += $item['cnt'];
                            $price = Price::find()->where(['product_id'=>$item['product_id']])->orderBy(['id'=>SORT_DESC])->one();
                            $product->price = $price->retail_price;
                            $product->total_price = $product->count * $price->retail_price;
                            $product->price_id = $price->id;
                            $product->save();
                        }else{
                            $product = new OrderProduct();
                            $product->order_id = $model->id;
                            $product->product_id = $item['product_id'];
                            $product->count = $item['cnt'];
                            $price = Price::find()->where(['product_id'=>$item['product_id']])->orderBy(['id'=>SORT_DESC])->one();
                            $product->price = $price->retail_price;
                            $product->total_price = $item['cnt'] * $price->retail_price;
                            $product->price_id = $price->id;
                            $product->save();
                        }

                    }
                    // umumiy narx xisob kitobi
                    $model->price = OrderProduct::find()->where(['order_id'=>$model->id])->sum('total_price') + $model->delivery_price - $model->discount;
                    $model->price = $model->price - $model->qqs * $model->price / 100;
                    $model->debt = $model->price;

                    // to'lovni qabul qilish va to'lovlarni shakllantirish



                    $model->save();

                    Yii::$app->session->setFlash('success','Буюртма муваффақиятли яратилди');
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->c_id = $model->client_id;
        $model->c_name = $model->client->name;
        $model->c_phone = $model->client->phone;
        $model->c_type = $model->client->type_id;
        $model->date = date('Y-m-d',strtotime($model->date));
        if ($this->request->isPost && $model->load($this->request->post())) {
            if($model->c_id != -1){
                $model->client_id = $model->c_id;
            }else{
                $client = new CLegal();
                $client->name = $model->c_name;
                $client->phone = $model->c_phone;
                $client->type_id = $model->c_type;
                if($client->save()){
                    $model->client_id = $client->id;
                }else{
                    Yii::$app->session->setFlash('error', 'Мижоз маълумотларини сақлашда хатолик');
                }
            }
            if($model->is_delivery != 1){
                $model->delivery_price = 0;
            }

            if($model->save()){
                foreach ($model->pro as $key=>$item){
                    if($product = OrderProduct::findOne(['order_id'=>$model->id,'product_id'=>$item['product_id']])){
                        $product->count += $item['cnt'];
                        $price = Price::find()->where(['product_id'=>$item['product_id']])->orderBy(['id'=>SORT_DESC])->one();
                        $product->price = $price->retail_price;
                        $product->total_price = $product->count * $price->retail_price;
                        $product->price_id = $price->id;
                        $product->save();
                    }else{
                        $product = new OrderProduct();
                        $product->order_id = $model->id;
                        $product->product_id = $item['product_id'];
                        $product->count = $item['cnt'];
                        $price = Price::find()->where(['product_id'=>$item['product_id']])->orderBy(['id'=>SORT_DESC])->one();
                        $product->price = $price->retail_price;
                        $product->total_price = $item['cnt'] * $price->retail_price;
                        $product->price_id = $price->id;
                        $product->save();
                    }

                }
                // umumiy narx xisob kitobi
                $model->price = OrderProduct::find()->where(['order_id'=>$model->id])->sum('total_price') + $model->delivery_price - $model->discount;
                $model->price = $model->price - $model->qqs * $model->price / 100;
                $model->save();
                Yii::$app->session->setFlash('success','Буюртма муваффақиятли яратилди');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCompany($name){
        $model = CLegal::find()->where(['like','name',$name])
            ->orWhere(['like','phone',$name])
            ->all();
        $res = "";
        foreach ($model as $item) {
            $res .= "<li class=\"list-group-item live-link-class\" data-key='{$item->id}'>{$item->name} - {$item->phone}</li>";
        }
        return $res;
    }
    public function actionFullCompany($id){
        return json_encode(CLegal::findOne($id)->toArray());
    }
    public function actionGetPrice(){
        $id = $this->request->post('product_id');
        $model = Product::findOne($id);

        return $model->retail_price;
    }

    public function actionGetProduct(){
        $model = Product::find()->where(['is_sale'=>1])->all();
        $res = "<option value='0'></option>";
        foreach ($model as $item) {
            $res .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        return $res;
    }

    public function actionGetFullprice($product_id,$cnt=0,$box=0,$price=0){
        $model = Product::findOne($product_id);
        if(!$box){
            $box = 0;
        }
        if(!$cnt){
            $cnt = 0;
        }
        if(!$price){
            $price = 0;
        }
        $full_price = $model->retail_price * $cnt + $box * $model->box * $model->retail_price;
        return $full_price;
    }



    /**
     * Deletes an existing order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
