<?php

namespace frontend\modules\sale\controllers;

use common\models\CLegal;
use common\models\Order;
use common\models\OrderPaid;
use common\models\OrderProduct;
use common\models\Price;
use common\models\Product;
use common\models\search\OrderSearch;
use common\models\Supplier;
use common\models\Warehouse;
use common\models\WhProduct;
use http\Client;
use Mpdf\Mpdf;
use Symfony\Component\Finder\Exception\AccessDeniedException;
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
        $model->scenario = 'insert';
        $model->date = date('Y-m-d');
        $model->plan_id = 1;
        $model->discount = 0;
        $model->qqs = 0;
        $model->user_id = Yii::$app->user->id;
        $model->status_id = 2;
        $model->delivery_price = 0;
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $code = Order::find()->where(['like','date',date('Y')])->max('code_id');
                if(!$code){
                    $code = 0;
                }
                $code ++;
                $model->code_id = $code;
                $model->code = date('Y').'-'.$code;
                if($model->c_id != -1){
                    $model->client_id = $model->c_id;
                }else{
                    if($cl = CLegal::findOne(['name'=>$model->c_name,'phone'=>$model->c_phone])){
                        $model->client_id = $cl->id;
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
        $model->scenario = 'insert';
        if($model->status_id > 2){
            throw new AccessDeniedException('Буюртма бажарилганлиги сабабли ўзгартириш мумкин эмас.');
        }
        $model->c_id = $model->client_id;
        $model->c_name = $model->client->name;
        $model->c_phone = $model->client->phone;
        $model->c_type = $model->client->type_id;
        $model->date = date('Y-m-d',strtotime($model->date));
        if ($this->request->isPost && $model->load($this->request->post())) {

            if($model->c_id != -1){
                $model->client_id = $model->c_id;
            }else{
                if($cl = CLegal::findOne(['name'=>$model->c_name,'phone'=>$model->c_phone])){
                    $model->client_id = $cl->id;
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
                $model->save();
                Yii::$app->session->setFlash('success','Буюртма муваффақиятли яратилди');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionPaid($id){
        $model = new OrderPaid();
        $model->order_id = $id;
        $model->status_id = 3;
        $model->user_id = Yii::$app->user->id;
        $model->date = date('Y-m-d');
        $ii = OrderPaid::find()->where(['order_id'=>$id])->max('id');
        if(!$ii) {
            $ii = 0;
        }
        $ii++;
        $model->id = $ii;

        if($model->load($this->request->post())){
            if($model->save()){
                $order = Order::findOne($id);
                $order->debt -= $model->price;
                $order->save();

                Yii::$app->session->setFlash('success','Тўлов муваффақиятли сақланди');
            }else{
                Yii::$app->session->setFlash('error','Тўловнинг майдонлари тўлиқ тўлдирилмаган');
            }
            return $this->redirect(['view','id'=>$id]);
        }
        return $this->renderAjax('_paid',[
            'model'=>$model
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

    public function actionDeletePaid($id,$order_id){
        if($model = OrderPaid::findOne(['id'=>$id,'order_id'=>$order_id])){
            $order = Order::findOne($order_id);
            $order->debt += $model->price;
            $order->save();
            $model->delete();
        }else{
            Yii::$app->session->setFlash('error','Тўлов маълумотлари топилмади');
        }
        return $this->redirect(['view','id'=>$order_id]);
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
        if(!(Price::find()->where(['product_id'=>$product_id])->orderBy(['id'=>SORT_DESC])->one())){
            $pr = new Price();
            $pr->product_id = $product_id;
            $pr->retail_price = $model->retail_price;
            $pr->base_price = $model->basic_price;
            $pr->wholesale_price = $model->wholesale_price;
            $pr->date = date('Y-m-d');
            $pr->user_id = Yii::$app->user->id;
            $iid = Price::find()->where(['product_id'=>$product_id])->max('id');
            if(!$iid){
                $iid = 0;
            }
            $iid++;
            $pr->id = $iid;
            $pr->save();
        }
        $full_price = $model->retail_price * $cnt + $box * $model->box * $model->retail_price;
        return $full_price;
    }


    public function actionCheck($id){


        $model = $this->findModel($id);

        $this->layout ="";
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'orientation' => 'P',
            'margin_footer'=>3,
            'margin_top'=>3,
            'margin_left'=>3,
            'margin_right'=>3,
            'format'=>[80,200]
        ]);
        $mpdf->use_kwt = true;
        $name = str_replace('/','-',$model->code.' '.$model->client->name).'.pdf';
        $mpdf->title = $model->client->name;

        $stylesheet = "table{border-collapse: collapse;}table, td, th {border: 1px solid black;}p{margin:0;padding:0;}hr{margin:0; padding:0;}";
        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

        $mpdf->WriteHTML($this->renderPartial('_check',['model'=>$model]));
        $p = 'p';
        $y = $mpdf->y;
        unset($mpdf->page[0]);
        $mpdf->page = 0;
        $mpdf->state = 0;
        $mpdf->_setPageSize([80,$y+20],$p);
        $mpdf->WriteHTML($this->renderPartial('_check',['model'=>$model]));

        return $mpdf->Output($name,'I');

    }


    public function actionSend($id){
        $model = $this->findModel($id);
        $model->scenario = 'send';
        if($model->load($this->request->post())){

            if($model->save(false)){
                if($model->status_id == 4) {
                    $wh_id = $model->wh_id;
                    foreach ($model->orderProducts as $item) {
                        $whProduct = WhProduct::find()->where(['wh_id' => $wh_id, 'product_id' => $item->product_id])->one();
                        if (!$whProduct) {
                            $whProduct = new WhProduct();
                            $whProduct->wh_id = $wh_id;
                            $whProduct->product_id = $item->product_id;
                            $whProduct->count = 0;
                            $price = Price::find()->where(['product_id' => $item->product_id])->one();
                            $whProduct->price_id = $price->id;
                            $whProduct->user_id = Yii::$app->user->id;
                            $whProduct->base_price = $price->base_price;
                            $whProduct->retail_price = $price->retail_price;
                            $whProduct->wholesale_price = $price->wholesale_price;
                        }
                        $whProduct->count -= $item->count;
                        $whProduct->save();
                    }
                    $pr_cnt = OrderPaid::find()->where(['order_id' => $model->id])->sum('price');
                    if($model->price == $pr_cnt){
                        $model->status_id = 5;
                        $model->save(false);
                    }
                }
                Yii::$app->session->setFlash('success','Мувоффақиятли сақланди');
            }else{
                Yii::$app->session->setFlash('error','Хатолик юз берди');
            }
            return $this->redirect(['view','id'=>$id]);
        }

        return $this->renderAjax('send',[
            'model'=>$model
        ]);
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
