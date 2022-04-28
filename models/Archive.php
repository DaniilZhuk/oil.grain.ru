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
class Archive extends \yii\db\ActiveRecord
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
    
}
