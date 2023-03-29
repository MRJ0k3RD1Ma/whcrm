<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property int $id
 * @property string $name
 *
 * @property Product[] $products
 * @property User[] $users
 * @property WareUser[] $wareUsers
 * @property WhProduct[] $whProducts
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->viaTable('wh_product', ['wh_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('ware_user', ['ware_id' => 'id']);
    }

    /**
     * Gets query for [[WareUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWareUsers()
    {
        return $this->hasMany(WareUser::class, ['ware_id' => 'id']);
    }

    /**
     * Gets query for [[WhProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhProducts()
    {
        return $this->hasMany(WhProduct::class, ['wh_id' => 'id']);
    }
}
