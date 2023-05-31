<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CmsNews;

/**
 * CmsNewsSearch represents the model behind the search form of `common\models\CmsNews`.
 */
class CmsNewsSearch extends CmsNews
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'sort', 'show_counter', 'slider', 'vote', 'author_id', 'modify_by', 'status', 'active'], 'integer'],
            [['code', 'name', 'image', 'preview', 'detail', 'tags', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CmsNews::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cat_id' => $this->cat_id,
            'sort' => $this->sort,
            'show_counter' => $this->show_counter,
            'slider' => $this->slider,
            'vote' => $this->vote,
            'author_id' => $this->author_id,
            'modify_by' => $this->modify_by,
            'created' => $this->created,
            'updated' => $this->updated,
            'status' => $this->status,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}
