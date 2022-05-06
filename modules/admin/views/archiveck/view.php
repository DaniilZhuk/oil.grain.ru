<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\Ck */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// проверка на админа
$userId = Yii::$app->user->getId();
$user = User::find()->where(['id'=>$userId])->one();
$is_admin = $user->is_admin;
?>
<div class="ck-view">

        <?php 
             if ($is_admin == 1 or $is_admin == 2){
        ?>
                <p class="number_bid">№ заявки: <?= Html::encode($this->title) ?></p>
                <h1>Ценовой комитет №______ от <?= date('d-m-Y', strtotime($model->date_ck)); ?></h1>
        <?php
             }  else  {
        ?>
                 <h1>№ заявки: <?= Html::encode($this->title) ?></h1>
        <?php 
             }
        ?>

    <p>
      
        <?php 
 if ($is_admin == 1 or $is_admin == 2)  {
    echo '  <a href="#" onClick="window.print()" class="btn btn-primary"> Распечатать </a>';
}
?>
    </p>
<style>
    table{
        font-size: 20px !important;
    }
    td{
        padding: 1px !important;
        /* width: 20px !important; */
    }
    tr{
        text-align: center;
    }
    .comments_ck{
        text-align: left;
        /* width: 400px !important; */
    }
</style>

<!-- 
<table class="table table-striped table-bordered">
    <thead>
        <tr data-key="1">
            <td>ID</td>
            <td>Базис</td>
            <td>Агент</td>
            <td>Покупатель</td>
            <td>Поставщик </td>
            <td>Статус</td>
            <td>Форма оплаты</td>
            <td>Объём, т</td>
            <td>Цена без НДС по договору</td>
            <td>Логист, в т.ч. без НДС, р/кг</td>
            <td>На базисе поставки</td>
            <td>Срок поставки с</td>
            <td>Срок поставки по</td>
            <td>Комментарий</td>
        </tr>  
    </thead>
    <tbody>
        <tr data-key="1">
            <td><?=$model->id?></td>
            <td><?=$model->basis?></td>
            <td><?=$model->agent?></td>
            <td><?=$model->buyer?></td>
            <td><?=$model->provider?></td>
            <td><?=$model->status?></td>
            <td><?=$model->payment?></td>
            <td><?=$model->volume?></td>
            <td><?=$model->price?></td>
            <td><?=$model->logist?></td>
            <td><?=$model->on_basis?></td>
            <td> <?=date("d.m.Y",strtotime($model->date_from))?></td> 
            <td> <?=date("d.m.Y",strtotime($model->date_to))?></td> 
            <td  class="comments_ck"><?=$model->comment?></td>
        </tr>
    </tbody>
</table> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'basis',
            'agent',
            'buyer',
            'provider',
            'status',
            'payment',
            'volume',
            'price',
            'logist',
            'on_basis',
            // 'date_from',
            // 'date_to',
            [
                'attribute' => 'date_from',
                'format' =>  ['date', 'dd.MM.Y'],
            ],
            [
                'attribute' => 'date_to',
                'format' =>  ['date', 'dd.MM.Y'],
            ],
            'comment',
        ],
    ]) ?>
      <?php 
             if ($is_admin == 1 or $is_admin == 2){
        ?>
            <div class="writes_ck">
                <h3>Подписанты ЦК: </h3>
                <p class="writes_ck_p">___________________ Барабанов Д.Н.</p>
                <p class="writes_ck_p">___________________ Ильюшин И.Н.</p>
                <p class="writes_ck_p">___________________ Ерлыга Н.Ю.</p>
            </div>                
        <?php

             }  
        ?>

</div>
