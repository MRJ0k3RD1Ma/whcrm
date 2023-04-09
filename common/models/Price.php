<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property int $id ID
 * @property int $product_id id tovar
 * @property int $base_price Bazaviy narx
 * @property int $retail_price Donali narxi
 * @property int $wholesale_price Optom narx
 * @property string $date Narx o`zgargan sana
 * @property int $user_id Kim o`zgartirdi
 *
 * @property Product $product
 * @property User $user
 * @property WhProduct[] $whProducts
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'base_price', 'retail_price', 'wholesale_price', 'date', 'user_id'], 'required'],
            [['id', 'product_id',  'user_id'], 'integer'],
            [['date'], 'safe'],
            [['base_price', 'retail_price', 'wholesale_price',], 'number'],
            [['id'], 'unique'],
            [['id', 'product_id'], 'unique', 'targetAttribute' => ['id', 'product_id']],
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
            'id' => 'ID',
            'product_id' => 'Mahsulot nomi',
            'base_price' => 'Kelish narxi',
            'retail_price' => 'Sotilish narxi',
            'wholesale_price' => 'Optom narxi',
            'date' => 'O`zgarish sanasi',
            'user_id' => 'O`zgartirdi',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[WhProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhProducts()
    {
        return $this->hasMany(WhProduct::class, ['price_id' => 'id']);
    }
}
