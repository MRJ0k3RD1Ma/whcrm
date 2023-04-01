<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id
 * @property string $name
 * @property string|null $inn
 * @property int|null $bank_id
 * @property string|null $address
 * @property string|null $oked
 * @property string|null $account
 * @property string|null $director
 * @property string|null $director_phone
 * @property string|null $bux
 * @property string|null $bux_phone
 * @property string|null $phone
 * @property string|null $phone_name
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Bank $bank
 * @property Deliverable[] $deliverables
 * @property Product[] $products
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','inn',],'required'],
            [['bank_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'inn', 'address', 'oked', 'account', 'director', 'director_phone', 'bux', 'bux_phone', 'phone', 'phone_name'], 'string', 'max' => 255],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::class, 'targetAttribute' => ['bank_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tashkilot nomi',
            'inn' => 'STIR(INN)',
            'bank_id' => 'Bank',
            'address' => 'Manzil',
            'oked' => 'OKED',
            'account' => 'Hisob raqami',
            'director' => 'Direktor',
            'director_phone' => 'Direktor telefoni',
            'bux' => 'Buxgalter',
            'bux_phone' => 'Buxgalter telefoni',
            'phone' => 'Telefon',
            'phone_name' => 'Mas`ul hodim',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
        ];
    }

    /**
     * Gets query for [[Bank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::class, ['id' => 'bank_id']);
    }

    /**
     * Gets query for [[Deliverables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeliverables()
    {
        return $this->hasMany(Deliverable::class, ['supplier_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->viaTable('deliverable', ['supplier_id' => 'id']);
    }
}
