<?php

namespace frontend\modules\cp\controllers;

use common\models\BrigadaProduct;
use common\models\ProductUser;
use common\models\User;
use common\models\search\UserSearch;
use common\models\WareUser;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id,$ware_id=null,$product_id = null,$brigada_id = null)
    {
        $model = $this->findModel($id);
        if($ware_id){
            $wareuser = WareUser::findOne(['user_id'=>$id,'ware_id'=>$ware_id]);
        }else{
            $wareuser = new WareUser();
            $wareuser->user_id = $id;
        }

        if ($this->request->isPost && $wareuser->load($this->request->post())) {
            if( $wareuser->save()){
                Yii::$app->session->setFlash('success', 'Muvoffaqiyatli Saqlandi');
            }else{
                Yii::$app->session->setFlash('error', 'Bu foydalanuvchiga allaqachon bu ombor biriktirilgan yoki ombor biriktirishda xatolik yuz berdi');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if($product_id){
            $productuser = ProductUser::findOne(['user_id'=>$id,'ware_id'=>$ware_id]);
        }else{
            $productuser = new ProductUser();
            $productuser->user_id = $id;
        }

        if ($this->request->isPost && $productuser->load($this->request->post())) {
            if( $productuser->save()){
                Yii::$app->session->setFlash('success', 'Muvoffaqiyatli Saqlandi');
            }else{
                Yii::$app->session->setFlash('error', 'Bu foydalanuvchiga allaqachon bu mahsulot biriktirilgan yoki mahsulotni biriktirishda xatolik yuz berdi');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if($brigada_id){
            $brigada = BrigadaProduct::findOne(['user_id'=>$id,'product_id'=>$brigada_id]);
        }else{
            $brigada = new BrigadaProduct();
            $brigada->user_id = $id;
        }
        if($brigada->load($this->request->post())){

            if($brigada->save(false)){
                Yii::$app->session->setFlash('success', 'Muvoffaqiyatli Saqlandi');
            }else{
                Yii::$app->session->setFlash('error', 'Bu foydalanuvchiga allaqachon bu mahsulot biriktirilgan yoki mahsulotni biriktirishda xatolik yuz berdi');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('view', [
            'model' => $model,
            'wareuser' => $wareuser,
            'productuser' => $productuser,
            'brigada' => $brigada,
        ]);
    }

    public function actionDeleteBrigada($id,$brigada_id)
    {
        $brigada = BrigadaProduct::findOne(['user_id'=>$id,'product_id'=>$brigada_id]);
        if($brigada->delete()){
            Yii::$app->session->setFlash('success', 'Muvoffaqiyatli O`chirildi');
        }else{
            Yii::$app->session->setFlash('error', 'Xatolik yuz berdi');
        }
        return $this->redirect(['view', 'id' => $id]);
    }



    public function actionDeleteWare($id,$ware_id)
    {
        $wareuser = WareUser::findOne(['user_id'=>$id,'ware_id'=>$ware_id]);
        $wareuser->delete();
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionDeleteProduct($id,$product_id)
    {
        $productuser = ProductUser::findOne(['user_id'=>$id,'product_id'=>$product_id]);
        $productuser->delete();
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = "create";

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->setPassword($model->password);
                $model->generateAuthKey();
                $model->save();
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
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pas = $model->password;
        if ($this->request->isPost && $model->load($this->request->post())) {
            if($model->password){
                $model->setPassword($model->password);
            }else{
                $model->password = $pas;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->password = "";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
