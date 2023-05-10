<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_paid".
 *
 * @property int $id
 * @property int $order_id
 * @property string|null $name
 * @property int|null $user_id
 * @property string|null $note
 * @property string|null $file
 * @property float|null $price
 * @property string|null $date
 * @property int|null $consept_id
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $status_id
 *
 * @property User $consept
 * @property Order $order
 * @property OrderPaidStatus $status
 * @property User $user
 */
class OrderPaid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_paid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id','payment_id','price','date'], 'required'],
            [['id', 'order_id', 'payment_id','user_id', 'consept_id', 'status_id'], 'integer'],
            [['note'], 'string'],
            [['price'], 'number'],
            [['date', 'created', 'updated'], 'safe'],
            [['name', 'file'], 'string', 'max' => 255],
            [['id', 'order_id'], 'unique', 'targetAttribute' => ['id', 'order_id']],
            [['consept_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['consept_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderPaidStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::class, 'targetAttribute' => ['payment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Буюртма',
            'name' => 'Пул тўловчи',
            'user_id' => 'Қабул қилди',
            'note' => 'Изоҳ',
            'file' => 'Чек файли',
            'price' => 'Тўлов суммаси',
            'date' => 'Сана',
            'consept_id' => 'Тасдиқлади',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
            'status_id' => 'Статус',
            'payment_id' => 'тўлов тури',
        ];
    }

    /**
     * Gets query for [[Consept]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsept()
    {
        return $this->hasOne(User::class, ['id' => 'consept_id']);
    }

    public function getPayment()
    {
        return $this->hasOne(Payment::class, ['id' => 'payment_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderPaidStatus::class, ['id' => 'status_id']);
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
