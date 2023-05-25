<?php

namespace frontend\modules\sales\controllers;

use common\models\search\CLegalSearch;
use yii\web\Controller;

/**
 * Default controller for the `sales` module
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

    public function actionDebt(){

        $searchModel = new CLegalSearch();
        $dataProvider = $searchModel->searchDebt($this->request->queryParams);

        return $this->render('debt', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

}
