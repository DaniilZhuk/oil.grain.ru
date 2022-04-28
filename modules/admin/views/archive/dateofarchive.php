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

$this->title = 'Архив заявок за ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bid-index">

    <h1><?= Html::encode($this->title) ?></h1>

     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => ActionColumn::className(),
                // {view} {update} {delete}
                'template' => '{view}  {delete}',
                'visibleButtons' => [
                    // 'update' => function($data) { 
                    //     $userId = Yii::$app->user->getId();
                    //     $user = User::find()->where(['id'=>$userId])->one();
                    //     $is_admin = $user->is_admin;
                    //    // var_dump($is_admin);die;
                    //     return $is_admin == 1 ; 
                    // },
                    'delete' => function($data) { 
                        $userId = Yii::$app->user->getId();
                        $user = User::find()->where(['id'=>$userId])->one();
                        $is_admin = $user->is_admin;
                       // var_dump($is_admin);die;
                        return $is_admin == 1 ; 
                    },
                ]
            ],
            'id',
            'basis',
            'volume',
            'price',
            'end_date',
            [
                'attribute' => 'Кол.', // Для объединения с фоном
                'value' => 'responsecount'
            ]
            //'end_date',
            //'quality',
            //'comment',
           
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, Bid $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); 
     ?> 


</div>
