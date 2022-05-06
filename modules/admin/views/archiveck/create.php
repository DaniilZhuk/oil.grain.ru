<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ck */

$this->title = 'Создать ЦК';
$this->params['breadcrumbs'][] = ['label' => 'ЦК', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ck-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
