<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_made".
 *
 * @property int $product_id
 * @property int $granule_id
 * @property float|null $count
 *
 * @property Product $granule
 * @property Product $product
 */
class ProductMade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_made';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count', 'granule_id'], 'required'],
            [['product_id', 'granule_id'], 'integer'],
            [['count'], 'number'],
            [['product_id', 'granule_id'], 'unique', 'targetAttribute' => ['product_id', 'granule_id']],
            [['granule_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['granule_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Маҳсулот',
            'granule_id' => 'Гранула',
            'count' => 'Сони',
        ];
    }

    /**
     * Gets query for [[Granule]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGranule()
    {
        return $this->hasOne(Product::class, ['id' => 'granule_id']);
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
