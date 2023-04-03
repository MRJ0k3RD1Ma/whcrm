<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "come_product".
 *
 * @property int $come_id
 * @property int $product_id
 * @property float|null $cnt
 * @property float|null $price
 * @property int|null $box
 * @property float|null $cnt_price
 */
class ComeProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'come_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['come_id', 'product_id'], 'required'],
            [['come_id', 'product_id', 'box'], 'integer'],
            [['cnt', 'price', 'cnt_price'], 'number'],
            [['come_id', 'product_id'], 'unique', 'targetAttribute' => ['come_id', 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'come_id' => 'Партия',
            'product_id' => 'Маҳсулот',
            'cnt' => 'Сони',
            'price' => 'Нархи',
            'box' => 'Каробкалар сони',
            'cnt_price' => 'Умумий нархи',
        ];
    }
}
