<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ck */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ck-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'basis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provider')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logist')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'on_basis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_from')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'date_to')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
