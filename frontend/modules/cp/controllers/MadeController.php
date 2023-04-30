<?php

namespace frontend\modules\cp\controllers;

use common\models\BrigadaProduct;
use common\models\Made;
use common\models\ProductMade;
use common\models\search\MadeSearch;
use common\models\WhProduct;
use frontend\components\ProductComp;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * MadeController implements the CRUD actions for Made model.
 */
class MadeController extends Controller
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
     * Lists all Made models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MadeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Made model.
     * @param string $date Date
     * @param string $product_id Product ID
     * @param string $user_id User ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($date, $product_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($date, $product_id, $user_id),
        ]);
    }
    public function actionConfirm($date, $product_id, $user_id)
    {

        $model = $this->findModel($date, $product_id, $user_id);
        if($model->status == 3){
            Yii::$app->session->setFlash('error','Bu ishlab chiqarilgan mahsulot avvalroq tasdiqlangan!');
            return $this->redirect(['index']);
        }
        $model->c_cnt = $model->cnt;
        $model->c_cnt_price = $model->cnt_price;
        $model->c_cnt_total = $model->cnt_total;
        $model->c_box = $model->box;
        // remove from product
        $wh = null;
        if(!($wh = WhProduct::findOne(['product_id'=>$model->product_id,'wh_id'=>BrigadaProduct::findOne(['product_id'=>$model->product_id,'user_id'=>$model->user_id])->ware_id]))){
            ProductComp::actionCreate(BrigadaProduct::findOne(['product_id'=>$model->product_id,'user_id'=>$model->user_id])->ware_id,$model->product_id);
        }
        $wh = WhProduct::findOne(['product_id'=>$model->product_id,'wh_id'=>BrigadaProduct::findOne(['product_id'=>$model->product_id,'user_id'=>$model->user_id])->ware_id]);
        $wh->count += $model->cnt;
        $wh->box += $model->box;
        $wh->save();

        $pro = ProductMade::find()->where(['product_id'=>$model->product_id])->all();

        foreach ($pro as $i){
            $ware = null;
            if(!($ware = WhProduct::findOne(['product_id'=>$i->granule_id,'wh_id'=>$wh->wh_id]))){
                ProductComp::actionCreate($wh->wh_id,$i->granule_id);
            }
            $ware = WhProduct::findOne(['product_id'=>$i->granule_id,'wh_id'=>$wh->wh_id]);

            $ware->count -= $i->count;
            $ware->save();
        }
        $model->consept_id = Yii::$app->user->id;
        $model->status = 3;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Creates a new Made model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Made();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'date' => $model->date, 'product_id' => $model->product_id, 'user_id' => $model->user_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Made model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $date Date
     * @param string $product_id Product ID
     * @param string $user_id User ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($date, $product_id, $user_id)
    {
        $model = $this->findModel($date, $product_id, $user_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'date' => $model->date, 'product_id' => $model->product_id, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Made model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $date Date
     * @param string $product_id Product ID
     * @param string $user_id User ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($date, $product_id, $user_id)
    {
        $this->findModel($date, $product_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Made model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $date Date
     * @param string $product_id Product ID
     * @param string $user_id User ID
     * @return Made the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($date, $product_id, $user_id)
    {
        if (($model = Made::findOne(['date' => $date, 'product_id' => $product_id, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
