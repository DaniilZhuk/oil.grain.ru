<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "response".
 *
 * @property int $id
 * @property int $id_user
 * @property int $price
 * @property int $id_bid
 * @property string $company
 *  @property string $volume 
* @property string $date_start 
* @property string $date_end 
 */
class Response extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'price', 'id_bid', 'company', 'volume','logistic'], 'required'],
            [['id_user', 'id_bid'], 'integer'],
            [['company'], 'string', 'max' => 255],
            [['date_start', 'date_end'], 'safe'],
            [['company', 'volume','comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id пользователя ',
            'price' => 'Цена руб. (с НДС) ',
            'id_bid' => '№ заявки ',
            'company' => 'Наименование поставщика ',
            'volume' => 'Объем ',
            'date_start' => 'Сроки поставки с ',
            'date_end' => 'Сроки поставки по ',
            'logistic'=>'Логистика ',
            'comment'=> 'Дополнительные условия поставки',
        ];
    }
    public function getBid()
    {
        return $this->hasOne(Bid::class, ['id' => 'id_bid']);
    }
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
