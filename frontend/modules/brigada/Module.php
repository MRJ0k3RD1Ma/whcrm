<?php

namespace frontend\modules\brigada;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * store module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\brigada\controllers';
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
                            if(Yii::$app->user->identity->role_id == 8){
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
        Yii::$app->viewPath = '@frontend/modules/brigada/views';

        // custom initialization code goes here
    }
}
