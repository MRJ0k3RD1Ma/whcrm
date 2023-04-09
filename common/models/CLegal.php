<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "c_legal".
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
 */
class CLegal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'c_legal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
            'id' => 'ИД',
            'name' => 'Ташкилот номи',
            'inn' => 'СТИР(ИНН)',
            'bank_id' => 'Банк',
            'address' => 'Манзили',
            'oked' => 'ОКЕД',
            'account' => 'Расмий счет',
            'director' => 'Директор',
            'director_phone' => 'Директор телефони',
            'bux' => 'Бухгалтер',
            'bux_phone' => 'Бухгалтер телефони',
            'phone' => 'Ташкилот телефони',
            'phone_name' => 'Маъсул телефони',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
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
}
