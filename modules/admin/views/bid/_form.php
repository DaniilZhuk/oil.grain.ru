<?php

use yii\helpers\Html;

// use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Bid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bid-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'basis')->dropDownList([
            'Юг Руси, АО (г. Ростов-на-Дону, ул. Луговая, 9)' => 'Юг Руси, АО (г. Ростов-на-Дону, ул. Луговая, 9)',
            'ЮР Лабинский МЭЗ ф-л, ООО (Краснодарский кр., г.Лабинск, ул.Красная, 100)'=>'ЮР Лабинский МЭЗ ф-л, ООО (Краснодарский кр., г.Лабинск, ул.Красная, 100)',
            'ООО Кропоткинский ЗЭРМ 	(г. Кропоткин, ул. Красная,1)'=>'ООО Кропоткинский ЗЭРМ 	(г. Кропоткин, ул. Красная,1)',
            'Аннинский МЭЗ ООО (Воронежская область,  п.г.т. Анна, ул. Ленина, д. №1)'=>'Аннинский МЭЗ ООО (Воронежская область,  п.г.т. Анна, ул. Ленина, д. №1)',
            'ЮР Лискинский МЭЗ ф-л ООО (Воронежская область, г. Лиски,  ул. 40 лет Октября, д.62)'=>'ЮР Лискинский МЭЗ ф-л ООО (Воронежская область, г. Лиски,  ул. 40 лет Октября, д.62)',
            'ЮР Валуйский МЭЗ ф-л, ООО (Белгородская область, город Валуйки, улица Никольская, 119)'=>'ЮР Валуйский МЭЗ ф-л, ООО (Белгородская область, город Валуйки, улица Никольская, 119)',
            'ОАО "МЖК Краснодарский"  	(г. Краснодар. ул. Тихорецкая 5)'=>'ОАО "МЖК Краснодарский"  	(г. Краснодар. ул. Тихорецкая 5)',
            'TOO "Актобе Фудс"	(Республика Казахстан, г. Актобе, 41 разъезд, Курсантское шоссе, Дом 322)' =>'TOO "Актобе Фудс"	(Республика Казахстан, г. Актобе, 41 разъезд, Курсантское шоссе, Дом 322)',
            
    ],
     [
        'prompt' => 'Выберите базиз поставки...'
    ]
        
        ); ?>

        <?= $form->field($model, 'volume')->textInput(['style'=>'text-align: left;'])->widget(\yii\widgets\MaskedInput::className(), [
        // 'mask' => '999 999',
        'options' => [
           'autocomplete' => "off",
        ],
        'clientOptions' => [
            'alias' =>  'decimal',
            'groupSeparator' => ' ',
            'autoGroup' => true
        ],
        ]); ?>

    <?= $form->field($model, 'price')->textInput(['type'=>'number','value'=>'90','maxlength' => true, 'step'=>1, 'placeholder'=>'125']) ?>

    <?= $form->field($model, 'nomenclature')->listBox([
        'Масло подсолнечное нерафинированное промышленной переработки' =>'Масло подсолнечное нерафинированное промышленной переработки',
        'Масло подсолнечное нерафинированное первого сорта'=>'Масло подсолнечное нерафинированное первого сорта',
        'Масло подсолнечное нерафинированное высший сорт'=>'Масло подсолнечное нерафинированное высший сорт',     
    ], [
        'multiple' => true,
    ]) ?>

    <?= $form->field($model, 'quality')->textInput(['maxlength' => true]) ?>

   

   

<?= $form->field($model, 'end_date')->textInput(['type' => 'datetime-local',
        'value' => str_replace(date('Y-m-d', strtotime($model->end_date)).' ',
            date('Y-m-d', strtotime($model->end_date)).'T', $model->end_date )]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
