<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cms_news".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $image
 * @property int $cat_id
 * @property string $preview
 * @property string $detail
 * @property int $sort
 * @property int $show_counter
 * @property int $slider
 * @property int $vote
 * @property string $tags
 * @property int $author_id
 * @property int|null $modify_by
 * @property string $created
 * @property string $updated
 * @property int $status
 * @property int $active
 *
 * @property User $author
 * @property CmsCategory $cat
 */
class CmsNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'cat_id', 'preview', 'detail', 'author_id'], 'required'],
            [['cat_id', 'sort', 'show_counter', 'slider', 'vote', 'author_id', 'modify_by', 'status', 'active'], 'integer'],
            [['preview', 'detail'], 'string'],
            [['created', 'updated'], 'safe'],
            [['code', 'image'], 'string', 'max' => 255],
            [['name', 'tags'], 'string', 'max' => 500],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsCategory::class, 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'image' => 'Image',
            'cat_id' => 'Cat ID',
            'preview' => 'Preview',
            'detail' => 'Detail',
            'sort' => 'Sort',
            'show_counter' => 'Show Counter',
            'slider' => 'Slider',
            'vote' => 'Vote',
            'tags' => 'Tags',
            'author_id' => 'Author ID',
            'modify_by' => 'Modify By',
            'created' => 'Created',
            'updated' => 'Updated',
            'status' => 'Status',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(CmsCategory::class, ['id' => 'cat_id']);
    }
}
