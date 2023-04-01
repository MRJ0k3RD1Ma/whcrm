<?php

namespace frontend\modules\cp\controllers;

use common\models\Deliverable;
use common\models\Supplier;
use common\models\search\SupplierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * SupplierController implements the CRUD actions for Supplier model.
 */
class SupplierController extends Controller
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
                        'delete-delivery' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Supplier models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SupplierSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeleteDelivery($id,$product_id){
        if($delivery = Deliverable::findOne(['supplier_id' => $id,'product_id' => $product_id])){
            if($delivery->delete()){
                Yii::$app->session->setFlash('success','Muvoffaqiyatli o`chirildi');
            }else{
                Yii::$app->session->setFlash('error','Xatolik yuz berdi');
            }
        }
        $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Displays a single Supplier model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id,$product_id = null)
    {
        $model = $this->findModel($id);
        if($product_id){
            $delivery = Deliverable::findOne(['supplier_id' => $model->id,'product_id' => $product_id]);
        }else{
            $delivery = new Deliverable();
            $delivery->supplier_id = $model->id;
        }
        if($this->request->isPost && $delivery->load($this->request->post())){
            if($delivery->save()){
                Yii::$app->session->setFlash('success','Muvoffaqiyatli saqlandi');
            }else{
                Yii::$app->session->setFlash('error','Bu mahsulot allaqachon ro`yxatdan o`tgan');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('view', [
            'model' => $model,
            'delivery' => $delivery,
        ]);
    }

    /**
     * Creates a new Supplier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Supplier();

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

    /**
     * Updates an existing Supplier model.
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
     * Deletes an existing Supplier model.
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
     * Finds the Supplier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Supplier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Supplier::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
