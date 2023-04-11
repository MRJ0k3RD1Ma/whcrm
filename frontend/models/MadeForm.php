<?php

namespace frontend\models;

use yii\base\Model;

class MadeForm extends Model
{
    public $pro;

    public function rules()
    {
        return [
            [['pro'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'pro' => 'Продукт',
        ];
    }


}