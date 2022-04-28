<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
?>

<?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
    <!-- <?= $form->field($model, 'agent')->checkbox( [
     'template' => "<div class=\" col-lg-12 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
     'value'=>1, 'uncheckValue'=>0, 
    ] ) ?>  Агент ,  Трейдер , 
     Производитель  -->

    <?= $form->field($model, 'agent')->dropDownList([
            'Производитель' =>'Производитель',
            'Агент' =>'Агент',
            'Трейдер' =>' Трейдер ',
            
            
    ]) ?>

    <?= $form->field($model, 'inn')->textInput(['type'=>'number','maxlength' => true]) ?>

    <?= $form->field($model, 'mail')->textInput([ 'type'=>'email', 'maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['type'=>'phone','maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'authKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accessToken')->textInput(['maxlength' => true]) ?> -->

<div class="form-group">
 <div>
 <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
 </div>
</div>
<?php ActiveForm::end() ?>