<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\order;

/**
 * OrderSearch represents the model behind the search form of `common\models\order`.
 */
class OrderSearch extends order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'user_id', 'plan_id', 'code_id', 'type_id', 'is_delivery', 'status_id'], 'integer'],
            [['code', 'date', 'address', 'localtion', 'created', 'updated'], 'safe'],
            [['price', 'discount', 'qqs', 'debt'], 'number'],
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
        $query = order::find()->orderBy(['id'=>SORT_DESC]);

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
            'client_id' => $this->client_id,
            'user_id' => $this->user_id,
            'plan_id' => $this->plan_id,
            'code_id' => $this->code_id,
            'price' => $this->price,
            'discount' => $this->discount,
            'qqs' => $this->qqs,
            'debt' => $this->debt,
            'type_id' => $this->type_id,
            'date' => $this->date,
            'is_delivery' => $this->is_delivery,
            'status_id' => $this->status_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'localtion', $this->localtion]);

        return $dataProvider;
    }
}
