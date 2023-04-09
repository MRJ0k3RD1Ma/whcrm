<?php

namespace frontend\modules\store\controllers;

use common\models\Come;
use common\models\ComeProduct;
use common\models\Deliverable;
use common\models\Price;
use common\models\Product;
use common\models\search\ComeSearch;
use common\models\Supplier;
use common\models\WhProduct;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * ComeController implements the CRUD actions for Come model.
 */
class ComeController extends Controller
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
     * Lists all Come models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ComeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Come model.
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
     * Creates a new Come model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Come();
        $model->date = date('Y-m-d');
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->creator_id = Yii::$app->user->id;
                $model->status = 1;
                if($model->c_id == -1){
                    if($s = Supplier::find()->where(['name'=>$model->c_name])->orWhere(['phone'=>$model->c_phone])->one()){
                        $model->supplier_id = $s->id;
                    }else{
                        $supplier = new Supplier();
                        $supplier->name = $model->c_name;
                        $supplier->phone = $model->c_phone;
                        $supplier->bank_id = 0;
                        $supplier->save();
                        $model->supplier_id = $supplier->id;
                    }
                }else{
                    $model->supplier_id = $model->c_id;
                }
                if($model->save()){
                    $pro = $model->pro;
                    foreach ($pro as $item) {
                        $come = new ComeProduct();
                        $id = ComeProduct::find()->where(['come_id'=>$model->id,'product_id'=>$item['product_id']])->max('id');
                        if(!$id){
                            $id = 0;
                        }
                        $id ++;
                        $come->id = $id;
                        $come->come_id = $model->id;
                        $come->product_id = $item['product_id'];
                        $come->price = $item['price'];
                        $come->cnt = $item['cnt'];
                        $come->box = $item['box'];
                        $come->cnt_price = ($item['cnt'] + $item['box'] * $come->product->box ) * $item['price'];
                        if($come->save()) {
                            $deliverable = null;
                            if ($deliverable = Deliverable::findOne(['supplier_id' => $model->supplier_id, 'product_id' => $item['product_id']])) {
                                $deliverable->retail_price = $item['price'];
                                $deliverable->save();
                            } else {
                                $deliverable = new Deliverable();
                                $deliverable->supplier_id = $model->supplier_id;
                                $deliverable->product_id = $item['product_id'];
                                $deliverable->retail_price = $item['price'];
                                $deliverable->save();
                            }
                            $product = null;
                            if ($product = Product::findOne($item['product_id'])) {
                                $price = null;
                                if ($price = Price::find()->where(['product_id' => $item['product_id']])->orderBy(['id' => SORT_DESC])->one()) {
                                    if ($price->base_price != $item['price']) {
                                        $pr = new Price();
                                        $id = Price::find()->where(['product_id' => $item['product_id']])->max('id');
                                        if (!$id) {
                                            $id = 0;
                                        }
                                        $id++;
                                        $pr->id = $id;
                                        $pr->product_id = $item['product_id'];
                                        $pr->base_price = $item['price'];
                                        $pr->retail_price = $price->retail_price;
                                        $pr->wholesale_price = $price->wholesale_price;
                                        $pr->user_id = Yii::$app->user->id;
                                        $pr->date = date('Y-m-d');
                                        $pr->save();
                                        $price = $pr;
                                    }
                                } else {
                                    $price = new Price();
                                    $price->id = 0;
                                    $price->product_id = $item['product_id'];
                                    $price->base_price = $item['price'];
                                    $price->retail_price = 0;
                                    $price->wholesale_price = 0;
                                    $price->user_id = Yii::$app->user->id;
                                    $price->date = date('Y-m-d');
                                    $price->save();
                                }
                                $product->save();
                            }


                            $whproduct = null;
                            if ($whproduct = WhProduct::findOne(['product_id' => $item['product_id'], 'wh_id' => $model->ware_id])) {
                                $whproduct->count += $item['cnt'];
                                $whproduct->price_id = $price->id;
                                $whproduct->user_id = Yii::$app->user->id;
                                $whproduct->base_price = $price->base_price;
                                $whproduct->retail_price = $price->retail_price;
                                $whproduct->wholesale_price = $price->wholesale_price;
                                $whproduct->box += $item['box'];
                                $whproduct->save();
                            }else{
                                $whproduct = new WhProduct();
                                $whproduct->product_id = $item['product_id'];
                                $whproduct->wh_id = $model->ware_id;
                                $whproduct->count = $item['cnt'];
                                $whproduct->price_id = $price->id;
                                $whproduct->user_id = Yii::$app->user->id;
                                $whproduct->base_price = $price->base_price;
                                $whproduct->retail_price = $price->retail_price;
                                $whproduct->wholesale_price = $price->wholesale_price;
                                $whproduct->box = $item['box'];
                                $whproduct->save();
                            }
                        }
                    }
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

    public function actionCompany($name){
        $model = Supplier::find()->where(['like','name',$name])
            ->orWhere(['like','phone',$name])
            ->all();
        $res = "";
        foreach ($model as $item) {
            $res .= "<li class=\"list-group-item live-link-class\" data-key='{$item->id}'>{$item->name} - {$item->phone}</li>";
        }
        return $res;
    }
    public function actionFullCompany($id){
        return json_encode(Supplier::findOne($id)->toArray());
    }
    public function actionGetPrice(){
        $id = $this->request->post('product_id');
        $model = Product::findOne($id);

        return $model->basic_price;
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
        $full_price = $price * $cnt + $box * $model->box * $price;
        return $full_price;
    }

    /**
     * Updates an existing Come model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Come model.
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
     * Finds the Come model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Come the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Come::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
