<?php

namespace frontend\modules\sales;

use yii\filters\AccessControl;
use Yii;
/**
 * sales module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\sales\controllers';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if(Yii::$app->user->identity->role_id == 4){
                                return true;
                            }else{
                                return Yii::$app->response->redirect([Yii::$app->user->identity->role->url]);
                            }
                        }
                    ],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::$app->viewPath = '@frontend/modules/sales/views';
        // custom initialization code goes here
    }
}
