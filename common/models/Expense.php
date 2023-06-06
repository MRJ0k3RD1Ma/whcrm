<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "expense".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $type_id
 * @property int|null $payment_id
 * @property string|null $date
 * @property float|null $price
 * @property string|null $note
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Payment $payment
 * @property ExpenseType $type
 * @property User $user
 */
class Expense extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type_id', 'payment_id'], 'integer'],
            [['date', 'created', 'updated'], 'safe'],
            [['date','type_id','payment_id','price'],'required'],
            [['price'], 'number'],
            [['note'], 'string'],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::class, 'targetAttribute' => ['payment_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExpenseType::class, 'targetAttribute' => ['type_id' => 'id']],
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
            'user_id' => 'Фойдаланувчи',
            'type_id' => 'Харажат тури',
            'payment_id' => 'Тўлов тури',
            'date' => 'Сана',
            'price' => 'Нархи',
            'note' => 'Изоҳ',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
        ];
    }

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::class, ['id' => 'payment_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ExpenseType::class, ['id' => 'type_id']);
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
