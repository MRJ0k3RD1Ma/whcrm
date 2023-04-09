<?php

namespace frontend\modules\cp\controllers;

use common\models\Price;
use common\models\Product;
use common\models\ProductMade;
use common\models\search\ProductSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $granule = new ProductMade();
        $granule->product_id = $id;
        if($granule->load($this->request->post())){
            if($granule->save()){
                Yii::$app->session->setFlash('success', 'Гранула қўшилди');
            }else{
                Yii::$app->session->setFlash('error', 'Гранула қўшилмади');
            }

            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'granule' => $granule,
        ]);
    }

    public function actionDeleteGranule($id,$granule_id){
        if($model = ProductMade::find()->where(['product_id'=>$id,'granule_id'=>$granule_id])->one()) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Гранула ўчирилди');
        }else{
            Yii::$app->session->setFlash('error', 'Гранула ўчирилмади');
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $code = Yii::$app->security->generateRandomString(10);
                while (Product::find()->where(['code'=>$code])->one()){
                    $code = Yii::$app->security->generateRandomString(10);
                }
                $model->code = $code;
                if(!$model->serial){
                    $ser = Product::find()->where(['cat_id'=>$model->cat_id])->max('serial_num');
                    if(!$ser){
                        $ser = 0;
                    }
                    $model->serial_num = $ser + 1;
                    $model->serial = $model->cat->code.'-'.$model->serial_num;
                }
                if($model->image = UploadedFile::getInstance($model, 'image')){
                    $name = time().$model->image->baseName.'.'.$model->image->extension;

                    $folderName = date('Y-m'); // Yil-oy formatida papka nomi
                    $dir = Yii::getAlias('@webroot/uploads/'.$folderName); // Yaratiladigan papka manzili
                    if (!file_exists($dir)) { // Papka mavjud emasligini tekshirish
                        mkdir($dir, 0777, true); // Papka yaratish
                    }
                    $model->image->saveAs($dir.'/'.$name);
                    $model->image = $folderName.'/'.$name;
                }else{
                    $model->image = 'no-image.png';
                }

                if($model->save()){
                    $id = Price::find()->where(['product_id'=>$model->id])->max('id');
                    if(!$id){
                        $id = 0;
                    }
                    $id++;
                    $price = new Price();
                    $price->id = $id;
                    $price->product_id = $model->id;
                    $price->base_price = $model->basic_price;
                    $price->retail_price = $model->retail_price;
                    $price->wholesale_price = $model->wholesale_price;
                    $price->date = date('Y-m-d');
                    $price->user_id = Yii::$app->user->id;
                    $price->save();

                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->session->setFlash('error', 'Mahsulotni saqlashda xatolik');
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $serial = $model->serial;
        $image = $model->image;
        if ($this->request->isPost && $model->load($this->request->post())) {

            if(!$model->serial){
                $ser = Product::find()->where(['cat_id'=>$model->cat_id])->max('serial_num');
                if(!$ser){
                    $ser = 0;
                }
                $model->serial_num = $ser + 1;
                $model->serial = $model->cat->code.'-'.$model->serial_num;
            }else{
                $model->serial = $serial;
            }
            if($model->image = UploadedFile::getInstance($model, 'image')){
                $name = time().$model->image->baseName.'.'.$model->image->extension;

                $folderName = date('Y-m'); // Yil-oy formatida papka nomi
                $dir = Yii::getAlias('@webroot/uploads/'.$folderName); // Yaratiladigan papka manzili
                if (!file_exists($dir)) { // Papka mavjud emasligini tekshirish
                    mkdir($dir, 0777, true); // Papka yaratish
                }
                $model->image->saveAs($dir.'/'.$name);
                $model->image = $folderName.'/'.$name;
            }else{
                $model->image = $image;
            }

            if($model->save()){
                if($price = Price::find()->where(['product_id'=>$model->id])->orderBy(['id'=>SORT_DESC])->one()){
                    if($price->base_price != $model->basic_price or
                    $price->retail_price != $model->retail_price or
                    $price->wholesale_price != $model->wholesale_price){
                        $id = Price::find()->where(['product_id'=>$model->id])->max('id');
                        if(!$id){
                            $id = 0;
                        }
                        $id++;
                        $price = new Price();
                        $price->id = $id;
                        $price->product_id = $model->id;
                        $price->base_price = $model->basic_price;
                        $price->retail_price = $model->retail_price;
                        $price->wholesale_price = $model->wholesale_price;
                        $price->date = date('Y-m-d');
                        $price->user_id = Yii::$app->user->id;
                        $price->save();
                    }
                }else{
                    $id = Price::find()->where(['product_id'=>$model->id])->max('id');
                    if(!$id){
                        $id = 0;
                    }
                    $id++;
                    $price = new Price();
                    $price->id = $id;
                    $price->product_id = $model->id;
                    $price->base_price = $model->basic_price;
                    $price->retail_price = $model->retail_price;
                    $price->wholesale_price = $model->wholesale_price;
                    $price->date = date('Y-m-d');
                    $price->user_id = Yii::$app->user->id;
                    $price->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'Mahsulotni saqlashda xatolik');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
