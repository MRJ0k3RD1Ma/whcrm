<?php

namespace frontend\modules\store\controllers;

use common\models\Come;
use common\models\Product;
use common\models\search\ComeSearch;
use common\models\Supplier;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
                echo "<pre>";
                var_dump($model);
                exit;
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
