<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "made_cost".
 *
 * @property string $date
 * @property int $product_id
 * @property int $user_id
 * @property int $granule_id
 * @property float|null $cnt
 * @property float|null $cnt_total
 *
 * @property Product $granule
 * @property Product $product
 * @property User $user
 */
class MadeCost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'made_cost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'product_id', 'user_id', 'granule_id'], 'required'],
            [['date'], 'safe'],
            [['product_id', 'user_id', 'granule_id'], 'integer'],
            [['cnt', 'cnt_total'], 'number'],
            [['date', 'product_id', 'user_id', 'granule_id'], 'unique', 'targetAttribute' => ['date', 'product_id', 'user_id', 'granule_id']],
            [['granule_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['granule_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'granule_id' => 'Granule ID',
            'cnt' => 'Cnt',
            'cnt_total' => 'Cnt Total',
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
