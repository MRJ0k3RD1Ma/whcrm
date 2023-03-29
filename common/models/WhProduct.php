<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wh_product".
 *
 * @property int $wh_id
 * @property int $product_id
 * @property int $count
 * @property int $price_id
 * @property int|null $user_id
 * @property int $base_price
 * @property int $retail_price
 * @property int $wholesale_price
 * @property string|null $expiry_date
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Price $price
 * @property Product $product
 * @property User $user
 * @property Warehouse $wh
 */
class WhProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wh_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wh_id', 'product_id', 'count', 'price_id', 'base_price', 'retail_price', 'wholesale_price'], 'required'],
            [['wh_id', 'product_id', 'count', 'price_id', 'user_id', 'base_price', 'retail_price', 'wholesale_price'], 'integer'],
            [['expiry_date', 'created', 'updated'], 'safe'],
            [['wh_id', 'product_id'], 'unique', 'targetAttribute' => ['wh_id', 'product_id']],
            [['price_id'], 'exist', 'skipOnError' => true, 'targetClass' => Price::class, 'targetAttribute' => ['price_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['wh_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::class, 'targetAttribute' => ['wh_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wh_id' => 'Wh ID',
            'product_id' => 'Product ID',
            'count' => 'Count',
            'price_id' => 'Price ID',
            'user_id' => 'User ID',
            'base_price' => 'Base Price',
            'retail_price' => 'Retail Price',
            'wholesale_price' => 'Wholesale Price',
            'expiry_date' => 'Expiry Date',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * Gets query for [[Price]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrice()
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Wh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWh()
    {
        return $this->hasOne(Warehouse::class, ['id' => 'wh_id']);
    }
}
