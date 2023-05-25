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
 * @property string|null $call_time
 * @property string|null $called_time
 * @property int|null $is_call
 * @property int|null $type_id
 *
 * @property Bank $bank
 */
class CLegal extends \yii\db\ActiveRecord
{
    public $debtor;
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
            [['bank_id','is_call'], 'integer'],
            [['name','phone','type_id'],'required'],
            [['created', 'updated','call_time','called_time'], 'safe'],
            [['name', 'inn', 'address', 'oked', 'account', 'director', 'director_phone', 'bux', 'bux_phone', 'phone', 'phone_name'], 'string', 'max' => 255],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::class, 'targetAttribute' => ['bank_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CType::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'name' => 'Ташкилот номи/ФИО',
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
            'is_call' => 'Қўнғироқ қилиш керакми?',
            'call_time' => 'Қўнғироқ вақти',
            'called_time' => 'Сўнги қўнғироқ',
            'type_id' => 'Мижоз тури',
            'debtor' => 'Қарздорлиги',
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

    public function getType(){
        return $this->hasOne(CType::class, ['id' => 'type_id']);
    }
}
