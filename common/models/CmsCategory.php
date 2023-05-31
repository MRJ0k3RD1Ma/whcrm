<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cms_category".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $icon
 * @property int $parent_id
 * @property int $sort
 * @property int $status
 * @property int $active
 *
 * @property CmsNews[] $cmsNews
 */
class CmsCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'icon', 'parent_id', 'sort'], 'required'],
            [['parent_id', 'sort', 'status', 'active'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 50],
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
            'code' => 'Code',
            'icon' => 'Icon',
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
            'status' => 'Status',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[CmsNews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsNews()
    {
        return $this->hasMany(CmsNews::class, ['cat_id' => 'id']);
    }
}
