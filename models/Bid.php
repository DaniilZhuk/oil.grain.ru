<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bid".
 *
 * @property int $id
 * @property string $basis
 * @property string $volume
 * @property string $price
 * @property string $logistic
 * @property string $nomenclature
 * @property string $end_date
 * @property string $quality
 * @property string $comment
 */
class Bid extends \yii\db\ActiveRecord
{
   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['basis', 'volume', 'price', 'nomenclature', 'end_date'], 'required'],
            [['end_date'], 'safe'],
            // [['end_date'], 'datetime', 'format'=>'php:Y-m-d'],
            // [['end_date'], 'default', 'value' => date('Y-m-d')],
            [['basis', 'volume', 'price', 'quality', 'comment'], 'string', 'max' => 255],
            [['logistic', 'comment', 'quality'], 'default', 'value'=>'' ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ заявки ',
            'basis' => 'Базис поставки ',
            'volume' => 'Объём (тонны) ',
            'price' => 'Цена руб.(с НДС) ',
            'logistic' => 'Логистика ',
            'nomenclature' => 'Номенклатура ',
            'end_date' => 'Дата и время окончания приема заявок ',
            'quality' => 'Минимальные качественные показатели ',
            'comment' => 'Комментарий ',
        ];
    }
    // public function getUsers()
    // {
    //     return $this->hasOne(User::class, ['number' => 'status']);
    // }
    public function beforeSave($inser)
    {       
        if (parent::beforeSave($inser))
        {
            $this->nomenclature = implode(" / ", $this->nomenclature);
           
        }
        return true;
    }
    public function getResponse()
    {
        return $this->hasMany(Response::class, ['id_bid' => 'id']) ;
    }
    public function getResponseCount()
    {
        return $this->hasOne(Response::class, ['id_bid' => 'id'])->count();
    }

    public static function countVolume($v)
    {
        if ($v == 5) {
            $volume = '1 000';
        } elseif ($v == 4) {
            $volume  = '500';
        } elseif ($v == 3) {
            $volume  = '300';
        } elseif ($v == 2) {
            $volume  = '200';
        } elseif ($v == 1) {
            $volume  = '100';
        }
        return $volume;
    }
    public static function countBasis($c)
    {
        if ($c == 3) {
            $company  = 'ЮР Лабинский МЭЗ ф-л, ООО (Краснодарский кр., г.Лабинск, ул.Красная, 100)';
        } elseif ($c == 2) {
            $company = 'ОАО "МЖК Краснодарский" (г. Краснодар. ул. Тихорецкая 5)';
        } elseif ($c == 1) {
            $company  = 'Юг Руси, АО (г. Ростов-на-Дону, ул. Луговая, 9)';
            
        }
        return $company;
    }
    
}
