<?php

namespace frontend\modules\cp\controllers;

use common\models\Deliverable;
use common\models\search\DeliverableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeliverableController implements the CRUD actions for Deliverable model.
 */
class DeliverableController extends Controller
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
     * Lists all Deliverable models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DeliverableSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Deliverable model.
     * @param string $product_id Product ID
     * @param int $supplier_id Supplier ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($product_id, $supplier_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($product_id, $supplier_id),
        ]);
    }

    /**
     * Creates a new Deliverable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Deliverable();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'product_id' => $model->product_id, 'supplier_id' => $model->supplier_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Deliverable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $product_id Product ID
     * @param int $supplier_id Supplier ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($product_id, $supplier_id)
    {
        $model = $this->findModel($product_id, $supplier_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'product_id' => $model->product_id, 'supplier_id' => $model->supplier_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Deliverable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $product_id Product ID
     * @param int $supplier_id Supplier ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($product_id, $supplier_id)
    {
        $this->findModel($product_id, $supplier_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Deliverable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $product_id Product ID
     * @param int $supplier_id Supplier ID
     * @return Deliverable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id, $supplier_id)
    {
        if (($model = Deliverable::findOne(['product_id' => $product_id, 'supplier_id' => $supplier_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
