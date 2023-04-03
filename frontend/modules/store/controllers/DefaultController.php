<?php

namespace frontend\modules\store\controllers;

use common\models\search\WarehouseSearch;
use common\models\User;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `store` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionWarehouse()
    {
        $searchModel = new WarehouseSearch();
        $dataProvider = $searchModel->searchStore($this->request->queryParams);

        return $this->render('warehouse', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProfile(){
        $model = User::findOne(Yii::$app->user->id);
        $login = $model->username;
        if($model->load($this->request->post())){
            $model->username = $login;
            if($model->password){
                $model->setPassword($model->password);
            }else{
                $model->password = $model->getOldAttribute('password');
            }
            if($model->save()){
                Yii::$app->session->setFlash('success', $model->name.' ma`lumotlaringiz o`zgartirildi');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error', 'Ma`lumotlaringizni qayta tekshiring');
            }
        }
        $model->password = "";
        return $this->render('profile',[
            'model'=>$model
        ]);
    }
}
