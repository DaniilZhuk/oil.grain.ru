<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <!-- <?= $form->field($model, 'agent')->checkbox( [
     'template' => "<div class=\" col-lg-12 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
     'value'=>1, 'uncheckValue'=>0, 
    ] ) ?> -->
    
    <?= $form->field($model, 'agent')->dropDownList([
            'Производитель' =>'Производитель',
            'Агент' =>'Агент',
            'Трейдер' =>' Трейдер ',
            
            
    ]) ?>
    <?= $form->field($model, 'fio', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?>

    <?= $form->field($model, 'inn', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?>

    <?= $form->field($model, 'mail', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?>

    <?= $form->field($model, 'tel', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?>
    
   
    <?= $form->field($model, 'username', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?>
        <?php 
        $my_id = Yii::$app->user->getId();
        $user = User::find()->where(['id'=>$my_id])->one();
        $is_admin = $user->is_admin;
        $id_user = $model->id;
        if ( $is_admin==1 ) {
        ?> <?= $form->field($model, 'password', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?> <?php
        } else if ($is_admin==2 and $id_user == $my_id) {
            ?> <?= $form->field($model, 'password', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?> <?php
        } else if ( $id_user == $my_id ) {
            ?> <?= $form->field($model, 'password', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?> <?php
        } else {
            ?> <?= $form->field($model, 'password', ['options' => ['class' => 'inp_new']])->hiddenInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ])->label(false) ?> <?php
        }
        ?>
    <!-- <?= $form->field($model, 'password', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?> -->

    <!-- <?= $form->field($model, 'authKey', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?>

    <?= $form->field($model, 'accessToken', ['options' => ['class' => 'inp_new']])->textInput(['maxlength' => true, 'class' => 'form-control col-lg-12' ]) ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
