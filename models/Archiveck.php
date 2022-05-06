<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ck".
 *
 * @property int $id
 * @property string $basis
 * @property string $agent
 * @property string $buyer
 * @property string $provider
 * @property string $status
 * @property string $payment
 * @property string $volume
 * @property string $price
 * @property string $logist
 * @property string $on_basis
 * @property string $date_from
 * @property string $date_to
 * @property string $comment
 */
class Archiveck extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ck';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['basis', 'agent', 'buyer', 'provider', 'date_from', 'date_to'], 'required'],
            [['basis', 'agent', 'buyer', 'provider', 'status', 'payment', 'volume', 'price', 'logist', 'on_basis', 'date_from', 'date_to', 'comment'], 'safe'],
            [['basis', 'agent', 'buyer', 'provider', 'status', 'payment', 'volume', 'price', 'logist', 'on_basis',  'comment'], 'default', 'value'=>' ' ],
            [['basis', 'agent', 'buyer', 'provider', 'status', 'payment', 'volume', 'price', 'logist', 'on_basis', 'comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'basis' => 'Базис',
            'agent' => 'Агент',
            'buyer' => 'Покупатель',
            'provider' => 'Поставщик',
            'status' => 'Статус',
            'payment' => 'Форма оплаты',
            'volume' => 'Объём, т',
            'price' => 'Цена без НДС по договору',
            'logist' => 'Логист, в т.ч. без НДС, р/кг',
            'on_basis' => 'На базисе поставки',
            'date_from' => 'Срок поставки с',
            'date_to' => 'Срок поставки по',
            'comment' => 'Комментарий',
        ];
    }
}
