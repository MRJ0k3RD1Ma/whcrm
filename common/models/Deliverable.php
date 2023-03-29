<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "deliverable".
 *
 * @property int $product_id
 * @property int $supplier_id
 * @property int|null $retail_price
 * @property int|null $wholesale_price
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Product $product
 * @property Supplier $supplier
 */
class Deliverable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deliverable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'supplier_id'], 'required'],
            [['product_id', 'supplier_id', 'retail_price', 'wholesale_price'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['product_id', 'supplier_id'], 'unique', 'targetAttribute' => ['product_id', 'supplier_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::class, 'targetAttribute' => ['supplier_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'supplier_id' => 'Supplier ID',
            'retail_price' => 'Retail Price',
            'wholesale_price' => 'Wholesale Price',
            'created' => 'Created',
            'updated' => 'Updated',
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

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, ['id' => 'supplier_id']);
    }
}
