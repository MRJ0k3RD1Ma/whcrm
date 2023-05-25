<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderPaid;

/**
 * OrderPaidSearch represents the model behind the search form of `common\models\OrderPaid`.
 */
class OrderPaidSearch extends OrderPaid
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'user_id', 'consept_id', 'status_id', 'payment_id'], 'integer'],
            [['name', 'note', 'file', 'date', 'created', 'updated'], 'safe'],
            [['price'], 'number'],
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
        $query = OrderPaid::find()->orderBy(['status_id'=>SORT_ASC,'id'=>SORT_DESC]);

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
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'price' => $this->price,
            'date' => $this->date,
            'consept_id' => $this->consept_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'status_id' => $this->status_id,
            'payment_id' => $this->payment_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
