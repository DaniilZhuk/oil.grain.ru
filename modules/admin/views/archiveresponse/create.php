<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Response */

$this->title = 'Отклик на заявку №';
$this->params['breadcrumbs'][] = ['label' => 'Responses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-create">

    <h1><?= Html::encode($this->title) ?> <?=$id_bid?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id_bid'=>$id_bid,
        'id_user'=>$id_user,
        'price_max'=> $price_max ,
        'volume'=> $volume ,
    ]) ?>

</div>
