<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ware_user".
 *
 * @property int $user_id
 * @property int $ware_id
 *
 * @property User $user
 * @property Warehouse $ware
 */
class WareUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ware_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'ware_id'], 'required'],
            [['user_id', 'ware_id'], 'integer'],
            [['user_id', 'ware_id'], 'unique', 'targetAttribute' => ['user_id', 'ware_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['ware_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::class, 'targetAttribute' => ['ware_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Foydalanuvchi',
            'ware_id' => 'Omborxona',
        ];
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

    /**
     * Gets query for [[Ware]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWare()
    {
        return $this->hasOne(Warehouse::class, ['id' => 'ware_id']);
    }
}
