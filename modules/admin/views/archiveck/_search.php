<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ck-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'basis') ?>

    <?= $form->field($model, 'agent') ?>

    <?= $form->field($model, 'buyer') ?>

    <?= $form->field($model, 'provider') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'payment') ?>

    <?php // echo $form->field($model, 'volume') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'logist') ?>

    <?php // echo $form->field($model, 'on_basis') ?>

    <?php // echo $form->field($model, 'date_from') ?>

    <?php // echo $form->field($model, 'date_to') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
