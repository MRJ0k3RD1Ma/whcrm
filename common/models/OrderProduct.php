<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property int $order_id
 * @property int $product_id
 * @property float|null $count
 * @property int|null $price_id
 * @property float|null $price
 * @property float|null $total_price
 *
 * @property Order $order
 * @property Price $price0
 * @property Product $product
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id'], 'required'],
            [['order_id', 'product_id', 'price_id'], 'integer'],
            [['count', 'price', 'total_price'], 'number'],
            [['order_id', 'product_id'], 'unique', 'targetAttribute' => ['order_id', 'product_id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
            [['price_id'], 'exist', 'skipOnError' => true, 'targetClass' => Price::class, 'targetAttribute' => ['price_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Буюртма',
            'product_id' => 'Маҳсулот',
            'count' => 'Сони',
            'price_id' => 'Нархи',
            'price' => 'Нархи',
            'total_price' => 'Умумий нархи',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    /**
     * Gets query for [[Price0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrice0()
    {
        return $this->hasOne(Price::class, ['id' => 'price_id']);
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
