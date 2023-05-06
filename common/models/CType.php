<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "c_type".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property CLegal[] $cLegals
 */
class CType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'c_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
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
     * Gets query for [[CLegals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCLegals()
    {
        return $this->hasMany(CLegal::class, ['type_id' => 'id']);
    }
}
