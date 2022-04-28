<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Archiveresponse;
use app\models\Response;
use app\models\User;
use Yii;
/**
 * ArchiveresponseSearch represents the model behind the search form of `app\models\Archiveresponse`.
 */
class ArchiveresponseSearch extends Archiveresponse
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user','id_bid'], 'integer'],
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
        $userId = Yii::$app->user->getId();
        $user= User::find()->where(['id'=>$userId])->one();
        $userIsadmin = $user->is_admin;
        if ($userIsadmin == 1){
            $query = Archiveresponse::find();
        } else {
            $query = Archiveresponse::find()->where(['id_user'=>$userId]);
        }

       

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
            'id_user' => $this->id_user,
            'price' => $this->price,
            'id_bid'=> $this->id_bid,
            'company'=> $this->company,
        ]);

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
            $query = Archiveresponse::find()
            ->joinWith('bid')
            ->where(['>','bid.end_date', $date_start])
            ->andWhere(['<','bid.end_date', $date_end])
            ->orderBy(['id'=>SORT_DESC]);
        } else {
            $query = Archiveresponse::find()->where(['id_user'=>$userId]);
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
