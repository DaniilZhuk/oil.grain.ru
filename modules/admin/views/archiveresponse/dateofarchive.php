<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\User;
use app\models\Bid;
use app\models\Response;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Архив откликов за ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bid-index">

    <h1><?= Html::encode($this->title) ?></h1>
  


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'tableOptions' => [
        //     'class' => 'table2'
        // ],
        'summary'=> false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'price',
           //'id_bid',
            [
                'attribute' => 'id_bid',
                'format' => 'raw',
                'value' => function($model){
                    $url = "http://oil.grain.ru/admin/bid/view?id=".$model->id_bid;             
                    return Html::a($model->id_bid, $url);
                    //return Html::a($model->name, Url::to(['категория/', 'param1' => $model->url, 'param2' => '.html']));
                },
            ],
            'volume',
            'logistic',
            //'date_start',
            [
                'attribute' => 'date_start',
                'format' =>  ['date', 'dd.MM.Y'],
                'options' => ['width' => '200']
            ],
            [
                'attribute' => 'date_end',
                'format' =>  ['date', 'dd.MM.Y'],
                'options' => ['width' => '200']
            ],
            // 'date_end',
            'bid.basis',
            'user.fio',
            'company',
            'user.inn',
            'comment',
            [
                'class' => ActionColumn::className(),
                // {view} {update} {delete}
                'template' => '{delete}',
                'visibleButtons' => [
                    'update' => function($data) { 
                        $userId = Yii::$app->user->getId();
                        $user = User::find()->where(['id'=>$userId])->one();
                        $is_admin = $user->is_admin;
                       // var_dump($is_admin);die;
                        return ($is_admin == 1 or $is_admin == 2) ; 
                    },
                    'delete' => function($data) { 
                        $userId = Yii::$app->user->getId();
                        $user = User::find()->where(['id'=>$userId])->one();
                        $is_admin = $user->is_admin;
                       // var_dump($is_admin);die;
                        return $is_admin == 1 or $is_admin == 2 ; 
                    },
                ]
            ],
        ],
    ]); ?>

</div>
