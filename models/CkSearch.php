<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ck;

/**
 * CkSearch represents the model behind the search form of `app\models\Ck`.
 */
class CkSearch extends Ck
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['basis', 'agent', 'buyer', 'provider', 'status', 'payment', 'volume', 'price', 'logist', 'on_basis', 'date_from', 'date_to', 'comment'], 'safe'],
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
        $query = Ck::find();

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
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
        ]);

        $query->andFilterWhere(['like', 'basis', $this->basis])
            ->andFilterWhere(['like', 'agent', $this->agent])
            ->andFilterWhere(['like', 'buyer', $this->buyer])
            ->andFilterWhere(['like', 'provider', $this->provider])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'payment', $this->payment])
            ->andFilterWhere(['like', 'volume', $this->volume])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'logist', $this->logist])
            ->andFilterWhere(['like', 'on_basis', $this->on_basis])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
