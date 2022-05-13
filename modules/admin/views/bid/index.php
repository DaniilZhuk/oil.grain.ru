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

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bid-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
             if ($is_admin == 1 or $is_admin == 2){
                echo Html::a('Опубликовать сегодняшние заявки', ['create-bids'], ['class' => 'btn btn-info mb20']);
                echo '<br>';
                echo Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']);
                // echo '<br>';
                // echo Html::a('Отправить на почту', ['send-mail'], ['class' => 'btn btn-success']);
             } 
        ?>
        
    </p>

    <?php // echo date_default_timezone_get(); // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => ActionColumn::className(),
                // {view} {update} {delete}
                'template' => '{view} {update}  {delete}',
                'visibleButtons' => [
                    'update' => function($data) { 
                        $userId = Yii::$app->user->getId();
                        $user = User::find()->where(['id'=>$userId])->one();
                        
                        $is_admin = $user->is_admin;
                       // var_dump($is_admin);die;
                       return ($is_admin == 1 or $is_admin == 2); 
                    },
                    'delete' => function($data) { 
                        $userId = Yii::$app->user->getId();
                        $user = User::find()->where(['id'=>$userId])->one();
                        $is_admin = $user->is_admin;
                       // var_dump($is_admin);die;
                       return ($is_admin == 1 or $is_admin == 2);
                    },
                ]
            ],
            'id',
            [
                'attribute' => 'Кол.', // Для объединения с фоном
                'value' => 'responsecount',
                'contentOptions'=> [ 'style' => 'width: 20px; white-space: normal;' ],
            ],
            'basis', 
            'volume', 
            'price', 
            'end_date',
            // [
            //     'attribute' => 'end_date', 
            //     'contentOptions'=> [ 'style' => 'width: 100px; white-space: normal;' ],
            // ],
            
            // [
            //     'attribute' => 'end_date',
            //     'format' =>  ['date', 'php:Y-m-d H:i:s'],
               
            // ],
            //'logistic',
            // 'nomenclature',
           
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
    ]); ?>


</div>
