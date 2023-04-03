<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "come".
 *
 * @property int $id
 * @property string|null $date
 * @property int|null $supplier_id
 * @property string|null $note
 * @property int|null $creator_id
 * @property int|null $status
 * @property string|null $created
 * @property string|null $updated
 *
 * @property User $creator
 * @property Supplier $supplier
 */
class Come extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'come';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'created', 'updated'], 'safe'],
            [['supplier_id', 'creator_id', 'status'], 'integer'],
            [['note'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::class, 'targetAttribute' => ['supplier_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Сана',
            'supplier_id' => 'Етказиб берувчи',
            'note' => 'Изоҳ',
            'creator_id' => 'Қабул қилди',
            'status' => 'Статус',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
        ];
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, ['id' => 'supplier_id']);
    }
}
