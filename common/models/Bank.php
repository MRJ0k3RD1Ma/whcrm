<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $id
 * @property string $mfo
 * @property string $name
 *
 * @property CLegal[] $cLegals
 * @property Supplier[] $suppliers
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mfo', 'name'], 'required'],
            [['mfo', 'name'], 'string', 'max' => 255],
            [['mfo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mfo' => 'Mfo',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[CLegals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCLegals()
    {
        return $this->hasMany(CLegal::class, ['bank_id' => 'id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Supplier::class, ['bank_id' => 'id']);
    }
}
