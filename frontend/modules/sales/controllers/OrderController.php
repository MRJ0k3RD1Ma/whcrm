<?php

namespace frontend\modules\sales\controllers;

use common\models\CLegal;
use common\models\Order;
use common\models\Product;
use common\models\search\OrderSearch;
use common\models\Supplier;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
    public function actionFullCompany($id,$type_id){
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
     * Updates an existing order model.
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
