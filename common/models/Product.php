<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string|null $serial
 * @property int|null $serial_num
 * @property int $basic_price
 * @property int $retail_price
 * @property int $wholesale_price
 * @property int $box
 * @property int $cat_id
 * @property string|null $note
 * @property string $code
 * @property string|null $bio
 * @property int $is_sale
 * @property int|null $is_good Granula bo'lsa 1 aks holda 0 yoziladi
 * @property int|null $expiry_month
 * @property int|null $unit_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Category $cat
 * @property Deliverable[] $deliverables
 * @property Price[] $prices
 * @property ProductImages $productImages
 * @property Supplier[] $suppliers
 * @property Unit $unit
 * @property WhProduct[] $whProducts
 * @property Warehouse[] $whs
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'basic_price', 'retail_price', 'wholesale_price', 'box', 'cat_id', 'code'], 'required'],
            [['serial_num', 'basic_price', 'retail_price', 'wholesale_price', 'box', 'cat_id', 'is_sale', 'is_good', 'expiry_month', 'unit_id'], 'integer'],
            [['bio'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image', 'serial', 'note', 'code'], 'string', 'max' => 255],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['unit_id' => 'id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
            'image' => 'Rasm',
            'serial' => 'Seriyasi',
            'serial_num' => 'Seriyasi',
            'basic_price' => 'Kelgan narxi',
            'retail_price' => 'Sotilish narxi',
            'wholesale_price' => 'Optom narx',
            'box' => 'Blokdagi soni',
            'cat_id' => 'Kategoriyasi',
            'note' => 'Izoh',
            'code' => 'Code',
            'bio' => 'Bio',
            'is_sale' => 'Sotiladigan mahsulot',
            'is_good' => 'Granula',
            'expiry_month' => 'Yaroqlilik muddati(oy)',
            'unit_id' => 'Birligi',
            'created_at' => 'Yaratildi',
            'updated_at' => 'O`zgartirildi',
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::class, ['id' => 'cat_id']);
    }

    /**
     * Gets query for [[Deliverables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeliverables()
    {
        return $this->hasMany(Deliverable::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Prices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasOne(ProductImages::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Supplier::class, ['id' => 'supplier_id'])->viaTable('deliverable', ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::class, ['id' => 'unit_id']);
    }

    /**
     * Gets query for [[WhProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhProducts()
    {
        return $this->hasMany(WhProduct::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Whs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhs()
    {
        return $this->hasMany(Warehouse::class, ['id' => 'wh_id'])->viaTable('wh_product', ['product_id' => 'id']);
    }
}
