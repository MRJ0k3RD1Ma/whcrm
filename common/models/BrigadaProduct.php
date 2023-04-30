<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "brigada_product".
 *
 * @property int $user_id
 * @property int $product_id
 * @property numeric $price
 * @property int $unit_id
 *
 * @property Product $product
 * @property User $user
 */
class BrigadaProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brigada_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id','ware_id'], 'required'],
            [['user_id', 'product_id','ware_id'], 'integer'],
            [['price'],'number'],
            [['unit_id'],'integer'],
            [['user_id', 'product_id'], 'unique', 'targetAttribute' => ['user_id', 'product_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['ware_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::class, 'targetAttribute' => ['unit_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Фойдаланувчи',
            'product_id' => 'Маҳсулот',
            'price' => 'Нархи',
            'unit_id' => 'Бирлиги',
            'ware_id' => 'Маҳсулотлар олинадиган омборхона',
        ];
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

    public function getUnit()
    {
        return $this->hasOne(Unit::class, ['id' => 'unit_id']);
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

    public function getWare(){
        return $this->hasOne(Warehouse::class, ['id' => 'ware_id']);
    }


    public function getBrigadaProduct(){
        return $this->hasOne(BrigadaProduct::class, ['product_id' => 'id']);
    }
}
