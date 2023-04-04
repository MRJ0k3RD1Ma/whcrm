<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "come".
 *
 * @property int $id
 * @property string|null $date
 * @property int|null $supplier_id
 * @property string|null $note
 * @property int|null $creator_id
 * @property int|null $status
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $ware_id
 *
 * @property ComeProduct[] $comeProducts
 * @property User $creator
 * @property Product[] $products
 * @property Supplier $supplier
 * @property Warehouse $ware
 */
class Come extends \yii\db\ActiveRecord
{
    public $c_name,$c_phone,$pro;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'come';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'created', 'updated','pro'], 'safe'],
            [['date','ware_id',],'required'],
            [['c_name',],'required','on'=>'insert'],
            [['supplier_id', 'creator_id', 'status', 'ware_id'], 'integer'],
            [['note','c_name','c_phone'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::class, 'targetAttribute' => ['supplier_id' => 'id']],
            [['ware_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::class, 'targetAttribute' => ['ware_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Сана',
            'supplier_id' => 'Етказиб берувчи',
            'note' => 'Излҳ',
            'creator_id' => 'Қабул қилди',
            'status' => 'Статус',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
            'ware_id' => 'Омборхона',
            'c_name' => 'Етказиб берувчи',
            'c_phone' => 'Телефон',
        ];
    }

    /**
     * Gets query for [[ComeProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComeProducts()
    {
        return $this->hasMany(ComeProduct::class, ['come_id' => 'id']);
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->viaTable('come_product', ['come_id' => 'id']);
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

    /**
     * Gets query for [[Ware]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWare()
    {
        return $this->hasOne(Warehouse::class, ['id' => 'ware_id']);
    }
}
