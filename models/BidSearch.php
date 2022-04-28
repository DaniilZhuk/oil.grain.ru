<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bid;
use app\models\User;
/**
 * BidSearch represents the model behind the search form of `app\models\Bid`.
 */
class BidSearch extends Bid
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['basis', 'volume', 'price', 'logistic', 'nomenclature', 'end_date', 'quality', 'comment'], 'safe'],
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

        
        $date_now = date('Y-m-d H:i:s');
        $date_from = date('Y-m-d 23:59:59', strtotime($date_now. " - 1 day"));
        $date_to = date('Y-m-d 00:00:01', strtotime($date_now. " + 1 day"));
     
        $query = Bid::find()->where(['>','end_date', $date_from])->orderBy(['id'=>SORT_DESC]) ;
        //echo '<pre>';  var_dump($query);  echo '</pre>';  die;


       // $query = Bid::find()->orderBy(['id'=>SORT_DESC]);

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
            'end_date' => $this->end_date,
        ]);
        
        $query->andFilterWhere(['like', 'basis', $this->basis])
            ->andFilterWhere(['like', 'volume', $this->volume])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'logistic', $this->logistic])
            ->andFilterWhere(['like', 'nomenclature', $this->nomenclature])
            ->andFilterWhere(['like', 'quality', $this->quality])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
