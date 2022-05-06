<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Archiveck;
use Yii;
/**
 * CkSearch represents the model behind the search form of `app\models\Ck`.
 */
class ArchiveckSearch extends Archiveck
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
        $query = Archiveck::find();

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


    public function searchquery($params)
    {

        $userId = Yii::$app->user->getId();
        $user= User::find()->where(['id'=>$userId])->one();
        $userIsadmin = $user->is_admin;

        $date_start = $params['date_start'] ;
        $date_end =  $params['date_end']  ;
       // $query = Archive::find()->where(['>','end_date', $date_start])->andWhere(['<','end_date', $date_end])->orderBy(['id'=>SORT_DESC]) ;

        if ($userIsadmin == 1 or $userIsadmin == 2){
            $query = Archiveck::find()
            //->joinWith('bid')
            ->where(['>','date_ck', $date_start])
            ->andWhere(['<','date_ck', $date_end])
            ->orderBy(['id'=>SORT_DESC]);
        } else {
            $query = Archiveck::find()->where(['id_user'=>$userId]);
        }
        //echo '<pre>'; var_dump($query);die;
       

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
        ]);

        return $dataProvider;
    }
}
