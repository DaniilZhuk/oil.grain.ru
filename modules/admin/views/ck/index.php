<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Ck;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на доп. согл-ия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ck-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'basis',
            'agent',
            'buyer',
            'provider',
            'status',
            //'payment',
            //'volume',
            //'price',
            //'logist',
            //'on_basis',
            //'date_from',
            //'date_to',
            'comment',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ck $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            // [
            //     'class' => ActionColumn::className(),
            //     // {view} {update} {delete}
            //     'template' => '{delete}',
            //     'visibleButtons' => [
            //         'update' => function($data) { 
            //             $userId = Yii::$app->user->getId();
            //             $user = User::find()->where(['id'=>$userId])->one();
            //             $is_admin = $user->is_admin;
            //            // var_dump($is_admin);die;
            //             return ($is_admin == 1 or $is_admin == 2) ; 
            //         },
            //         'delete' => function($data) { 
            //             $userId = Yii::$app->user->getId();
            //             $user = User::find()->where(['id'=>$userId])->one();
            //             $is_admin = $user->is_admin;
            //            // var_dump($is_admin);die;
            //             return $is_admin == 1 or $is_admin == 2 ; 
            //         },
            //     ]
            // ],
        ],
    ]); ?>


</div>
