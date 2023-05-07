<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $user_id
 * @property int|null $plan_id
 * @property string|null $code
 * @property int|null $code_id
 * @property float|null $price
 * @property float|null $discount
 * @property float|null $qqs
 * @property float|null $debt
 * @property int|null $type_id
 * @property string|null $date
 * @property int|null $is_delivery
 * @property string|null $address
 * @property string|null $localtion
 * @property int|null $status_id
 * @property int|null $wh_id
 * @property string|null $created
 * @property string|null $updated
 * @property string|null $note
 * @property number|null $delivery_price
 *
 * @property CLegal $client
 * @property OrderProduct[] $orderProducts
 * @property PaymentPlan $plan
 * @property Product[] $products
 * @property OrderStatus $status
 * @property OrderType $type
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    public $c_name,$c_phone,$c_id,$pro,$c_type;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'user_id', 'plan_id', 'c_id','code_id', 'type_id', 'is_delivery', 'status_id','c_type'], 'integer'],
            [['type_id','c_type','wh_id','date','c_name','c_phone'],'required'],
            [['price', 'discount', 'qqs', 'debt','delivery_price'], 'number'],
            [['date', 'created', 'updated','note','pro'], 'safe'],
            [['localtion'], 'string'],
            [['code', 'address','c_name','c_phone'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => CLegal::class, 'targetAttribute' => ['client_id' => 'id']],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentPlan::class, 'targetAttribute' => ['plan_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderType::class, 'targetAttribute' => ['type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['wh_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::class, 'targetAttribute' => ['wh_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Мижоз',
            'user_id' => 'Сотувчи',
            'plan_id' => 'Тўлов тури',
            'code' => 'Чек коди',
            'code_id' => 'код',
            'price' => 'Умумий нарх',
            'discount' => 'Чегирма',
            'qqs' => 'ҚҚС',
            'debt' => 'Қарздорлик',
            'type_id' => 'Буюртма тури',
            'date' => 'Буюртма санаси',
            'is_delivery' => 'Ектазиб бериш керакми?',
            'address' => 'Манзил',
            'localtion' => 'Локация',
            'status_id' => 'Статус',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
            'wh_id' => 'Омборхона',
            'c_name' => 'Ташкилот номи/ФИО',
            'c_id' => 'ид',
            'c_phone' => 'Телефон',
            'note' => 'Изоҳ',
            'c_type' => 'Тури',
            'delivery_price' => 'Етказиш нархи',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(CLegal::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[OrderProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(PaymentPlan::class, ['id' => 'plan_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->viaTable('order_product', ['order_id' => 'id']);
    }


    public function getOrders(){
        return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
    }
    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(OrderType::class, ['id' => 'type_id']);
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
