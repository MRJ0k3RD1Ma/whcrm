<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'serial_num', 'price', 'box', 'cat_id', 'is_sale', 'is_good', 'expiry_month', 'unit_id'], 'integer'],
            [['name', 'image', 'serial', 'note', 'code', 'bio', 'created_at', 'updated_at'], 'safe'],
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
        $query = Product::find();

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
            'serial_num' => $this->serial_num,
            'price' => $this->price,
            'box' => $this->box,
            'cat_id' => $this->cat_id,
            'is_sale' => $this->is_sale,
            'is_good' => $this->is_good,
            'expiry_month' => $this->expiry_month,
            'unit_id' => $this->unit_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'serial', $this->serial])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'bio', $this->bio]);

        return $dataProvider;
    }
}
