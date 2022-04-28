<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Response */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="response-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_user')->hiddenInput(['value' =>$id_user])->label(false) ?>
    <?= $form->field($model, 'id_bid')->hiddenInput(['value' =>$id_bid])->label(false) ?>
    <?= $form->field($model, 'volume')->hiddenInput(['value' =>$volume])->label(false) ?>
    <!-- <?= $form->field($model, 'volume')->textInput(['style'=>'text-align: left;'])->widget(\yii\widgets\MaskedInput::className(), [
        // 'mask' => '999 999',
        'options' => [
           'autocomplete' => "off",
        ],
        'clientOptions' => [
            'alias' =>  'decimal',
            'groupSeparator' => ' ',
            'autoGroup' => true
        ],
        ]);  ?> 'max' => $price_max, -->
    <?= $form->field($model, 'price')->textInput(['type'=>'number', 'value'=>$price_max, 'min' => 0, 'step'=>1,'placeholder'=>'125,25' ]) ?>

    
    <?= $form->field($model, 'date_start')->textInput(['type' => 'date',
        'value' => date('Y-m-d'),    
        ]) ?> 

    <?= $form->field($model, 'date_end')->textInput(['type' => 'date',
       'value' => date('Y-m-d'),
          ]) ?> 

<?= $form->field($model, 'logistic')->dropDownList([ 

            'Доставка за счёт грузоотправителя' =>'Доставка за счёт грузоотправителя',
            'Доставка за счет грузополучателя'=>'Доставка за счет грузополучателя',
            
    ],
     [
        'prompt' => 'Выберите вариант логистики'
    ]
        
        ); ?>

    <?= $form->field($model, 'company')->textInput() ?>
    <?= $form->field($model, 'comment')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
