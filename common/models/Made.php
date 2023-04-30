<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "made".
 *
 * @property string $date
 * @property int $product_id
 * @property int $user_id
 * @property float|null $price
 * @property float|null $cnt_price
 * @property float|null $cnt
 * @property float|null $cnt_total
 * @property int|null $box
 * @property float|null $c_cnt_total
 * @property float|null $c_cnt
 * @property float|null $c_cnt_price
 * @property float|null $c_box
 * @property int|null $consept_id
 * @property int|null $status
 * @property string|null $note
 * @property string|null $created
 * @property string|null $updated
 *
 * @property User $consept
 * @property Product $product
 * @property User $user
 */
class Made extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'made';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'product_id', 'user_id'], 'required'],
            [['date', 'created', 'updated'], 'safe'],
            [['product_id', 'user_id', 'box', 'consept_id', 'status'], 'integer'],
            [['price', 'cnt_price', 'cnt', 'cnt_total', 'c_cnt_total', 'c_cnt', 'c_cnt_price', 'c_box'], 'number'],
            [['note'], 'string'],
            [['date', 'product_id', 'user_id'], 'unique', 'targetAttribute' => ['date', 'product_id', 'user_id']],
            [['consept_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['consept_id' => 'id']],
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
            'date' => 'Сана',
            'product_id' => 'Маҳсулот',
            'user_id' => 'Бригада',
            'price' => 'Нархи',
            'cnt_price' => 'Умумий нарх',
            'cnt' => 'Сони',
            'cnt_total' => 'Умумий сони',
            'box' => 'Каробкалар',
            'c_cnt_total' => 'Умумий сони(Текширув)',
            'c_cnt' => 'Сони(Текширув)',
            'c_cnt_price' => 'Умумий нарх(Текширув)',
            'c_box' => 'Каробкалар(Текширув)',
            'consept_id' => 'Текширувчи',
            'status' => 'Статус',
            'note' => 'Изоҳ',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
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

    public static function getStatus($status){
        $sts = [
            1=>'Жараёнда',
            2=>'Тасдиқланиши кутилмоқда',
            3=>'Тасдиқланган',
        ];
        return $sts[$status];
    }

    public static function getProductList(){
        $products = Product::find()->where(['is_good'=>1])->all();
        return ArrayHelper::map($products, 'id', 'name');
    }
}
