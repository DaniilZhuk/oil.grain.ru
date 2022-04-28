<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bid;
use app\models\User;
/**
 * BidSearch represents the model behind the search form of `app\models\Bid`.
 */
class ArchiveSearch extends Archive
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
       
        $query = Archive::find()->where(['<=','end_date', $date_from])->orderBy(['id'=>SORT_DESC]) ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
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

    public function searchquery($params)
    {

        $date_start = $params['date_start'] ;
        $date_end =  $params['date_end']  ;
        $query = Archive::find()->where(['>','end_date', $date_start])->andWhere(['<','end_date', $date_end])->orderBy(['id'=>SORT_DESC]) ;
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
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
