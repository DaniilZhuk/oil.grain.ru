<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_admin'], 'integer'],
            
            [['fio', 'inn', 'mail', 'tel', 'username', 'password', 'authKey', 'accessToken'], 'safe'],
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
        
        if ($userIsadmin == 1 or $userIsadmin == 2){
            $query = User::find();
        } else {
            $query = User::find()->where(['id'=>$userId]);
        }
        // $query = User::find();

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

        $query->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'tel', $this->tel]);
            // ->andFilterWhere(['like', 'username', $this->username])
            // ->andFilterWhere(['like', 'password', $this->password])
            // ->andFilterWhere(['like', 'authKey', $this->authKey])
            // ->andFilterWhere(['like', 'accessToken', $this->accessToken]);

        return $dataProvider;
    }
}
