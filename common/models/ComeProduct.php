<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "come_product".
 *
 * @property int $id
 * @property int $come_id
 * @property int $product_id
 * @property float|null $cnt
 * @property float|null $price
 * @property int|null $box
 * @property float|null $cnt_price
 *
 * @property Come $come
 * @property Product $product
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
            [['come_id', 'product_id', 'box','id'], 'integer'],
            [['cnt', 'price', 'cnt_price'], 'number'],
            [['come_id', 'product_id'], 'unique', 'targetAttribute' => ['come_id', 'product_id']],
            [['come_id'], 'exist', 'skipOnError' => true, 'targetClass' => Come::class, 'targetAttribute' => ['come_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'come_id' => 'Come ID',
            'product_id' => 'Product ID',
            'cnt' => 'Cnt',
            'price' => 'Price',
            'box' => 'Box',
            'cnt_price' => 'Cnt Price',
        ];
    }

    /**
     * Gets query for [[Come]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCome()
    {
        return $this->hasOne(Come::class, ['id' => 'come_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
