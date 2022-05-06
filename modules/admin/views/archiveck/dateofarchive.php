<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Archiveck;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Архив заявок на доп. согл-ия';
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
            'basis',
            'agent',
            'buyer',
            'provider',
            'status',
            'comment',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Archiveck $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
          
        ],
    ]); ?>


</div>
