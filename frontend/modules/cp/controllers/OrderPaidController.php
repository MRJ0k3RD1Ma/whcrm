<?php

namespace frontend\modules\cp\controllers;

use common\models\OrderPaid;
use common\models\search\OrderPaidSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderPaidController implements the CRUD actions for OrderPaid model.
 */
class OrderPaidController extends Controller
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
     * Lists all OrderPaid models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderPaidSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAccept($id,$order_id){

    }

    /**
     * Displays a single OrderPaid model.
     * @param int $id ID
     * @param int $order_id Буюртма
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $order_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $order_id),
        ]);
    }

    /**
     * Creates a new OrderPaid model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new OrderPaid();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'order_id' => $model->order_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OrderPaid model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $order_id Буюртма
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $order_id)
    {
        $model = $this->findModel($id, $order_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'order_id' => $model->order_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OrderPaid model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $order_id Буюртма
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $order_id)
    {
        $this->findModel($id, $order_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderPaid model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $order_id Буюртма
     * @return OrderPaid the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $order_id)
    {
        if (($model = OrderPaid::findOne(['id' => $id, 'order_id' => $order_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
