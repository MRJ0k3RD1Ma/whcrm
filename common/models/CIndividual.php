<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "c_individual".
 *
 * @property int $id
 * @property string $name
 * @property string|null $pnfl
 * @property string|null $inn
 * @property string|null $passport
 * @property string|null $address
 * @property int $gender
 * @property string|null $phone
 * @property string|null $created
 * @property string|null $updated
 */
class CIndividual extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'c_individual';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gender'], 'required'],
            [['gender'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['pnfl', 'inn', 'passport', 'address', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'name' => 'ФИО',
            'pnfl' => 'ЖШ ШИР(НПФЛ))',
            'inn' => 'СТИР(ИНН)',
            'passport' => 'Паспорт серия рақами',
            'address' => 'Манзили',
            'gender' => 'Жинси',
            'phone' => 'Телефон',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
        ];
    }

    public function getGendertxt(){
        return Yii::$app->params['gender'][$this->gender];
    }
}
