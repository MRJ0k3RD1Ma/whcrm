<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_paid_status".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property OrderPaid[] $orderPas
 */
class OrderPaidStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_paid_status';
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
     * Gets query for [[OrderPas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPas()
    {
        return $this->hasMany(OrderPaid::class, ['status_id' => 'id']);
    }
}
