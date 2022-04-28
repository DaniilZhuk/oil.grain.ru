<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
              $userId = Yii::$app->user->getId();
              $user = User::find()->where(['id'=>$userId])->one();
              $is_admin = $user->is_admin;
            //   $searchModel = NULL;
             if ($is_admin==1) {
               
                 echo Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']);
             } 
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?= GridView::widget([
        'summary' => false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // 'id',
            'fio',
            'inn',
            'mail',
            'tel',
            'agent',
            // [
            //     'attribute'=>'agent',
            //     'value'=> function($data) { 
            //             $agent = $data->agent;
            //             if ($agent==1) {
            //                 $agent = 'Агент';
            //             } else {
            //                 $agent = 'Не агент';
            //             }
            //             return $agent;
            //         }
            // ],
            // 'username',
            // 'password',
            //'authKey',
            //'accessToken',
            [
                'class' => ActionColumn::className(),
                // {view} {update} {delete}
                'template' => ' {view} {update} {delete} ',
                'visibleButtons' => [
                    'delete' => function($data) { 
                        $userId = Yii::$app->user->getId();
                        $user = User::find()->where(['id'=>$userId])->one();
                        $is_admin = $user->is_admin;
                       // var_dump($is_admin);die;
                        return $is_admin == 1 ; 
                    },
                ]
            ],
        ],
    ]); ?>


</div>
