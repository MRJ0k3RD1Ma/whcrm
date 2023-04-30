<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Made;

/**
 * MadeSearch represents the model behind the search form of `common\models\Made`.
 */
class MadeSearch extends Made
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'note', 'created', 'updated'], 'safe'],
            [['product_id', 'user_id', 'box', 'consept_id', 'status'], 'integer'],
            [['price', 'cnt_price', 'cnt', 'cnt_total', 'c_cnt_total', 'c_cnt', 'c_cnt_price', 'c_box'], 'number'],
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
        $query = Made::find()->orderBy(['date' => SORT_DESC]);

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
            'date' => $this->date,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'price' => $this->price,
            'cnt_price' => $this->cnt_price,
            'cnt' => $this->cnt,
            'cnt_total' => $this->cnt_total,
            'box' => $this->box,
            'c_cnt_total' => $this->c_cnt_total,
            'c_cnt' => $this->c_cnt,
            'c_cnt_price' => $this->c_cnt_price,
            'c_box' => $this->c_box,
            'consept_id' => $this->consept_id,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
