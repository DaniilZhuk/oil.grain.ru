<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="header_enter">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="main_enter">
        <img src="/img/logo-mini.png" class="logo-mini">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-lg-12 col-form-label '],
                'inputOptions' => ['class' => 'col-lg-12 form-control '],
                'errorOptions' => ['class' => 'col-lg-12 invalid-feedback '],
            ],
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="row">
            <div class=" col-lg-12 fl-left">
                <div class=" col-lg-8 fl-left">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\" col-lg-12 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ]) ?>
                </div>
                <div class="col-lg-4 fl-left">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>
        </div>


        <?php ActiveForm::end(); ?>

    </div>

</div>