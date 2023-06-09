<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CLegal;

/**
 * CLegalSearch represents the model behind the search form of `common\models\CLegal`.
 */
class CLegalSearch extends CLegal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bank_id','type_id'], 'integer'],
            [['name', 'inn', 'address', 'oked', 'account', 'director', 'director_phone', 'bux', 'bux_phone', 'phone', 'phone_name', 'created', 'updated'], 'safe'],
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
        $query = CLegal::find()->orderBy(['id'=>SORT_DESC]);

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
            'bank_id' => $this->bank_id,
            'type_id' => $this->type_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'oked', $this->oked])
            ->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'director_phone', $this->director_phone])
            ->andFilterWhere(['like', 'bux', $this->bux])
            ->andFilterWhere(['like', 'bux_phone', $this->bux_phone])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'phone_name', $this->phone_name]);

        return $dataProvider;
    }


    public function searchDebt($params)
    {
        $query = CLegal::find()
            ->select(['c_legal.*','sum(order.debt) as debtor'])
            ->innerJoin('order','order.client_id = c_legal.id')
            ->where(['<','order.status_id',5])
            ->orderBy(['debtor'=>SORT_DESC]);

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
            'bank_id' => $this->bank_id,
            'type_id' => $this->type_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'oked', $this->oked])
            ->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'director_phone', $this->director_phone])
            ->andFilterWhere(['like', 'bux', $this->bux])
            ->andFilterWhere(['like', 'bux_phone', $this->bux_phone])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'phone_name', $this->phone_name]);

        return $dataProvider;
    }
}
