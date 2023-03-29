<?php

namespace frontend\modules\cp;
use Yii;
/**
 * cp module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\cp\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::$app->viewPath = '@frontend/modules/cp/views';
        // custom initialization code goes here
    }
}
