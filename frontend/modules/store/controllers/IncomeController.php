<?php

namespace frontend\modules\store\controllers;

use common\models\search\WarehouseSearch;
use common\models\User;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `store` module
 */
class IncomeController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }
}
